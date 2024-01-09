<x-layout :title="'Sign in'">
	<h1 class="my-16 text-center text-4xl font-medium text-slate-600">
		Sign in to your account
	</h1>

	<x-card>
		<form action="{{ route('login') }}" method="POST">
			@csrf

			<div class="mb-8">
				Don't have an account?
				<a href="{{ route('register') }}" class="text-indigo-600 hover:underline">
					Register here.
				</a>
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

			<div class="mb-8 flex justify-between text-sm font-medium">
				<div>
					<div class="flex items-center space-x-2">
						<input type="checkbox" name="remember"
							class="rounded-sm border border-slate-400">
						<label for="remember">Remember me</label>
					</div>
				</div>
				<div>
					<a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">
						Forgot password?
					</a>
				</div>
			</div>

			<x-button class="w-full bg-green-50">Login</x-button>
		</form>
	</x-card>
</x-layout>
