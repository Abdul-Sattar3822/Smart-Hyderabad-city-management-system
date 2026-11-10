<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        // ❌ Apna account delete na ho
        if (Auth::user()->id == $user->id) {
            return back()->with('error', 'You cannot delete yourself');
        }

        $user->delete();

        return redirect('/admin/users')->with('success', 'User deleted successfully');
    }
}
