<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Notifications\VerifyEmailNotification;

class SettingsController extends Controller
{
    //
    public function showSettings()
    {
        return view('settings.show');
    }

    public function showChangePasswordForm()
    {
        return view('settings.change-password');
    }

    public function showChangeEmailForm()
    {
        return view('settings.change-email');
    }

    public function showDeleteAccountForm()
    {
        return view('settings.delete-account');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|different:current_password',
            'new_password_confirmation' => 'required|string|same:new_password',
        ]);

        $user = Auth::user();

        // Verify the current password
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        // Update the password
        $user->update([
            'password' => Hash::make($request->input('new_password')),
        ]);

        return redirect()->route('home')->with('success', 'Password changed successfully.');
    }

    public function changeEmail(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_email' => 'required|string|email|unique:users,email',
            'new_email_confirmation' => 'required|string|email|same:new_email',
        ]);

        $user = Auth::user();

        // Verify the current password
        if (!password_verify($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        // Update the email
        $user->update([
            'email' => $request->input('new_email'),
            'email_verified_at' => null,
        ]);

        // Send email verification notification
        $user->notify(new VerifyEmailNotification());

        return redirect()->route('home')->with('success', 'Email changed successfully. Please check your email for verification.');
    }

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'confirmation' => 'required|string|in:DELETE',
        ]);

        $user = Auth::user();

        // Verify the current password
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        // Delete the account
        $user->delete();

        // You may want to perform additional cleanup or logging here

        return redirect()->route('home')->with('success', 'Your account has been deleted.');
    }
}
