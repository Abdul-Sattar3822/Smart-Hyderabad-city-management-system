<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        // STATUS COUNTS
        $pending = Complaint::where('status', 'pending')->count();
        $inProgress = Complaint::where('status', 'in_progress')->count();
        $resolved = Complaint::where('status', 'resolved')->count();

        // LAST 7 DAYS DATA
        $dates = [];
        $counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[] = Carbon::now()->subDays($i)->format('d M');

            $counts[] = Complaint::whereDate('created_at', $date)->count();
        }

        return view('admin.analytics', compact(
            'pending',
            'inProgress',
            'resolved',
            'dates',
            'counts'
        ));
    }
}
