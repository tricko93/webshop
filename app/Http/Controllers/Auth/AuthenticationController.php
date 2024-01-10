<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Notifications\WelcomeNotification;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    // Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('/');
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Registration
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validation
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Send welcome email
        $user->notify(new WelcomeNotification());

        // Log in the new user
        Auth::login($user);

        // Send email verification notification
        $user->notify(new VerifyEmailNotification());

        return redirect()->intended('/');
    }

    // Password Reset
    public function showPasswordResetForm()
    {
        return view('auth.passwords.password-reset');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        // Check if there's an existing token for the user
        $existingToken = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if ($existingToken) {
            // Update the existing record rather than inserting a new one
            $token = Str::random(60);

            $expirationDuration = now()->addHours(1); // Adjust the expiration duration as needed

            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->update([
                    'token' => Hash::make($token),
                    'created_at' => now(),
                    'expires_at' => $expirationDuration,
                ]);
        } else {
            // No existing record, insert a new one
            $token = Str::random(60);

            $expirationDuration = now()->addHours(1); // Adjust the expiration duration as needed

            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => Hash::make($token),
                'created_at' => now(),
                'expires_at' => $expirationDuration,
            ]);
        }

        $resetLink = url("/password/reset/{$token}?email=" . urlencode($request->email));

        Mail::to($request->email)->send(new ResetPasswordMail($request->email, $resetLink));

        return response()->json(['message' => 'Password reset link sent.'], 200);
    }

    public function showResetForm(Request $request, $token)
    {
        // Retrieve the user based on the token
        $user = User::where('email', $request->email)->first();

        // Validate the user and token
        if (!$user || !Password::tokenExists($user, $token)) {
            // Output for debugging
            abort(404); // Token or user not found, show a 404 page
        }

        return view('auth.passwords.reset', ['token' => $token, 'email' => $request->email]);
    }

    /**
     * Handle the reset password form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        // Retrieve the user based on the email
        $user = User::where('email', $request->email)->first();

        // Validate the user and token
        if (!$user || !$this->validateResetToken($user, $request->token)) {
            abort(404); // Token or user not found, show a 404 page
        }

        // Update the user's password
        $user->update([
            'password' => bcrypt($request->password),
        ]);

        // Clear the password reset token from the database
        Password::deleteToken($user);

        // Log in the user (optional)
        Auth::login($user);

        // Redirect the user to the desired page after password reset
        return redirect()->route('home')->with('status', 'Your password has been reset!');
    }

    /**
     * Validate the password reset token.
     *
     * @param  \App\Models\User  $user
     * @param  string  $token
     * @return bool
     */
    protected function validateResetToken($user, $token)
    {
        return Password::tokenExists($user, $token);
    }

    // Email Verification
    public function showEmailVerificationNotice()
    {
        return view('auth.verify');
    }

    public function verifyEmail(Request $request)
    {
        try {
            $userId = $request->route('id');
            $user = User::findOrFail($userId);

            // Verify the email
            if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
                // Invalid hash
                Session::flash('error', 'Invalid verification link');
                return redirect()->route('home');
            }

            // Check if the user is already verified
            if ($user->hasVerifiedEmail()) {
                // User already verified
                Session::flash('success', 'User already verified');
                return redirect()->route('home');
            }

            // Mark the user as verified
            $user->markEmailAsVerified();

            // Successful verification
            Session::flash('success', 'Email successfully verified');
            return redirect()->route('home');

        } catch (\Exception $exception) {
            // Error during email verification
            Session::flash('error', 'Error during email verification');
            return redirect()->route('home');
        }
    }

    public function resendVerificationEmail(Request $request)
    {
        // Implement your resend verification email logic here
    }
}
