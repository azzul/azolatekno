@extends('layouts.app')

@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}" },
    { "@type": "ListItem", "position": 2, "name": "Tentang Kami", "item": "{{ url('/about-us') }}" }
  ]
}
</script>
@endpush

@section('content')

@php
    $waHref = 'https://wa.me/6287733930143?text=' . rawurlencode('Halo admin Azolatekno, saya mau konsultasi kebutuhan digital bisnis saya.');

    $whyUs = [
        [
            'title' => 'Solusi Custom, Bukan Template',
            'desc' => 'Setiap project dirancang khusus untuk memenuhi kebutuhan bisnis Anda — dari tampilan hingga fungsionalitas.',
            'icon' => 'code',
        ],
        [
            'title' => 'SEO Friendly Sejak Awal',
            'desc' => 'Website yang kami kembangkan terbukti menembus halaman 1 Google di berbagai kata kunci lokal maupun nasional.',
            'icon' => 'search',
        ],
        [
            'title' => 'Integrasi AI & Automasi',
            'desc' => 'Kami bantu bisnis Anda lebih efisien dengan solusi AI seperti chatbot, workflow otomatis, dan analitik prediktif.',
            'icon' => 'cpu',
        ],
        [
            'title' => 'Siap untuk Era AI Search',
            'desc' => 'Struktur konten kami dioptimalkan supaya mudah dikutip AI Overview, ChatGPT, dan answer engine lain — bukan cuma Google klasik.',
            'icon' => 'sparkle',
        ],
        [
            'title' => 'Terukur & Transparan',
            'desc' => 'Progress dan hasil dilaporkan berkala — Anda selalu tahu di mana posisi project Anda.',
            'icon' => 'chart',
        ],
        [
            'title' => 'Edukasi Lewat Course AI',
            'desc' => 'Kami juga menyediakan pelatihan AI praktis berbasis kebutuhan industri, untuk pemula maupun profesional.',
            'icon' => 'academic',
        ],
    ];

    $icons = [
        'code' => '<path d="M9 8L4 12l5 4M15 8l5 4-5 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
        'search' => '<circle cx="11" cy="11" r="6" stroke="currentColor" stroke-width="1.8"/><path d="M20 20l-4.5-4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>',
        'cpu' => '<rect x="7" y="7" width="10" height="10" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M9 3v3M15 3v3M9 18v3M15 18v3M3 9h3M3 15h3M18 9h3M18 15h3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>',
        'sparkle' => '<path d="M12 3l1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8L12 3z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>',
        'chart' => '<path d="M4 19V9M11 19V4M18 19v-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>',
        'academic' => '<path d="M3 9l9-4 9 4-9 4-9-4z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M7 11v5c0 1 2.2 2 5 2s5-1 5-2v-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
    ];
@endphp

{{-- Hero --}}
<section class="relative overflow-hidden bg-ink-950 pb-24 pt-36 sm:pb-28 sm:pt-44">
    <div class="pointer-events-none absolute inset-0 bg-brand-gradient opacity-[0.85]"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.07]" style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:26px 26px;"></div>
    <div class="pointer-events-none absolute -left-24 top-1/3 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>

    <div class="container-app relative">
        <nav class="text-sm text-white/70">
            <a href="{{ url('/') }}" class="hover:text-white">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-white">Tentang Kami</span>
        </nav>

        <div class="mx-auto mt-6 max-w-2xl text-center">
            <span class="eyebrow bg-white/10 text-white ring-1 ring-white/25">Sejak 2018</span>
            <h1 class="mt-5 text-4xl font-semibold text-white sm:text-5xl">Mitra Digital &amp; AI untuk Bisnis Anda</h1>
            <p class="mx-auto mt-5 max-w-xl text-white/80">
                Azolatekno &mdash; From Code to Intelligence. Kami membantu bisnis membangun kehadiran digital yang kuat, terukur, dan siap untuk era pencarian berbasis AI.
            </p>
        </div>
    </div>
</section>

{{-- About description --}}
<section class="container-app py-20 sm:py-24">
    <div class="mx-auto max-w-3xl">
        <div class="reveal space-y-5 text-base leading-relaxed text-ink-600">
            <p>
                <strong class="text-ink-900">Azolatekno</strong> adalah penyedia solusi teknologi digital yang berfokus pada pengembangan website, aplikasi, SEO, dan integrasi Artificial Intelligence (AI). Sejak 2018, kami membantu klien dari UMKM, korporasi, hingga institusi pendidikan membangun kehadiran digital yang kuat dan berkelanjutan.
            </p>
            <p>
                Tidak hanya membangun, kami juga mengembangkan. Website klien kami tidak hanya tampil menarik, tapi juga dirancang untuk struktur teknis yang kuat &mdash; supaya mudah ditemukan di Google maupun dikutip oleh answer engine berbasis AI.
            </p>
            <p>
                Di tengah era transformasi digital, Azolatekno hadir sebagai mitra teknologi yang siap membawa bisnis Anda melangkah lebih jauh.
            </p>
        </div>

        <div class="reveal mt-10 grid gap-6 sm:grid-cols-2">
            <div class="card p-8">
                <span class="eyebrow">Visi Kami</span>
                <p class="mt-4 text-sm leading-relaxed text-ink-600">
                    Menjadi perusahaan teknologi lokal yang terpercaya dan berpengaruh dalam pengembangan solusi digital dan kecerdasan buatan di Indonesia.
                </p>
            </div>
            <div class="card p-8">
                <span class="eyebrow">Misi Kami</span>
                <ul class="mt-4 space-y-2.5 text-sm leading-relaxed text-ink-600">
                    <li class="flex gap-2"><span class="text-brand-600">&bull;</span> Membangun identitas digital yang kuat untuk bisnis segala skala.</li>
                    <li class="flex gap-2"><span class="text-brand-600">&bull;</span> Website & aplikasi yang cepat, aman, dan SEO-friendly.</li>
                    <li class="flex gap-2"><span class="text-brand-600">&bull;</span> Layanan SEO & digital marketing untuk visibilitas dan konversi.</li>
                    <li class="flex gap-2"><span class="text-brand-600">&bull;</span> Solusi integrasi AI yang aplikatif dan berdampak nyata.</li>
                    <li class="flex gap-2"><span class="text-brand-600">&bull;</span> Edukasi lewat Course Online AI berbasis praktik.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Why us --}}
<section class="bg-ink-50/60 py-20 sm:py-28">
    <div class="container-app">
        <div class="reveal mx-auto max-w-2xl text-center">
            <span class="eyebrow">Kenapa Azolatekno</span>
            <h2 class="mt-4 text-3xl sm:text-4xl">Partner Terpercaya untuk Website, Aplikasi & AI</h2>
            <p class="mt-4 text-ink-500">Azolatekno telah membantu puluhan klien mencapai posisi #1 Google, dan menyiapkan struktur konten yang relevan untuk era pencarian berbasis AI.</p>
        </div>

        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($whyUs as $i => $item)
                <div class="reveal card p-8" style="transition-delay: {{ ($i % 3) * 100 }}ms">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-50 text-brand-700">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">{!! $icons[$item['icon']] !!}</svg>
                    </div>
                    <h3 class="mt-5 text-lg">{{ $item['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-ink-500">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="container-app py-20 sm:py-24">
    <div class="reveal relative overflow-hidden rounded-3xl bg-brand-gradient px-8 py-16 text-center sm:px-16">
        <div class="pointer-events-none absolute inset-0 opacity-[0.08]" style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:22px 22px;"></div>
        <div class="relative mx-auto max-w-xl">
            <h2 class="text-3xl text-white sm:text-4xl">Mari Diskusikan Kebutuhan Digital Anda</h2>
            <p class="mt-4 text-white/85">Konsultasi gratis, tanpa komitmen &mdash; kami bantu petakan solusi yang paling sesuai untuk bisnis Anda.</p>
            <a href="{{ $waHref }}" target="_blank" rel="noopener" class="btn-ghost-light mt-8 bg-white text-brand-700 ring-0 hover:bg-white/90">
                Mulai Konsultasi Gratis
            </a>
        </div>
    </div>
</section>

@endsection
