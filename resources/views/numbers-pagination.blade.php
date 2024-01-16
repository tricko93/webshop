@php
    use Illuminate\Support\Facades\Request;
@endphp

@if ($paginator->hasPages())
    <ul class="flex list-reset">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="mr-1 disabled" aria-disabled="true">
                <span class="block px-3 py-2 bg-gray-200 text-gray-500 rounded-md">&laquo; Previous</span>
            </li>
        @else
            <li class="mr-1">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="block px-3 py-2 bg-white text-black rounded-md hover:bg-gray-200 focus:outline-none focus:bg-gray-200">
                    &laquo; Previous
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="mr-1 disabled" aria-disabled="true">
                    <span class="block px-3 py-2 bg-gray-200 text-gray-500 rounded-md">{{ $element }}</span>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li class="mr-1">
                        @if ($page == $paginator->currentPage())
                            <span class="block px-3 py-2 bg-black text-white rounded-md">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="block px-3 py-2 bg-white text-black rounded-md hover:bg-gray-200 focus:outline-none focus:bg-gray-200">
                                {{ $page }}
                            </a>
                        @endif
                    </li>
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="mr-1">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="block px-3 py-2 bg-white text-black rounded-md hover:bg-gray-200 focus:outline-none focus:bg-gray-200">
                    Next &raquo;
                </a>
            </li>
        @else
            <li class="mr-1 disabled" aria-disabled="true">
                <span class="block px-3 py-2 bg-gray-200 text-gray-500 rounded-md">Next &raquo;</span>
            </li>
        @endif
    </ul>
@endif
