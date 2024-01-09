<x-layout :title="'Forgot Password'">
    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">
        Forgot Your Password?
    </h1>

    <x-card>
        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <div class="mb-8">
                <x-label for="email" :required="true">E-mail</x-label>
                <x-text-input name="email" />
            </div>

            <x-button class="w-full bg-indigo-50">Send Password Reset Link</x-button>

            <div class="mt-4">
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">
                    ← Back
                </a>
            </div>
        </form>
    </x-card>
</x-layout>
