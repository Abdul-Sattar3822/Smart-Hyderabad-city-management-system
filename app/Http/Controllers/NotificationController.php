<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    // All notifications
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->get();

        // Mark all as read
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('user.notifications', compact('notifications'));
    }

    // Mark single as read
    public function markRead($id)
    {
        Notification::where('id', $id)
            ->where('user_id', Auth::id())
            ->update(['is_read' => true]);

        return back();
    }

    // Mark all as read
    public function markAllRead()
    {
        Notification::where('user_id', Auth::id())
            ->update(['is_read' => true]);

        return back()->with('success', 'All notifications marked as read!');
    }
}
