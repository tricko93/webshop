<x-layout :title="'Reset Password'">
    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">
        Reset Your Password
    </h1>

    <x-card>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-8">
                <x-label for="email" :required="true">E-mail</x-label>
                <x-text-input name="email" type="email" value="{{ $email ?? old('email') }}" />
            </div>

            <div class="mb-8">
                <x-label for="password" :required="true">New Password</x-label>
                <x-text-input name="password" type="password" />
            </div>

            <div class="mb-8">
                <x-label for="password_confirmation" :required="true">Confirm Password</x-label>
                <x-text-input name="password_confirmation" type="password" />
            </div>

            <x-button class="w-full bg-blue-50">Reset Password</x-button>
        </form>
    </x-card>
</x-layout>
