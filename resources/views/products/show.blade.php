{{-- products/show.blade.php --}}
<x-layout :title="$product->name">
    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">
        {{ $product->name }}
    </h1>

    <x-card>
        <div class="mb-4">
            <p class="text-gray-600">{{ $product->description }}</p>
            <p class="text-indigo-600 font-bold">${{ $product->price }}</p>
            {{-- Add more details as needed --}}
        </div>
    </x-card>
</x-layout>
