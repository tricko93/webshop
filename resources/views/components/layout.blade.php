<!-- resources/views/components/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($title) ? $title . ' - Web Shop' : 'Web Shop' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="from-10% via-30% to-90% mx-auto mt-10 max-w-2xl bg-white text-slate-700">
    <nav class="mb-8 flex justify-between items-center text-lg font-medium">

        <ul class="flex space-x-2 items-center">
            <li>
                <a href="{{ route('products.index') }}">Home</a>
            </li>
            <!-- Add more navigation links as needed -->
        </ul>

        <div class="flex-grow items-center px-8 mt-7">
            <!-- Search input goes here -->
            <form method="GET" action="{{ route('products.index') }}"> 
                <x-search-box />
            </form>

            <!-- Display categories -->
            @if(isset($categories))
                <ul class="flex space-x-2">
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('products.index', ['category_id' => $category->id])}}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <ul class="flex space-x-2 items-center">
            <!-- Display navigation links based on user authentication status -->
            <li>
                <div x-data="{ open: false }" @click.away="open = false" style="white-space: nowrap; display: flex; align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 448 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
                    <span class="ml-2" @click="open = !open" class="cursor-pointer">
                        @auth
                            {{ auth()->user()->name ?? 'Anonymous' }}
                        @else
                            Sign in
                        @endauth
                    </span>

                    <div x-show="open" class="absolute mt-2 bg-white border rounded shadow-md">
                        @auth
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <a href="{{ route('settings.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            <hr class="my-2 border-t">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-100">Logout</button>
                            </form>
                        @else
                            <!-- Add your login link or button here -->
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login</a>
                        @endauth
                    </div>
                </div>
            </li>

            <li>
                <!-- Shopping cart link -->
                <a href="{{ route('cart.index') }}" style="white-space: nowrap; display: flex; align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg><span class="ml-2">Cart</span>
                </a>
            </li>
        </ul>
    </nav>

    @if (session('success'))
        <div role="alert"
            class="my-8 rounded-md border-l-4 border-green-300 bg-green-100 p-4 text-green-700 opacity-75">
            <p class="font-bold">Success!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if (session('error'))
        <div role="alert"
            class="my-8 rounded-md border-l-4 border-red-300 bg-red-100 p-4 text-red-700 opacity-75">
            <p class="font-bold">Error!</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    {{ $slot }}
</body>
</html>
