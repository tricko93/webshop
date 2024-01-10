<!-- resources/views/components/text-input.blade.php -->
<div class="relative">
    @if ('textarea' != $type)
        <input x-ref="input-{{ $name }}" type="{{ $type }}"
            placeholder="{{ $placeholder }}"
            name="{{ $name }}" value="{{ old($name, $value) }}" id="{{ $name }}"
            @class([
                'w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 placeholder:text-slate-400 focus:ring-2',
            ]) />
    @else
        <textarea id="{{ $name }}" name="{{ $name }}" @class([
                'w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 placeholder:text-slate-400 focus:ring-2',
        ])>{{ old($name, $value) }}</textarea>
    @endif

    @error ($name)
        <div class="mt-1 text-xs text-red-500">
            {{ $message }}
        </div>
    @enderror
</div>
