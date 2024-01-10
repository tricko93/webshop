<!-- resources/views/profile/show.blade.php -->

<x-layout :title="'Profile'">
    <div class="max-w-md mx-auto mt-8 p-4 bg-white rounded shadow">
        <form action="{{ route('profile.update') }}" method="post">
            @csrf
            <!-- Username -->
            <div class="mb-4">
                <x-label for="username" required>Username</x-label>
                <x-text-input type="text" id="username" name="username" value="{{ $customer->username ?? '' }}" />
            </div>

            <!-- First Name -->
            <div class="mb-4">
                <x-label for="first_name" required>First Name</x-label>
                <x-text-input type="text" id="first_name" name="first_name" value="{{ $customer->first_name ?? '' }}" />
            </div>

            <!-- Last Name -->
            <div class="mb-4">
                <x-label for="last_name" required>Last Name</x-label>
                <x-text-input type="text" id="last_name" name="last_name" value="{{ $customer->last_name ?? '' }}" />
            </div>

            <!-- Phone Number -->
            <div class="mb-4">
                <x-label for="phone_number">Phone Number</x-label>
                <x-text-input type="text" id="phone_number" name="phone_number" value="{{ $customer->phone_number ?? '' }}" />
            </div>

            <!-- Mobile Phone -->
            <div class="mb-4">
                <x-label for="mobile_number" required>Mobile Phone</x-label>
                <x-text-input type="text" id="mobile_number" name="mobile_number" value="{{ $customer->mobile_number ?? '' }}" />
            </div>

            <!-- Street Name -->
            <div class="mb-4">
                <x-label for="street_name" required>Street Name</x-label>
                <x-text-input type="text" id="street_name" name="street_name" value="{{ $customer->street_name ?? '' }}" />
            </div>

            <!-- Street Number -->
            <div class="mb-4">
                <x-label for="street_number" required>Street Number</x-label>
                <x-text-input type="text" id="street_number" name="street_number" value="{{ $customer->street_number ?? '' }}" />
            </div>

            <!-- Postal Code -->
            <div class="mb-4">
                <x-label for="postal_code" required>Postal Code</x-label>
                <x-text-input type="text" id="postal_code" name="postal_code" value="{{ $customer->postal_code ?? '' }}" />
            </div>

            <!-- City -->
            <div class="mb-4">
                <x-label for="city" required>City</x-label>
                <x-text-input type="text" id="city" name="city" value="{{ $customer->city ?? '' }}" />
            </div>

            <!-- Floor -->
            <div class="mb-4">
                <x-label for="floor">Floor</x-label>
                <x-text-input type="text" id="floor" name="floor" value="{{ $customer->floor ?? '' }}" />
            </div>

            <!-- Apartment Number -->
            <div class="mb-4">
                <x-label for="apartment_number">Apartment Number</x-label>
                <x-text-input type="text" id="apartment_number" name="apartment_number" value="{{ $customer->apartment_number ?? '' }}" />
            </div>

            <!-- Additional Info -->
            <div class="mb-4">
                <x-label for="additional_info">Additional Info</x-label>
                <x-text-input type="text" id="additional_info" name="additional_info" value="{{ $customer->additional_info ?? '' }}" />
            </div>

            <!-- Submit Button -->
            <div align="right">
                <x-button type="submit">Update Profile</x-button>
            </div>
        </form>
    </div>
</x-layout>
