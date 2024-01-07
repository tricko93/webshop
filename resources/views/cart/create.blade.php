<x-layout :title="'Cart'">
    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">
        Shopping Cart
    </h1>

    <x-card>
        {{-- Your cart items display logic can go here --}}
        <div class="mb-4">
            <h2 class="text-lg font-medium text-slate-600 mb-2">Your Cart Items:</h2>
            {{-- Display the list of cart items --}}
            <ul>
                <li>Product A - $19.99</li>
                <li>Product B - $29.99</li>
                {{-- Add more items as needed --}}
            </ul>
        </div>

        {{-- Checkout or Continue Shopping buttons --}}
        <div class="flex justify-between items-center">
            <x-button>Checkout</x-button>
            <a href="{{ route('products.index') }}" class="text-indigo-600 hover:underline">Continue Shopping</a>
        </div>
    </x-card>
</x-layout>
