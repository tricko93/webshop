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
	                     <form action="{{ route('cart.addToCart') }}" method="POST">
		                    @csrf
		                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
		                    <input type="hidden" name="product_name" value="{{ $product->name }}" />
		                    <input type="hidden" name="price" value="{{ $product->price }}" />
		                    <input type="hidden" name="quantity" value="1" min="1" />

		                    <x-button type="submit">Add to Cart</x-button>
		                </form>
	                </div>
	            @endforeach
	        @else
	        	<div>No products available at the moment.</div>
            @endif
        </div>
    </x-card>
</x-layout>
