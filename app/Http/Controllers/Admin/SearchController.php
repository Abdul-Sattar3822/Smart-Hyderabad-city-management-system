<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;

class SearchController extends Controller
{
    public function adminIndex(Request $request)
    {
        $query = Complaint::with('user');

        // 🔍 SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('id', $request->search)
                    ->orWhereHas('user', function ($u) use ($request) {
                        $u->where('phone', 'like', '%' . $request->search . '%');
                    });
            });
        }

        // 🎯 FILTERS
        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        if ($request->city) {
            $query->where('city', $request->city);
        }

        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $complaints = $query->latest()->get();

        return view('admin.search', compact('complaints'));
    }
}
