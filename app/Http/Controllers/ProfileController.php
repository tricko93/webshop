<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Show Profile Page
    public function showProfile()
    {
        $user = Auth::user();
        $customer = $user->customer;

        return view('profile.show', compact('customer'));
    }

    // Update Profile Page Data
    public function update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'username' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string',
            'mobile_number' => 'required|string',
            'street_name' => 'required|string',
            'street_number' => 'required|string',
            'postal_code' => 'required|string',
            'city' => 'required|string',
            'floor' => 'nullable|string',
            'apartment_number' => 'nullable|string',
            'additional_info' => 'nullable|string',
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();

        // Use updateOrCreate to handle the case where the customer record doesn't exist
        $user->customer()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'username' => $request->input('username'),
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'phone_number' => $request->input('phone_number'),
                'mobile_number' => $request->input('mobile_number'),
                'street_name' => $request->input('street_name'),
                'street_number' => $request->input('street_number'),
                'postal_code' => $request->input('postal_code'),
                'city' => $request->input('city'),
                'floor' => $request->input('floor'),
                'apartment_number' => $request->input('apartment_number'),
                'additional_info' => $request->input('additional_info'),
            ]
        );

        // Redirect back to the profile page with a success message
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully');
    }
}
