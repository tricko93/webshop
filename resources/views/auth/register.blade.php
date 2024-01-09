<x-layout :title="'Register'">
	<h1 class="my-16 text-center text-4xl font-medium text-slate-600">
		Create a new account
	</h1>

	<x-card>
		<form action="{{ route('register') }}" method="POST">
			@csrf

			<div class="mb-8">
				Already have an account?
				<a href="{{ route('login') }}" class="text-indigo-600 hover:underline">
					Log in here.
				</a>
			</div>

			<div class="mb-8">
				<x-label for="name" :required="true">Full Name</x-label>
				<x-text-input name="name" />
			</div>

			<div class="mb-8">
				<x-label for="email" :required="true">E-mail</x-label>
				<x-text-input name="email" />
			</div>

			<div class="mb-8">
				<x-label for="password" :required="true">
					Password
				</x-label>
				<x-text-input name="password" type="password" />
			</div>

			<div class="mb-8">
				<x-label for="password_confirmation" :required="true">
					Confirm Password
				</x-label>
				<x-text-input name="password_confirmation" type="password" />
			</div>

			<x-button class="w-full bg-blue-50">Register</x-button>
		</form>
	</x-card>
</x-layout>
