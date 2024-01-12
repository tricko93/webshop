<x-layout :title="'Update Profile Picture'">
    <div class="container mx-auto mt-10 max-w-2xl p-8 bg-white rounded shadow-lg">
        <h1 class="text-2xl font-semibold mb-4">User Profile Form</h1>

        <form action="{{ route('settings.updateProfilePicture') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <x-label for="profile_picture_url" class="block text-sm font-medium text-gray-600">Profile Picture URL:</x-label>
                <x-text-input type="text" name="profile_picture_url" id="profile_picture_url" class="mt-1 p-2 border rounded-md w-full" />
            </div>

            <div class="mb-4">
                <x-label for="profile_picture_file" class="block text-sm font-medium text-gray-600">Upload Profile Picture:</x-label>
                <x-text-input type="file" name="profile_picture_file" id="profile_picture_file" class="mt-1 p-2 border rounded-md w-full" />
            </div>

            <x-button type="submit">Update Profile</x-button>
        </form>
    </div>
</x-layout>
