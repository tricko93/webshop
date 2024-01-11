<x-layout :title="'Account Settings'">
    <div class="container mx-auto mt-10 max-w-2xl">
        <div class="bg-white p-6 shadow-md rounded-md">
            <h1 class="text-2xl font-semibold mb-4">Account Settings</h1>

            <!-- Profile Picture -->
            <div class="flex items-center mt-4">
                <img src="{{ auth()->user()->profile_picture_url }}" alt="Profile Picture" class="rounded-full h-16 w-16">
                <button class="ml-2 text-blue-500">Change Profile Picture</button>
            </div>

            <!-- User Details -->
            <div class="mt-4">
                <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            </div>

            <!-- Password Change -->
            <div class="mt-6">
                <h2 class="text-lg font-semibold mb-2">Security Settings</h2>
                <ul>
                    <li><a href="{{ route('password.change') }}" class="text-blue-500">Change Password</a></li>
                    <li><a href="{{ route('email.change') }}" class="text-blue-500">Change Email Address</a></li>
                    <li><a href="{{ route('account.delete') }}" class="text-red-500">Delete Account</a></li>
                </ul>
                </ul>
            </div>

            <!-- Email Notifications -->
            <div class="mt-6">
                <h2 class="text-lg font-semibold mb-2">Email Notifications</h2>
                <p>Receive email notifications for:</p>
                <ul>
                    <li>
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox" checked> Order Updates
                        </label>
                    </li>
                    <li>
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox"> Promotions and Offers
                        </label>
                    </li>
                </ul>
            </div>

            <!-- Payment Settings -->
            <div class="mt-6">
                <h2 class="text-lg font-semibold mb-2">Payment Settings</h2>
                <p><strong>Payment Method:</strong> **** **** **** 1234</p>
                <button class="text-blue-500">Change Payment Method</button>
            </div>

            <!-- Shipping Address -->
            <div class="mt-6">
                <h2 class="text-lg font-semibold mb-2">Shipping Address</h2>
                <p><strong>Current Address:</strong> 123 Tech Street, Cityville, State, 12345</p>
                <button class="text-blue-500">Change Shipping Address</button>
            </div>

            <!-- Purchase History -->
            <div class="mt-6">
                <h2 class="text-lg font-semibold mb-2">Purchase History</h2>
                <!-- Display recent purchases and order details -->
            </div>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mt-6 bg-red-500 text-white p-2 rounded-md hover:bg-red-600">Logout</button>
            </form>
        </div>
    </div>
</x-layout>
