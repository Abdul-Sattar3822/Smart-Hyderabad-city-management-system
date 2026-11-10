<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;

class FilterController extends Controller
{
    public function index(Request $request)
    {
        $complaints = Complaint::query();

        if ($request->status) {
            $complaints->where('status', $request->status);
        }

        if ($request->priority) {
            $complaints->where('priority', $request->priority);
        }

        $complaints = $complaints->get();

        return view('admin.filters', compact('complaints'));
    }
}
