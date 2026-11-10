<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        $otp = rand(1000, 9999); // 4 digit

        // SESSION me store karo (user abhi DB me nahi jayega)
        session([
            'register_data' => [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone, // ✅ ADD THIS
            ],
            'otp' => $otp
        ]);

        try {
            Mail::raw("Your OTP is: $otp", function ($msg) use ($request) {
                $msg->to($request->email)->subject('OTP Verification');
            });
        } catch (\Exception $e) {
            // Agar error aaye to wo register page par hi dikhaye, page phate nahi
            return back()->withErrors(['email' => 'Mail Error: ' . $e->getMessage()]);
        }

        return redirect('/verify-otp');

        // ❌ auto login hata diya
        // Auth::login($user);

        // return redirect('/login')->with('success', 'Account created, please login');
    }
}
