@extends('layouts.app')

@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}" },
    { "@type": "ListItem", "position": 2, "name": "Klien Kami", "item": "{{ url('/klien-kami') }}" }
  ]
}
</script>
@endpush

@section('content')

@php
    $waHref = 'https://wa.me/6287733930143?text=' . rawurlencode('Halo admin Azolatekno, saya mau konsultasi kebutuhan digital bisnis saya.');
@endphp

<section class="relative overflow-hidden bg-ink-950 pb-20 pt-36 sm:pb-24 sm:pt-44">
    <div class="pointer-events-none absolute inset-0 bg-brand-gradient opacity-[0.85]"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.07]" style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:26px 26px;"></div>

    <div class="container-app relative">
        <nav class="text-sm text-white/70">
            <a href="{{ url('/') }}" class="hover:text-white">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-white">Klien Kami</span>
        </nav>

        <div class="mx-auto mt-6 max-w-2xl text-center">
            <span class="eyebrow bg-white/10 text-white ring-1 ring-white/25">Klien Kami</span>
            <h1 class="mt-5 text-4xl font-semibold text-white sm:text-5xl">Bisnis yang Sudah Kami Bantu Bertumbuh</h1>
            <p class="mx-auto mt-5 max-w-xl text-white/80">
                Dari rental kendaraan, transportasi, hingga tekstil &mdash; berikut sebagian klien yang sudah kami bantu wujudkan solusi digitalnya.
            </p>
        </div>
    </div>
</section>

<section class="container-app py-20 sm:py-24">
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($clients as $i => $client)
            <div class="reveal card flex flex-col p-8" style="transition-delay: {{ ($i % 3) * 100 }}ms">
                <div class="flex h-20 items-center">
                    <img src="{{ asset($client['logo']) }}" alt="{{ $client['name'] }}" loading="lazy" class="max-h-14 w-auto object-contain">
                </div>
                <span class="eyebrow mt-5 w-fit">{{ $client['sector'] }}</span>
                <h2 class="mt-4 text-xl">{{ $client['name'] }}</h2>
                <p class="mt-2 flex-1 text-sm leading-relaxed text-ink-500">{{ $client['description'] }}</p>
                @if (!empty($client['website']))
                    <a href="{{ $client['website'] }}" target="_blank" rel="nofollow noopener" class="mt-5 inline-flex items-center gap-1 text-sm font-semibold text-brand-700 hover:text-brand-800">
                        Kunjungi Website
                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="none"><path d="M5 10h10M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                @endif
            </div>
        @endforeach
    </div>
</section>

<section class="container-app pb-24">
    <div class="reveal relative overflow-hidden rounded-3xl bg-brand-gradient px-8 py-16 text-center sm:px-16">
        <div class="pointer-events-none absolute inset-0 opacity-[0.08]" style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:22px 22px;"></div>
        <div class="relative mx-auto max-w-xl">
            <h2 class="text-3xl text-white sm:text-4xl">Ingin Jadi Klien Berikutnya?</h2>
            <p class="mt-4 text-white/85">Konsultasikan kebutuhan website, SEO, atau AI bisnis Anda sekarang &mdash; gratis, tanpa komitmen.</p>
            <a href="{{ $waHref }}" target="_blank" rel="noopener" class="btn-ghost-light mt-8 bg-white text-brand-700 ring-0 hover:bg-white/90">
                Mulai Konsultasi Gratis
            </a>
        </div>
    </div>
</section>

@endsection
