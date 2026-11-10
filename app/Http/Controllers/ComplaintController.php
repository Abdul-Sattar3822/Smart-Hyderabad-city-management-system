<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\Notification;
use App\Mail\ComplaintStatusMail;
use Illuminate\Support\Facades\Mail;
use App\Models\ComplaintHistory;


class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = \App\Models\Complaint::where('user_id', Auth::id())->get();

        foreach ($complaints as $c) {
            if ($c->priority == 'high') {
                $c->eta = '24 hours';
            } elseif ($c->priority == 'medium') {
                $c->eta = '48 hours';
            } else {
                $c->eta = '72 hours';
            }
        }

        $resolvedCount = \App\Models\Complaint::where('user_id', Auth::id())
            ->where('status', 'resolved')
            ->count();

        return view('user.complaints.index', compact('complaints', 'resolvedCount'));
    }

    public function create()
    {
        return view('user.complaints.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'nullable|string',
            'city' => 'nullable|string',
            'priority' => 'nullable|string',
            'location' => 'nullable|string',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('complaints', 'public');
        } else {
            $imagePath = null;
        }

        \App\Models\Complaint::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'city' => $request->city,
            'category' => $request->category,
            'priority' => $request->priority,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);



        return back()->with('success', 'Complaint submitted successfully');
    }

    public function feedbackForm($id)
    {
        $complaint = \App\Models\Complaint::findOrFail($id);
        return view('user.feedback', compact('complaint'));
    }

    public function submitFeedback(Request $request, $id)
    {
        $complaint = \App\Models\Complaint::findOrFail($id);

        $complaint->rating = $request->rating;
        $complaint->feedback = $request->feedback;
        $complaint->save();

        return redirect('/complaints')->with('success', 'Feedback submitted');
    }

    public function rate(Request $request, $id)
    {
        $complaint = \App\Models\Complaint::findOrFail($id);

        $complaint->rating = $request->rating;
        $complaint->feedback = $request->feedback;
        $complaint->save();

        return redirect('/complaints')->with('success', 'Feedback submitted');
    }

    public function feedbackList()
    {
        $feedbacks = \App\Models\Complaint::whereNotNull('rating')->get();
        return view('admin.feedbacks', compact('feedbacks'));
    }


    public function reopen($id)
    {
        $complaint = Complaint::findOrFail($id);

        $complaint->status = 'pending';
        $complaint->save();

        return back()->with('success', 'Complaint reopened 🔁');
    }

    public function download($id)
    {
        $complaint = Complaint::findOrFail($id);

        $pdf = Pdf::loadView('user.pdf', compact('complaint'));

        return $pdf->download('complaint.pdf');
    }

    public function adminIndex()
    {
        $complaints  = \App\Models\Complaint::with(['user', 'department'])->latest()->get();
        $departments = \App\Models\Department::where('is_active', true)->get();

        return view('admin.complaints', compact('complaints', 'departments'));
    }

    public function assignDepartment(Request $request, Complaint $complaint)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
        ]);

        $complaint->update([
            'department_id' => $request->department_id,
            'assigned_at'   => now(),
        ]);

        // In-app notification
        Notification::create([
            'user_id'      => $complaint->user_id,
            'title'        => 'Complaint Assigned to Department',
            'message'      => 'Your complaint #' . $complaint->id . ' "' . $complaint->title . '" has been assigned to ' . $complaint->department->name,
            'type'         => 'info',
            'complaint_id' => $complaint->id,
        ]);

        // Email notification
        try {
            Mail::to($complaint->user->email)->send(new ComplaintStatusMail($complaint->load('department'), 'department'));
        } catch (\Exception $e) {
            // Silent fail
        }

        return back()->with('success', 'Department assigned successfully! ✅');
    }

    public function updateStatus(Request $request, $id)
    {
        $complaint = \App\Models\Complaint::findOrFail($id);
        $complaint->status = $request->status;
        $complaint->save();

        // History record
        ComplaintHistory::create([
            'complaint_id' => $complaint->id,
            'status'       => $request->status,
            'changed_by'   => 'admin',
            'note'         => 'Status updated by admin',
        ]);

        // In-app notification
        \App\Models\Notification::create([
            'user_id'      => $complaint->user_id,
            'title'        => 'Complaint Status Updated',
            'message'      => 'Your complaint #' . $complaint->id . ' "' . $complaint->title . '" status changed to ' . ucfirst(str_replace('_', ' ', $request->status)),
            'type'         => $request->status === 'resolved' ? 'success' : 'info',
            'complaint_id' => $complaint->id,
        ]);

        // Email
        try {
            \Illuminate\Support\Facades\Mail::to($complaint->user->email)
                ->send(new \App\Mail\ComplaintStatusMail($complaint, 'status'));
        } catch (\Exception $e) {
        }

        return back()->with('success', 'Status updated');
    }
    public function show($id)
    {
        $complaint = \App\Models\Complaint::with(['user', 'histories', 'messages'])->findOrFail($id);
        return view('user.complaints.show', compact('complaint'));
    }

    public function adminShow($id)
    {
        $complaint = Complaint::with(['user', 'histories', 'messages'])->findOrFail($id);
        return view('admin.complaint-show', compact('complaint'));
    }

    public function destroy($id)
    {
        $complaint = \App\Models\Complaint::findOrFail($id);

        // optional: image bhi delete karo
        if ($complaint->image) {
            Storage::disk('public')->delete($complaint->image);
        }

        $complaint->delete();

        return back()->with('success', 'Complaint deleted successfully 🗑️');
    }
}
