<!-- resources/views/profile/change-password.blade.php -->
<x-layout :title="'Change Password'">
	<div class="container mx-auto mt-10 max-w-2xl">
        <h1 class="text-2xl font-semibold mb-4">Change Password</h1>

        <form action="{{ route('password.change') }}" method="post">
            @csrf

            <div class="mb-8">
            	<x-label for="current_password" required>Current Password:</x-label>
            	<x-text-input type="password" name="current_password" required />
            </div>

            <div class="mb-8">
            	<x-label for="new_password" required>New Password:</x-label>
            	<x-text-input type="password" name="new_password" required />
            </div>

            <div class="mb-8">
            	<x-label for="new_password_confirmation" required>Confirm New Password:</x-label>
            	<x-text-input type="password" name="new_password_confirmation" required />
        	</div>

            <x-button type="submit">Change Password</x-button>
        </form>
    </div>
</x-layout>
