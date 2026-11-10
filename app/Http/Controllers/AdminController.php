<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function edit()
    {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user();
        /** @var \App\Models\User $admin */

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'phone' => 'nullable',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('profile_image')) {

            // old image delete
            if ($admin->profile_image) {
                Storage::disk('public')->delete($admin->profile_image);
            }
            $admin->profile_image = $request->file('profile_image')->store('admins', 'public');
        }



        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;

        $admin->save();

        return back()->with('success', 'Profile updated ✅');
    }

    public function updatePassword(Request $request)
    {
        $admin = Auth::user();
        /** @var \App\Models\User $admin */

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->with('error', 'Current password incorrect ❌');
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return back()->with('success', 'Password updated 🔐');
    }
}
