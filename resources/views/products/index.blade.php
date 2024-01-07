<x-layout :title="'Home'">
    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">
        All Products
    </h1>

    <x-card>
        {{-- Your product display logic can go here --}}
        <div class="mb-4">
            <h2 class="text-lg font-medium text-slate-600 mb-2">Available Products:</h2>
            {{-- Display the list of products --}}
            @if (isset($products) && count($products) > 0)
	            @foreach ($products as $product)
	                <div class="mb-4">
	                    <h3 class="text-xl font-medium text-slate-800">{{ $product->name }}</h3>
	                    <p class="text-gray-600">{{ $product->description }}</p>
	                    <p class="text-indigo-600 font-bold">${{ $product->price }}</p>
	                    <a href="{{ route('products.show', $product) }}" class="text-indigo-600 hover:underline">Quick Show</a>
	                    {{-- Add more product details as needed --}}
	                    <form action="{{ route('cart.store', $product) }}" method="POST">
	                        @csrf
	                        <x-button>Add to Cart</x-button>
	                    </form>
	                </div>
	            @endforeach
	        @else
	        	<div>No products available at the moment.</div>
            @endif
        </div>
    </x-card>
</x-layout>
