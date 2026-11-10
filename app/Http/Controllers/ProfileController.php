<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        // Get the authenticated user
        $user = $request->user();

        // Validate data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        // Handle the profile image upload
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profiles', 'public');
            $user->profile_image = $imagePath;
        }

        // Update name and email (add more fields if required)
        $user->name = $request->name;
        $user->email = $request->email;

        // Save the updated user
        $user->save(); // Correct usage of save() on Eloquent model

        // Redirect to the appropriate dashboard based on the user role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard'); // Redirect to Admin Dashboard
        }

        return redirect()->route('user.dashboard'); // Redirect to User Dashboard
    }


    /**
     * Delete the user's account.
     */

    public function destroy(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();  // or auth()->user()

        // Prevent the user from deleting their own account
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        // Only admin can delete a user
        if ($user->role !== 'admin') {
            return back()->with('error', 'You are not authorized to delete this account.');
        }

        // Logout the user after deleting the account
        Auth::logout();  // Proper logout call

        // Delete the user
        $user->delete();

        // Redirect to the homepage after account deletion
        return redirect('user.dashboard')->with('success', 'Account deleted successfully.');
    }
}
