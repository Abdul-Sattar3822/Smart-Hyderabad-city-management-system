<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;

class DepartmentController extends Controller
{
    // Department Login Form
    public function showLogin()
    {
        return view('department.login');
    }

    // Department Login Submit
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('department')->attempt($credentials)) {
            return redirect()->route('department.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid email or password']);
    }

    // Department Dashboard
    public function dashboard()
    {
        $dept = Auth::guard('department')->user();

        $complaints = Complaint::where('department_id', $dept->id)
            ->latest()
            ->get();

        $stats = [
            'total'       => $complaints->count(),
            'pending'     => $complaints->where('status', 'pending')->count(),
            'in_progress' => $complaints->where('status', 'in_progress')->count(),
            'resolved'    => $complaints->where('status', 'resolved')->count(),
        ];

        return view('department.dashboard', compact('complaints', 'stats', 'dept'));
    }

    // Update complaint status
    public function updateStatus(Request $request, Complaint $complaint)
    {
        $dept = Auth::guard('department')->user();

        if ($complaint->department_id !== $dept->id) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:in_progress,resolved',
        ]);

        $complaint->update(['status' => $request->status]);

        return back()->with('success', 'Status updated successfully!');
    }

    public function show(Complaint $complaint)
    {
        $dept = Auth::guard('department')->user();

        if ($complaint->department_id !== $dept->id) {
            abort(403);
        }

        return view('department.complaint-show', compact('complaint'));
    }

    public function destroy(Complaint $complaint)
    {
        $dept = Auth::guard('department')->user();

        if ($complaint->department_id !== $dept->id) {
            abort(403);
        }

        if ($complaint->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($complaint->image);
        }

        $complaint->delete();

        return back()->with('success', 'Complaint deleted successfully! 🗑️');
    }

    // Logout
    public function logout()
    {
        Auth::guard('department')->logout();
        return redirect()->route('department.login');
    }


    // Admin: List all departments
    public function adminIndex()
    {
        $departments = \App\Models\Department::withCount('complaints')->get();
        return view('admin.departments', compact('departments'));
    }

    // Admin: Add new department
    public function adminStore(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:departments,email',
            'password' => 'required|min:6',
            'icon'     => 'nullable|string|max:10',
        ]);

        \App\Models\Department::create([
            'name'      => $request->name,
            'slug'      => \Illuminate\Support\Str::slug($request->name),
            'email'     => $request->email,
            'password'  => \Illuminate\Support\Facades\Hash::make($request->password),
            'icon'      => $request->icon ?: '🏛️',
            'is_active' => true,
        ]);

        return back()->with('success', 'Department added successfully! ✅');
    }

    // Admin: Delete department
    public function adminDestroy($id)
    {
        $department = \App\Models\Department::findOrFail($id);

        // Un-assign complaints first
        \App\Models\Complaint::where('department_id', $id)->update(['department_id' => null]);

        $department->delete();

        return back()->with('success', 'Department deleted successfully! 🗑️');
    }

    // Admin: Update department
    public function adminUpdate(Request $request, $id)
    {
        $department = \App\Models\Department::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:departments,email,' . $id,
            'icon'     => 'nullable|string|max:10',
            'password' => 'nullable|min:6',
        ]);

        $department->name  = $request->name;
        $department->slug  = \Illuminate\Support\Str::slug($request->name);
        $department->email = $request->email;
        $department->icon  = $request->icon ?: '🏛️';

        if ($request->filled('password')) {
            $department->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $department->save();

        return back()->with('success', 'Department updated successfully! ✅');
    }
}
