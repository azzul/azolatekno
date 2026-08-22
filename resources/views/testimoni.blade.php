@extends('layouts.app')

@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}" },
    { "@type": "ListItem", "position": 2, "name": "Testimonial", "item": "{{ url('/testimonial') }}" }
  ]
}
</script>
@endpush

@section('content')

@php
    $testimonials = [
        [
            'quote' => 'Web design dan SEO-nya bagus, sekarang web perusahaan textile kami sudah di halaman 1 Google dan banyak yang top 1 Google. Orderan kain meningkat ke WhatsApp kami hariannya capai puluhan order tanpa iklan sama sekali. Dan sudah masuk rekomendasi supplier kain terbaik di ChatGPT dan AI lainnya. Keren sih, totalitas banget dengan biaya yang terjangkau.',
            'name' => 'Altratex Group',
            'context' => 'Group perusahaan textile di Jawa Tengah dengan 4 factory & 6 depo kain kaos',
        ],
        [
            'quote' => 'Mantap. Kualitas web dan SEO-nya bagus, harga relatif murah, profesional & fast respon. Lanjutkan lur. Mantul.',
            'name' => 'Dian Heditio',
            'context' => 'Local Guide · Ulasan Google Maps',
        ],
        [
            'quote' => 'Keren sih, konsultasi gratis dan bener-bener diarahin saran strateginya seperti apa. Jadi plong dan tau strategi ke depannya mau gimana.',
            'name' => 'AMS Buran',
            'context' => 'Ulasan Google Maps · 5.0 ★',
        ],
        [
            'quote' => 'Saya suka banget.',
            'name' => 'Tarmuji',
            'context' => 'Owner, Fajar Rentcar',
        ],
        [
            'quote' => 'Mantap.',
            'name' => 'Hanifan',
            'context' => 'Owner, Merpati Rentcar',
        ],
        [
            'quote' => 'Kualitas, profesionalisme, nilai.',
            'name' => 'Ghozi',
            'context' => 'Klien Azolatekno',
        ],
    ];
@endphp

<section class="relative overflow-hidden bg-ink-950 pb-24 pt-36 sm:pb-28 sm:pt-44">
    <div class="pointer-events-none absolute inset-0 bg-brand-gradient opacity-[0.85]"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.07]" style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:26px 26px;"></div>

    <div class="container-app relative">
        <nav class="text-sm text-white/70">
            <a href="{{ url('/') }}" class="hover:text-white">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-white">Testimonial</span>
        </nav>

        <div class="mx-auto mt-6 max-w-2xl text-center">
            <span class="eyebrow bg-white/10 text-white ring-1 ring-white/25">Testimoni</span>
            <h1 class="mt-5 text-4xl font-semibold text-white sm:text-5xl">Apa Kata Klien Tentang Azolatekno?</h1>
            <p class="mx-auto mt-5 max-w-xl text-white/80">
                Kepercayaan dari klien kami adalah bukti nyata kualitas layanan Azolatekno dalam membangun website, aplikasi, hingga integrasi AI yang berdampak nyata.
            </p>
            <a href="https://maps.app.goo.gl/cCtVpEtf5mTbQTuc9" target="_blank" rel="nofollow noopener noreferrer" class="btn-ghost-light mt-8">
                Cek Ulasan di Google Maps
            </a>
        </div>
    </div>
</section>

<section class="container-app py-20 sm:py-24">
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($testimonials as $i => $t)
            <div class="reveal card flex flex-col p-8" style="transition-delay: {{ ($i % 3) * 100 }}ms">
                <span class="flex text-amber-400">
                    @for ($s = 0; $s < 5; $s++)
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M10 1.5l2.6 5.4 5.9.7-4.3 4.1 1.1 5.9L10 14.8l-5.3 2.8 1.1-5.9L1.5 7.6l5.9-.7L10 1.5z"/></svg>
                    @endfor
                </span>
                <p class="mt-4 flex-1 text-sm leading-relaxed text-ink-600">&ldquo;{{ $t['quote'] }}&rdquo;</p>
                <div class="mt-6 border-t border-ink-100 pt-4">
                    <p class="text-sm font-semibold text-ink-900">{{ $t['name'] }}</p>
                    <p class="text-xs text-ink-400">{{ $t['context'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="bg-ink-50/60 py-20 sm:py-24">
    <div class="container-app">
        <div class="reveal mx-auto max-w-2xl text-center">
            <span class="eyebrow">Layanan Kami</span>
            <h2 class="mt-4 text-3xl sm:text-4xl">Layanan Web, SEO, Digital, AI dan Course AI</h2>
        </div>

        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $i => $product)
                <a href="{{ url('/layanan/' . $product->slug_produk) }}" class="reveal card group flex flex-col overflow-hidden" style="transition-delay: {{ ($i % 3) * 100 }}ms">
                    <div class="aspect-[16/10] w-full overflow-hidden bg-ink-100">
                        <x-product-image :product="$product" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg">{{ $product->nama_produk }}</h3>
                        <p class="mt-2 line-clamp-2 text-sm text-ink-500">{{ trim(preg_replace('/\s+/', ' ', strip_tags($product->spesifikasi))) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

@endsection
