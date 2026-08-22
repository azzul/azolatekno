@extends('layouts.app')

@section('content')

@php
    $waHref = 'https://wa.me/6287733930143?text=' . rawurlencode('Halo admin Azolatekno, saya mau konsultasi kebutuhan digital bisnis saya.');

    $valueProps = [
        [
            'title' => 'Bukan Sekadar Bikin Website',
            'desc' => 'Kami mulai dari riset masalah bisnis Anda dulu, baru menentukan solusi tekniknya — website, SEO, AIO, atau kombinasi ketiganya.',
        ],
        [
            'title' => 'Satu Tim, Semua Kebutuhan',
            'desc' => 'Website, SEO, AIO, social media, branding, sampai e-commerce ditangani satu tim yang saling terhubung strateginya.',
        ],
        [
            'title' => 'Terukur, Bukan Janji Kosong',
            'desc' => 'Setiap project punya target terukur: ranking, traffic, atau konversi — dilaporkan berkala, bukan sekadar serah terima website.',
        ],
    ];

    $clients = config('clients.list');

    $testimonials = [
        [
            'quote' => 'Web design dan SEO-nya bagus, sekarang web perusahaan textile kami sudah di halaman 1 Google dan banyak yang top 1. Orderan kain meningkat ke WhatsApp hariannya capai puluhan order tanpa iklan sama sekali, dan sudah masuk rekomendasi supplier kain terbaik di ChatGPT dan AI lainnya.',
            'name' => 'Altratex Group',
            'context' => 'Klien · Industri Tekstil Terintegrasi',
        ],
        [
            'quote' => 'Mantap. Kualitas bagus, harga relatif murah, profesional & fast respon. Lanjutkan lur, mantul.',
            'name' => 'Dian Heditio',
            'context' => 'Local Guide · Ulasan Google Maps',
        ],
        [
            'quote' => 'Keren sih, konsultasi gratis dan bener-bener diarahin saran strateginya seperti apa. Jadi plong dan tau strategi ke depannya mau gimana.',
            'name' => 'AMS Buran',
            'context' => 'Ulasan Google Maps · 5.0 ★',
        ],
    ];
@endphp

{{-- Hero --}}
<section class="relative overflow-hidden bg-ink-950 pb-24 pt-36 sm:pb-28 sm:pt-44">
    <div class="pointer-events-none absolute inset-0 bg-brand-gradient opacity-[0.85]"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.07]" style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:26px 26px;"></div>
    <div class="pointer-events-none absolute -left-24 top-1/3 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>
    <div class="pointer-events-none absolute -right-16 top-10 h-80 w-80 rounded-full bg-ink-950/40 blur-3xl"></div>

    <div class="container-app relative">
        <div class="mx-auto max-w-3xl text-center">
            <span class="eyebrow bg-white/10 text-white ring-1 ring-white/25">Agency Digital Sejak 2018</span>

            <h1 class="mt-6 text-4xl font-semibold leading-tight text-white sm:text-5xl lg:text-6xl">
                Kami Mengatasi Solusi,<br class="hidden sm:block"> Bukan Hanya Membuat Aplikasi dan Website
            </h1>

            <p class="mx-auto mt-6 max-w-xl text-base leading-relaxed text-white/80 sm:text-lg">
                Azolatekno membantu bisnis Anda tumbuh lewat pendekatan solusi menyeluruh: website, SEO, optimasi AI/answer engine, social media, branding, dan e-commerce &mdash; bukan sekadar vendor pembuatan website.
            </p>

            <div class="mt-9 flex flex-col items-center justify-center gap-3 sm:flex-row">
                <a href="{{ $waHref }}" target="_blank" rel="noopener" class="btn-primary w-full sm:w-auto">
                    Konsultasi Gratis Sekarang
                </a>
                <a href="{{ url('/layanan') }}" class="btn-ghost-light w-full sm:w-auto">
                    Lihat Semua Layanan
                </a>
            </div>

            <div class="mt-8 flex items-center justify-center gap-2 text-sm text-white/80">
                <span class="flex text-amber-400">
                    @for ($i = 0; $i < 5; $i++)
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M10 1.5l2.6 5.4 5.9.7-4.3 4.1 1.1 5.9L10 14.8l-5.3 2.8 1.1-5.9L1.5 7.6l5.9-.7L10 1.5z"/></svg>
                    @endfor
                </span>
                <span>Rating 5.0 di Google Maps</span>
            </div>
        </div>

        <div class="mx-auto mt-16 grid max-w-3xl grid-cols-2 gap-6 sm:grid-cols-4">
            @foreach ([['7+', 'Tahun Pengalaman'], ['50+', 'Project Selesai'], ['5.0', 'Rating Google'], ['100%', 'Konsultasi Gratis']] as [$num, $label])
                <div class="text-center">
                    <p class="font-display text-2xl font-semibold text-white sm:text-3xl">{{ $num }}</p>
                    <p class="mt-1 text-xs text-white/60 sm:text-sm">{{ $label }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Value proposition --}}
<section class="container-app py-20 sm:py-28">
    <div class="reveal mx-auto max-w-2xl text-center">
        <span class="eyebrow">Kenapa Azolatekno</span>
        <h2 class="mt-4 text-3xl sm:text-4xl">Partner Solusi, Bukan Sekadar Vendor Teknis</h2>
        <p class="mt-4 text-ink-500">
            Tagline kami &mdash; <em>"Kami mengatasi Solusi bukan hanya membuat aplikasi dan website"</em> &mdash; berarti kami menempatkan diri sebagai partner pertumbuhan bisnis Anda, bukan sekadar pihak yang menyelesaikan pesanan teknis.
        </p>
    </div>

    <div class="mt-14 grid gap-6 sm:grid-cols-3">
        @foreach ($valueProps as $i => $vp)
            <div class="reveal card p-8" style="transition-delay: {{ $i * 100 }}ms">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-50 text-brand-700">
                    <span class="font-display text-lg font-semibold">{{ $i + 1 }}</span>
                </div>
                <h3 class="mt-5 text-lg">{{ $vp['title'] }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-ink-500">{{ $vp['desc'] }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- Layanan --}}
<section class="bg-ink-50/60 py-20 sm:py-28">
    <div class="container-app">
        <div class="reveal mx-auto max-w-2xl text-center">
            <span class="eyebrow">Layanan Kami</span>
            <h2 class="mt-4 text-3xl sm:text-4xl">Solusi Digital yang Bisa Anda Pilih</h2>
            <p class="mt-4 text-ink-500">Mulai dari pembuatan website sampai optimasi untuk mesin pencari AI &mdash; semua bisa disesuaikan dengan kebutuhan dan skala bisnis Anda.</p>
        </div>

        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $i => $product)
                @php
                    $hargaMin = optional($product->harga)->min('harga');
                @endphp
                <a href="{{ url('/layanan/' . $product->slug_produk) }}" class="reveal card group flex flex-col overflow-hidden" style="transition-delay: {{ ($i % 3) * 100 }}ms">
                    <div class="aspect-[16/10] w-full overflow-hidden bg-ink-100">
                        <x-product-image :product="$product" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    </div>
                    <div class="flex flex-1 flex-col p-6">
                        <h3 class="text-lg">{{ $product->nama_produk }}</h3>
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
    </div>
</section>

{{-- Klien Kami --}}
<section class="container-app py-20 sm:py-28">
    <div class="reveal mx-auto max-w-2xl text-center">
        <span class="eyebrow">Klien Kami</span>
        <h2 class="mt-4 text-3xl sm:text-4xl">Dipercaya Berbagai Bisnis dari Beragam Sektor</h2>
        <p class="mt-4 text-ink-500">Sebagian bisnis yang sudah kami bantu wujudkan solusi digitalnya.</p>
    </div>
</section>

@php
    $clientsMid = (int) ceil(count($clients) / 2);
    $clientsRow1 = array_slice($clients, 0, $clientsMid);
    $clientsRow2 = array_slice($clients, $clientsMid);
@endphp

<div class="marquee-viewport reveal relative space-y-4 overflow-hidden py-2 [mask-image:linear-gradient(90deg,transparent,#000_8%,#000_92%,transparent)]">
    <div class="marquee-track flex w-max items-center gap-6">
        @for ($rep = 0; $rep < 2; $rep++)
            @foreach ($clientsRow1 as $client)
                <div class="flex h-36 w-64 shrink-0 items-center justify-center rounded-2xl border border-ink-100 bg-white p-6 grayscale transition-all duration-300 hover:grayscale-0 hover:shadow-soft">
                    <img src="{{ asset($client['logo']) }}" alt="{{ $client['name'] }}" loading="lazy" class="max-h-20 w-auto object-contain">
                </div>
            @endforeach
        @endfor
    </div>
    @if (count($clientsRow2))
        <div class="marquee-track-reverse flex w-max items-center gap-6">
            @for ($rep = 0; $rep < 2; $rep++)
                @foreach ($clientsRow2 as $client)
                    <div class="flex h-36 w-64 shrink-0 items-center justify-center rounded-2xl border border-ink-100 bg-white p-6 grayscale transition-all duration-300 hover:grayscale-0 hover:shadow-soft">
                        <img src="{{ asset($client['logo']) }}" alt="{{ $client['name'] }}" loading="lazy" class="max-h-20 w-auto object-contain">
                    </div>
                @endforeach
            @endfor
        </div>
    @endif
</div>

<div class="container-app pb-20 sm:pb-28">
    <div class="reveal mt-10 text-center">
        <a href="{{ url('/klien-kami') }}" class="btn-outline">Lihat Semua Klien Kami</a>
    </div>
</div>

{{-- Testimonials --}}
<section class="bg-ink-950 py-20 sm:py-28">
    <div class="container-app">
        <div class="reveal mx-auto max-w-2xl text-center">
            <span class="eyebrow bg-white/10 text-white ring-1 ring-white/25">Testimoni</span>
            <h2 class="mt-4 text-3xl text-white sm:text-4xl">Kata Klien Tentang Azolatekno</h2>
        </div>

        <div class="mt-14 grid gap-6 lg:grid-cols-3">
            @foreach ($testimonials as $i => $t)
                <div class="reveal rounded-3xl border border-white/10 bg-white/5 p-8" style="transition-delay: {{ $i * 100 }}ms">
                    <svg class="h-7 w-7 text-brand-400" viewBox="0 0 32 32" fill="currentColor"><path d="M10 8c-3.3 0-6 2.7-6 6v10h10V14H8c0-1.7 1.3-3 3-3V8h-1zm14 0c-3.3 0-6 2.7-6 6v10h10V14h-6c0-1.7 1.3-3 3-3V8h-1z"/></svg>
                    <p class="mt-5 text-sm leading-relaxed text-white/85">&ldquo;{{ $t['quote'] }}&rdquo;</p>
                    <div class="mt-6">
                        <p class="text-sm font-semibold text-white">{{ $t['name'] }}</p>
                        <p class="text-xs text-white/50">{{ $t['context'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="reveal mt-10 text-center">
            <a href="{{ url('/testimonial') }}" class="btn-ghost-light">Lihat Semua Testimoni</a>
        </div>
    </div>
</section>

{{-- Blog teaser --}}
<section class="container-app py-20 sm:py-24">
    <div class="reveal card flex flex-col items-center gap-6 p-10 text-center sm:flex-row sm:justify-between sm:text-left">
        <div>
            <span class="eyebrow">Insight &amp; Blog</span>
            <h3 class="mt-3 text-2xl">Tips Website, SEO, dan AI dari Tim Kami</h3>
            <p class="mt-2 text-sm text-ink-500">Artikel praktis seputar pengembangan web, strategi SEO, dan digital marketing.</p>
        </div>
        <a href="{{ url('/artikel/') }}" class="btn-primary shrink-0">Baca Artikel</a>
    </div>
</section>

{{-- Final CTA --}}
<section class="container-app pb-24">
    <div class="reveal relative overflow-hidden rounded-3xl bg-brand-gradient px-8 py-16 text-center sm:px-16">
        <div class="pointer-events-none absolute inset-0 opacity-[0.08]" style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:22px 22px;"></div>
        <div class="relative mx-auto max-w-xl">
            <h2 class="text-3xl text-white sm:text-4xl">Siap Bertumbuh Bersama Azolatekno?</h2>
            <p class="mt-4 text-white/85">Konsultasikan kebutuhan website, SEO, atau AI bisnis Anda sekarang &mdash; gratis, tanpa komitmen.</p>
            <a href="{{ $waHref }}" target="_blank" rel="noopener" class="btn-ghost-light mt-8 bg-white text-brand-700 ring-0 hover:bg-white/90">
                Mulai Konsultasi Gratis
            </a>
        </div>
    </div>
</section>

@endsection
