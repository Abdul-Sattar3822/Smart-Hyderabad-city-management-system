<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Complaint;
use App\Models\Notification;

class MessageController extends Controller
{
    // User sends message
    public function userSend(Request $request, $complaintId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $complaint = Complaint::findOrFail($complaintId);

        // Make sure complaint belongs to user
        if ($complaint->user_id !== Auth::id()) {
            abort(403);
        }

        Message::create([
            'complaint_id' => $complaintId,
            'user_id'      => Auth::id(),
            'message'      => $request->message,
            'sender_type'  => 'user',
        ]);

        return back()->with('success', 'Message sent!');
    }

    // Admin sends message
    public function adminSend(Request $request, $complaintId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $complaint = Complaint::findOrFail($complaintId);

        Message::create([
            'complaint_id' => $complaintId,
            'user_id'      => Auth::id(),
            'message'      => $request->message,
            'sender_type'  => 'admin',
        ]);

        // Notify user
        Notification::create([
            'user_id'      => $complaint->user_id,
            'title'        => 'New Message from Admin',
            'message'      => 'Admin replied to your complaint #' . $complaintId,
            'type'         => 'info',
            'complaint_id' => $complaintId,
        ]);

        return back()->with('success', 'Reply sent!');
    }
}
