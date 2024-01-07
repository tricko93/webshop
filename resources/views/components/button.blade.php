<!-- resources/views/components/button.blade.php -->
<button
    {{ $attributes->class(['rounded-md border boder-slate-300 bg-white px-2.5 py-1.5 text-center text-sm font-semibold text-black shodow-sm hover:bg-slate-100']) }}>
    {{ $slot }}
</button>
