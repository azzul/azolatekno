@extends('layouts.app')

@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}" },
    { "@type": "ListItem", "position": 2, "name": "Layanan Kami", "item": "{{ url('/layanan') }}" }
  ]
}
</script>
@endpush

@push('preload')
    @foreach ($products->take(3) as $product)
        @if (file_exists(public_path('img/product/' . $product->image_produk)))
            <link rel="preload" as="image" href="{{ asset('img/product/' . $product->image_produk) }}">
        @endif
    @endforeach
@endpush

@section('content')

@php
    $whyUs = [
        ['title' => 'Solusi Custom, Bukan Template', 'desc' => 'Setiap project dirancang khusus untuk memenuhi kebutuhan bisnis Anda, dari tampilan hingga fungsionalitas.'],
        ['title' => 'SEO Friendly Sejak Awal', 'desc' => 'Website yang kami kembangkan terbukti menembus halaman 1 Google di berbagai kata kunci lokal maupun nasional.'],
        ['title' => 'Siap untuk Era AI Search', 'desc' => 'Struktur konten kami dioptimalkan supaya mudah dikutip AI Overview, ChatGPT, dan answer engine lain.'],
        ['title' => 'Satu Tim, Semua Kebutuhan', 'desc' => 'Website, SEO, media sosial, hingga e-commerce ditangani satu tim yang saling terhubung strateginya.'],
    ];
@endphp

<section class="relative overflow-hidden bg-ink-950 pb-16 pt-32 sm:pb-20 sm:pt-40">
    <div class="pointer-events-none absolute inset-0 bg-brand-gradient opacity-[0.85]"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.07]" style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:26px 26px;"></div>
    <div class="container-app relative">
        <nav class="text-sm text-white/70">
            <a href="{{ url('/') }}" class="hover:text-white">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-white">Layanan Kami</span>
        </nav>
        <div class="mx-auto mt-6 max-w-2xl text-center">
            <span class="eyebrow bg-white/10 text-white ring-1 ring-white/25">Layanan Kami</span>
            <h1 class="mt-5 text-3xl font-semibold text-white sm:text-4xl">Solusi Digital yang Bisa Anda Pilih</h1>
            <p class="mx-auto mt-4 max-w-xl text-white/80">Mulai dari pembuatan website sampai optimasi media sosial dan e-commerce, semua bisa disesuaikan dengan kebutuhan dan skala bisnis Anda.</p>
        </div>
    </div>
</section>

<section class="container-app py-16 sm:py-20">
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($products as $i => $product)
            @php $hargaMin = optional($product->harga)->min('harga'); @endphp
            <a href="{{ url('/layanan/' . $product->slug_produk) }}" class="reveal card group flex flex-col overflow-hidden" style="transition-delay: {{ ($i % 3) * 100 }}ms">
                <div class="aspect-[16/10] w-full overflow-hidden bg-ink-100">
                    <x-product-image :product="$product" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                </div>
                <div class="flex flex-1 flex-col p-6">
                    <h2 class="text-lg">{{ $product->nama_produk }}</h2>
                    <p class="mt-2 line-clamp-2 flex-1 text-sm text-ink-500">{{ trim(preg_replace('/\s+/', ' ', strip_tags($product->spesifikasi))) }}</p>
                    <div class="mt-5 flex items-center justify-between">
                        <span class="text-sm font-semibold text-brand-700">
                            @if ($hargaMin)
                                Mulai Rp{{ number_format($hargaMin, 0, ',', '.') }}
                            @else
                                Konsultasikan Kebutuhan
                            @endif
                        </span>
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-brand-50 text-brand-700 transition-colors group-hover:bg-brand-600 group-hover:text-white">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none"><path d="M5 10h10M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>

<section class="bg-ink-50/60 py-16 sm:py-20">
    <div class="container-app">
        <div class="reveal mx-auto max-w-2xl text-center">
            <span class="eyebrow">Kenapa Azolatekno</span>
            <h2 class="mt-4 text-3xl">Kenapa Azolatekno Jadi Pilihan Terbaik?</h2>
            <p class="mt-4 text-ink-500">Azolatekno adalah partner digital terpercaya sejak 2018 yang telah membantu puluhan klien mencapai posisi terbaik di Google, sekaligus menyiapkan struktur konten yang relevan untuk era pencarian berbasis AI.</p>
        </div>

        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($whyUs as $i => $item)
                <div class="reveal card p-6" style="transition-delay: {{ ($i % 4) * 100 }}ms">
                    <h3 class="text-base">{{ $item['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-ink-500">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
