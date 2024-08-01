<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }

    public function showForgetPasswordForm()
    {
        return view('auth.forget');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = $request->email;

        // Find the user by the provided email
        $user = User::where('email', $email)->first();

        // Check if the user exists
        if ($user) {
            // Generate a new remember token for the user
            $user->remember_token = Str::random(40);
            $user->save();

            // Send the password reset email to the user
            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            // Redirect back with a success message
            return back()->with('success', 'Password reset link sent successfully.');
        } else {
            // Redirect back with an error message if the user was not found
            return back()->with('danger', 'User not found.');
        }
    }

    public function reset($token)
    {
        $user = User::where('remember_token','=',$token)->first();
        if(!empty($user)){
            $data['user'] = $user;
            $data['token'] = $user->remember_token;
            return view('auth.reset', $data);
        }
    }

    public function postReset($token, Request $request)
    {
        $request->validate([
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8',
            ]);

        if ($request->newpassword !== $request->confirmpassword) {
            return redirect()->back()->with('error', 'The new password confirmation does not match.');
        }

        $user = User::where('remember_token','=',$token)->first();
        if(!empty($user)){
            if(empty($user->email_verified_at)){
                $user->email_verified_at = now();
            }
            $user->remember_token =  Str::random(40);
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect('login')->with('success', 'Password successfully reset.');
        }
    }
}
