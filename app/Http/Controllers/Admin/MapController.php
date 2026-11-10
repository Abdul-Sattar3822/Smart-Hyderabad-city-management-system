<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;

class MapController extends Controller
{
    public function index()
    {
        $complaints = Complaint::with('user')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('admin.map', compact('complaints'));
    }
}
