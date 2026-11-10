<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function verify(Request $request)
    {
        if ($request->otp != session('otp')) {
            return back()->with('error', 'Wrong OTP');
        }

        $data = session('register_data');

        \App\Models\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
        ]);

        session()->forget(['otp', 'register_data']);

        return redirect('/login')->with('success', 'Registration successful');
    }

    public function resendOtp()
    {
        $otp = rand(100000, 999999);

        session(['otp' => $otp]);

        $email = session('register_data.email');

        Mail::raw("Your new OTP is: $otp", function ($msg) use ($email) {
            $msg->to($email)->subject('Resend OTP');
        });

        return back()->with('success', 'OTP resent successfully');
    }
}
