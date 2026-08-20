@php
    $navLinks = [
        ['label' => 'Beranda', 'href' => url('/')],
        ['label' => 'Layanan', 'href' => url('/layanan')],
        ['label' => 'Klien Kami', 'href' => url('/klien-kami')],
        ['label' => 'Tentang Kami', 'href' => url('/about-us')],
        ['label' => 'Testimonial', 'href' => url('/testimonial')],
    ];
    $toolLinks = [
        ['label' => 'Struk Online Generator', 'href' => url('/tools/struk-online-generator')],
        ['label' => 'Invoice Generator', 'href' => url('/tools/invoice-generator-online-gratis-pdf')],
        ['label' => 'Kalkulator HPP', 'href' => url('/tools/hpp-calculator-online')],
        ['label' => 'Buat Penawaran Online', 'href' => url('/tools/quotation-penawaran-harga-online-gratis')],
        ['label' => 'Semua Tools Gratis', 'href' => url('/tools')],
    ];
    $infoLinks = [
        ['label' => 'Artikel', 'href' => url('/artikel/')],
        ['label' => 'Kontak Kami', 'href' => url('/contact-us')],
    ];
    $waHref = 'https://wa.me/6287733930143?text=' . rawurlencode('Halo admin Azolatekno, saya mau tanya jasa azolatekno.');
@endphp

<header id="site-header" class="fixed inset-x-0 top-0 z-50 border-b border-transparent bg-white/85 backdrop-blur-md transition-shadow duration-300 [&.is-scrolled]:shadow-soft [&.is-scrolled]:border-ink-100">
    <div class="container-app flex h-20 items-center justify-between py-3">
        <a href="{{ url('/') }}" class="flex shrink-0 items-center" title="Azolatekno">
            <img src="{{ asset('img/azolatekno-width.webp') }}" alt="Azolatekno" class="h-9 w-auto sm:h-10" width="180" height="40">
        </a>

        <nav class="hidden items-center gap-1 lg:flex">
            @foreach ($navLinks as $link)
                <a href="{{ $link['href'] }}" class="rounded-full px-4 py-2 text-sm font-semibold text-ink-600 transition-colors hover:bg-brand-50 hover:text-brand-700">
                    {{ $link['label'] }}
                </a>
            @endforeach

            <div class="group relative">
                <button type="button" class="flex items-center gap-1 rounded-full px-4 py-2 text-sm font-semibold text-ink-600 transition-colors hover:bg-brand-50 hover:text-brand-700">
                    Tools Gratis
                    <svg class="h-3.5 w-3.5 transition-transform group-hover:rotate-180" viewBox="0 0 20 20" fill="none"><path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div class="invisible absolute left-1/2 top-full w-72 -translate-x-1/2 pt-3 opacity-0 transition-all duration-200 group-hover:visible group-hover:opacity-100">
                    <div class="overflow-hidden rounded-2xl border border-ink-100 bg-white p-2 shadow-soft-lg">
                        @foreach ($toolLinks as $tool)
                            <a href="{{ $tool['href'] }}" class="block rounded-xl px-4 py-2.5 text-sm font-medium text-ink-700 hover:bg-brand-50 hover:text-brand-700">
                                {{ $tool['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="group relative">
                <button type="button" class="flex items-center gap-1 rounded-full px-4 py-2 text-sm font-semibold text-ink-600 transition-colors hover:bg-brand-50 hover:text-brand-700">
                    Informasi
                    <svg class="h-3.5 w-3.5 transition-transform group-hover:rotate-180" viewBox="0 0 20 20" fill="none"><path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div class="invisible absolute left-1/2 top-full w-56 -translate-x-1/2 pt-3 opacity-0 transition-all duration-200 group-hover:visible group-hover:opacity-100">
                    <div class="overflow-hidden rounded-2xl border border-ink-100 bg-white p-2 shadow-soft-lg">
                        @foreach ($infoLinks as $info)
                            <a href="{{ $info['href'] }}" class="block rounded-xl px-4 py-2.5 text-sm font-medium text-ink-700 hover:bg-brand-50 hover:text-brand-700">
                                {{ $info['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </nav>

        <div class="hidden items-center gap-3 lg:flex">
            <a href="{{ $waHref }}" target="_blank" rel="noopener" class="btn-primary">
                Konsultasi Gratis
            </a>
        </div>

        <button id="nav-toggle" type="button" aria-label="Buka menu navigasi" aria-expanded="false" class="flex h-10 w-10 items-center justify-center rounded-full text-ink-700 hover:bg-ink-50 lg:hidden">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
        </button>
    </div>
</header>

<div id="mobile-menu" class="fixed inset-0 z-40 hidden bg-white/98 pt-24 backdrop-blur-md [&.is-open]:flex" style="flex-direction:column;">
    <nav class="container-app flex flex-1 flex-col gap-1 overflow-y-auto pb-8">
        @foreach ($navLinks as $link)
            <a href="{{ $link['href'] }}" class="rounded-2xl px-4 py-3 text-lg font-semibold text-ink-800 hover:bg-brand-50">
                {{ $link['label'] }}
            </a>
        @endforeach
        <p class="mt-4 px-4 text-xs font-semibold uppercase tracking-wider text-ink-400">Tools Gratis</p>
        @foreach ($toolLinks as $tool)
            <a href="{{ $tool['href'] }}" class="rounded-2xl px-4 py-3 text-base font-medium text-ink-600 hover:bg-brand-50">
                {{ $tool['label'] }}
            </a>
        @endforeach
        <p class="mt-4 px-4 text-xs font-semibold uppercase tracking-wider text-ink-400">Informasi</p>
        @foreach ($infoLinks as $info)
            <a href="{{ $info['href'] }}" class="rounded-2xl px-4 py-3 text-base font-medium text-ink-600 hover:bg-brand-50">
                {{ $info['label'] }}
            </a>
        @endforeach
        <a href="{{ $waHref }}" target="_blank" rel="noopener" class="btn-primary mx-4 mt-4">
            Konsultasi Gratis
        </a>
    </nav>
</div>
