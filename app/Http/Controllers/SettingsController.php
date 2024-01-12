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
        $user = Auth::user();

        return view('settings.show', compact('user'));
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

    public function showProfilePictureForm()
    {
        return view('settings.update-picture');
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

    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        $user->update([
            'order_confirmation' => $request->has('order_confirmation'),
            'promotions_and_updates' => $request->has('promotions_and_updates'),
        ]);

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    /**
     * Update the user's profile picture.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfilePicture(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'profile_picture_url' => 'nullable|string',
            'profile_picture_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if a profile picture URL is provided
        if ($request->filled('profile_picture_url')) {
            // Update profile picture URL
            $user->update(['profile_picture_url' => $request->input('profile_picture_url')]);
        }
        // Check if a profile picture file is uploaded
        elseif ($request->hasFile('profile_picture_file')) {
            // Upload and update profile picture file
            $file = $request->file('profile_picture_file');
            $path = $file->store('profile_pictures', 'public');
            $user->update(['profile_picture_url' => asset('storage/' . $path)]);
        }

        // Redirect back to the profile form with a success message
        return redirect()->route('settings.show')->with('success', 'Profile picture updated successfully!');
    }
}
