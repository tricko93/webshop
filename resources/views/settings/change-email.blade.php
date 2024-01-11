<!-- resources/views/profile/change-email.blade.php -->
<x-layout :title="'Change Email'">
    <div class="container mx-auto mt-10 max-w-2xl">
        <h1 class="text-2xl font-semibold mb-4">Change Email</h1>

        <form action="{{ route('email.change') }}" method="post">
            @csrf

            <div class="mb-8">
                <x-label for="current_password" required>Current Password:</x-label>
                <x-text-input type="password" name="current_password" required />
            </div>

            <div class="mb-8">
                <x-label for="new_email" required>New Email Address:</x-label>
                <x-text-input type="email" name="new_email" required />
            </div>

            <div class="mb-8">
                <x-label for="new_email_confirmation" required>Confirm New Email Address:</x-label>
                <x-text-input type="email" name="new_email_confirmation" required />
            </div>

            <x-button type="submit">Change Email</x-button>
        </form>
    </div>
</x-layout>
