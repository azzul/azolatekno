@props(['product', 'class' => 'h-full w-full object-cover'])

@php
    $imgPath = public_path('img/product/' . $product->image_produk);
    $exists = file_exists($imgPath);
@endphp

@if ($exists)
    <img
        src="{{ asset('img/product/' . $product->image_produk) }}"
        alt="{{ $product->nama_produk }}"
        {{ $attributes->merge(['class' => $class, 'loading' => 'lazy']) }}
    >
@else
    <div {{ $attributes->merge(['class' => $class . ' flex items-center justify-center bg-brand-gradient']) }}>
        <svg class="h-10 w-10 text-white/90" viewBox="0 0 24 24" fill="none">
            <path d="M4 7a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7z" stroke="currentColor" stroke-width="1.6"/>
            <circle cx="9" cy="10" r="1.6" stroke="currentColor" stroke-width="1.6"/>
            <path d="M4 16l5-4 4 3 3-2 4 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
@endif
