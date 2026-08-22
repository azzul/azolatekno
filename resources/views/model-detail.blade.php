@extends('layouts.app')

@php
    $waHref = 'https://wa.me/6285129370703?text=' . rawurlencode('Halo admin Azolatekno, saya mau tanya ' . $product->nama_produk . '. Saya dapat info dari ' . url()->current());
    $hargaMin = optional($product->harga)->min('harga');

    // Extract FAQ Q&A pairs embedded in long_desc (schema.org microdata) to build JSON-LD.
    $faqItems = [];
    if (preg_match_all(
        '/<h3[^>]*itemprop="name"[^>]*>(.*?)<\/h3>.*?itemprop="text"[^>]*>(.*?)<\/div>/s',
        $product->long_desc ?? '',
        $faqMatches,
        PREG_SET_ORDER
    )) {
        foreach ($faqMatches as $match) {
            $faqItems[] = [
                'question' => trim(strip_tags($match[1])),
                'answer' => trim(strip_tags($match[2])),
            ];
        }
    }
@endphp

@push('preload')
    <link rel="preload" as="image" href="{{ asset('img/product/' . $product->image_produk) }}" fetchpriority="high">
@endpush

@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}" },
    { "@type": "ListItem", "position": 2, "name": "Layanan", "item": "{{ url('/layanan') }}" },
    { "@type": "ListItem", "position": 3, "name": "{{ $product->nama_produk }}", "item": "{{ url()->current() }}" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": {!! json_encode($product->nama_produk) !!},
  "description": {!! json_encode($product->desc_meta ?: strip_tags($product->spesifikasi ?? '')) !!},
  "url": {!! json_encode(url()->current()) !!},
  "image": {!! json_encode(asset('img/product/' . $product->image_produk)) !!},
  "provider": {
    "@type": "Organization",
    "name": "Azolatekno",
    "url": "https://azolatekno.com",
    "telephone": "+6285129370703",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Dalon, RT 03 RW 04 Sroyo, Kec. Jaten",
      "addressLocality": "Karanganyar",
      "addressRegion": "Jawa Tengah",
      "postalCode": "57731",
      "addressCountry": "ID"
    }
  },
  "areaServed": "ID"
  @if ($hargaMin)
  ,"offers": {
    "@type": "Offer",
    "priceCurrency": "IDR",
    "price": "{{ (int) $hargaMin }}",
    "availability": "https://schema.org/InStock",
    "url": {!! json_encode(url()->current()) !!}
  }
  @endif
}
</script>
@if (count($faqItems))
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    @foreach ($faqItems as $i => $faq)
    {
      "@type": "Question",
      "name": {!! json_encode($faq['question']) !!},
      "acceptedAnswer": {
        "@type": "Answer",
        "text": {!! json_encode($faq['answer']) !!}
      }
    }@if (!$loop->last),@endif
    @endforeach
  ]
}
</script>
@endif
@endpush

@section('content')

{{-- Hero --}}
<section class="relative overflow-hidden bg-ink-950 pb-16 pt-32 sm:pb-20 sm:pt-40">
    <div class="pointer-events-none absolute inset-0 bg-brand-gradient opacity-[0.85]"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.07]" style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:26px 26px;"></div>

    <div class="container-app relative">
        <nav class="text-sm text-white/70">
            <a href="{{ url('/') }}" class="hover:text-white">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ url('/layanan') }}" class="hover:text-white">Layanan</a>
            <span class="mx-2">/</span>
            <span class="text-white">{{ $product->nama_produk }}</span>
        </nav>

        <div class="mx-auto mt-6 max-w-2xl text-center">
            <span class="eyebrow bg-white/10 text-white ring-1 ring-white/25">Layanan</span>
            <h1 class="mt-5 text-3xl font-semibold text-white sm:text-4xl">{{ $product->nama_produk }}</h1>
            @if (!empty($product->spesifikasi))
                <p class="mx-auto mt-4 max-w-xl text-white/80">{{ trim(preg_replace('/\s+/', ' ', strip_tags($product->spesifikasi))) }}</p>
            @endif
        </div>
    </div>
</section>

<section class="container-app py-16 sm:py-20">
    <div class="grid gap-10 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <div class="reveal aspect-[16/9] w-full overflow-hidden rounded-3xl bg-ink-100">
                <x-product-image :product="$product" class="h-full w-full object-cover" />
            </div>

            <article class="reveal prose prose-slate mt-10 max-w-none prose-headings:font-display prose-headings:font-medium prose-headings:text-ink-900 prose-a:text-brand-700 prose-strong:text-ink-900">
                {!! $product->long_desc !!}
            </article>
        </div>

        <aside class="lg:col-span-1">
            <div class="reveal card sticky top-28 p-8">
                @if ($hargaMin)
                    <p class="text-xs font-semibold uppercase tracking-wider text-ink-400">Mulai Dari</p>
                    <p class="mt-1 text-3xl font-semibold text-brand-700">Rp{{ number_format($hargaMin, 0, ',', '.') }}</p>
                @endif
                <a href="{{ $waHref }}" target="_blank" rel="noopener" class="btn-primary mt-6 w-full">
                    Konsultasi via WhatsApp
                </a>
                <a href="tel:+6285129370703" class="btn-outline mt-3 w-full">
                    +62 851 2937 0703
                </a>
                <div class="mt-6 space-y-2 border-t border-ink-100 pt-6 text-sm text-ink-500">
                    <p>&bull; Konsultasi gratis, tanpa komitmen</p>
                    <p>&bull; Dikerjakan tim Azolatekno sejak 2018</p>
                    <p>&bull; Rating 5,0 di Google Maps</p>
                </div>
            </div>
        </aside>
    </div>
</section>

@if (count($recomendations))
<section class="bg-ink-50/60 py-16 sm:py-20">
    <div class="container-app">
        <div class="reveal mx-auto max-w-2xl text-center">
            <span class="eyebrow">Layanan Lainnya</span>
            <h2 class="mt-4 text-3xl">Rekomendasi Layanan Lain untuk Anda</h2>
        </div>

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($recomendations->where('slug_produk', '!=', $product->slug_produk)->take(3) as $i => $rec)
                <a href="{{ url('/layanan/' . $rec->slug_produk) }}" class="reveal card group flex flex-col overflow-hidden" style="transition-delay: {{ ($i % 3) * 100 }}ms">
                    <div class="aspect-[16/10] w-full overflow-hidden bg-ink-100">
                        <x-product-image :product="$rec" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg">{{ $rec->nama_produk }}</h3>
                        <p class="mt-2 line-clamp-2 text-sm text-ink-500">{{ trim(preg_replace('/\s+/', ' ', strip_tags($rec->spesifikasi))) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="container-app py-16 sm:py-20">
    <div class="reveal relative overflow-hidden rounded-3xl bg-brand-gradient px-8 py-16 text-center sm:px-16">
        <div class="pointer-events-none absolute inset-0 opacity-[0.08]" style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:22px 22px;"></div>
        <div class="relative mx-auto max-w-xl">
            <h2 class="text-3xl text-white sm:text-4xl">Tertarik dengan {{ $product->nama_produk }}?</h2>
            <p class="mt-4 text-white/85">Konsultasikan kebutuhan Anda sekarang &mdash; gratis, tanpa komitmen.</p>
            <a href="{{ $waHref }}" target="_blank" rel="noopener" class="btn-ghost-light mt-8 bg-white text-brand-700 ring-0 hover:bg-white/90">
                Konsultasi Gratis Sekarang
            </a>
        </div>
    </div>
</section>

@endsection
