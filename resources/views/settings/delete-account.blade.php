<!-- resources/views/profile/delete-account.blade.php -->
<x-layout :title="'Delete Account'">
    <div class="container mx-auto mt-10 max-w-2xl">
        <h1 class="text-2xl font-semibold mb-4">Delete Account</h1>

        <form action="{{ route('account.delete') }}" method="post">
            @csrf
            @method('DELETE')

            <div class="mb-8">
                <x-label for="current_password" required>Current Password:</x-label>
                <x-text-input type="password" name="current_password" required />
            </div>

            <div class="mb-8">
                <p class="text-red-600">Warning: Deleting your account is irreversible and will result in the loss of all data associated with your account.</p>
            </div>

            <div class="mb-8">
                <x-label for="confirmation" required>Type "DELETE" to confirm:</x-label>
                <x-text-input type="text" name="confirmation" required />
            </div>

            <x-button type="submit" class="bg-red-500">Delete Account</x-button>
        </form>
    </div>
</x-layout>
