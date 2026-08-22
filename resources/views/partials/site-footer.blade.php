@php
    $waHref = 'https://wa.me/6287733930143?text=' . rawurlencode('Halo admin Azolatekno, saya mau tanya jasa azolatekno.');
    $footerYear = date('Y');
@endphp

<footer class="relative overflow-hidden bg-ink-950 pb-10 pt-20 text-ink-300">
    <div class="pointer-events-none absolute -top-40 right-0 h-96 w-96 rounded-full bg-brand-600/20 blur-3xl"></div>

    <div class="container-app relative grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-6">
        <div class="sm:col-span-2 lg:col-span-2">
            <img src="{{ asset('img/azolatekno-width.webp') }}" alt="Azolatekno" class="h-9 w-auto" style="filter: brightness(0) invert(1);" loading="lazy">
            <p class="mt-4 max-w-xs text-sm leading-relaxed text-ink-400">
                Partner solusi digital &mdash; website, SEO, AIO, dan integrasi AI untuk bisnis Anda tumbuh lebih cepat.
            </p>
            <ul class="mt-5 space-y-2 text-sm text-ink-400">
                <li><a href="tel:+6285129370703" class="hover:text-brand-400">+62 851 2937 0703</a></li>
                <li><a href="mailto:info@azolatekno.com" class="hover:text-brand-400">info@azolatekno.com</a></li>
                <li>Karanganyar, Jawa Tengah</li>
            </ul>
            <div class="mt-5 flex items-center gap-3">
                <a href="{{ $waHref }}" target="_blank" rel="noopener" class="btn-primary text-sm">
                    Chat WhatsApp
                </a>
            </div>
        </div>

        <div class="lg:col-span-2">
            <p class="text-sm font-semibold uppercase tracking-wider text-white">Layanan</p>
            <a href="{{ url('/layanan') }}" class="mt-4 inline-block text-sm font-semibold text-brand-400 hover:text-brand-300">Semua Layanan &rarr;</a>
            <ul class="mt-3 grid grid-cols-1 gap-x-6 gap-y-2.5 text-sm sm:grid-cols-2">
                @foreach ($footerCategory ?? [] as $service)
                    <li><a href="{{ url('/layanan/' . $service->slug_produk) }}" class="hover:text-brand-400">{{ $service->nama_produk }}</a></li>
                @endforeach
            </ul>
            <a href="{{ url('/pricelist') }}" class="mt-3 inline-block text-sm hover:text-brand-400">Daftar Harga &rarr;</a>
        </div>

        <div>
            <p class="text-sm font-semibold uppercase tracking-wider text-white">Perusahaan</p>
            <ul class="mt-4 space-y-2.5 text-sm">
                <li><a href="{{ url('/about-us') }}" class="hover:text-brand-400">Tentang Kami</a></li>
                <li><a href="{{ url('/klien-kami') }}" class="hover:text-brand-400">Klien Kami</a></li>
                <li><a href="{{ url('/testimonial') }}" class="hover:text-brand-400">Testimonial</a></li>
                <li><a href="{{ url('/artikel/') }}" class="hover:text-brand-400">Artikel &amp; Insight</a></li>
                <li><a href="{{ url('/contact-us') }}" class="hover:text-brand-400">Hubungi Kami</a></li>
            </ul>
        </div>

        <div>
            <p class="text-sm font-semibold uppercase tracking-wider text-white">Tools Gratis</p>
            <ul class="mt-4 space-y-2.5 text-sm">
                <li><a href="{{ url('/tools/struk-online-generator') }}" class="hover:text-brand-400">Struk Online Generator</a></li>
                <li><a href="{{ url('/tools/invoice-generator-online-gratis-pdf') }}" class="hover:text-brand-400">Invoice Generator</a></li>
                <li><a href="{{ url('/tools/hpp-calculator-online') }}" class="hover:text-brand-400">Kalkulator HPP</a></li>
                <li><a href="{{ url('/tools/quotation-penawaran-harga-online-gratis') }}" class="hover:text-brand-400">Buat Penawaran</a></li>
            </ul>
        </div>
    </div>

    <div class="container-app relative mt-14 flex flex-col gap-3 border-t border-white/10 pt-6 text-xs text-ink-500 sm:flex-row sm:items-center sm:justify-between">
        <p>&copy; {{ $footerYear }} Azolatekno. Seluruh hak cipta dilindungi.</p>
        <div class="flex flex-wrap gap-x-5 gap-y-2">
            <a href="{{ url('/privacy-policy') }}" class="hover:text-brand-400">Kebijakan Privasi</a>
            <a href="{{ url('/terms-conditions') }}" class="hover:text-brand-400">Syarat &amp; Ketentuan</a>
            <a href="{{ url('/license-info') }}" class="hover:text-brand-400">Informasi Lisensi</a>
        </div>
    </div>
</footer>

<a
    href="{{ $waHref }}"
    target="_blank"
    rel="noopener"
    aria-label="Chat WhatsApp Azolatekno"
    class="fixed bottom-5 right-5 z-40 flex h-14 w-14 items-center justify-center rounded-full bg-[#25d366] text-white shadow-soft-lg transition-transform hover:scale-105"
>
    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.46 0-9.9 4.44-9.9 9.9 0 1.75.46 3.45 1.32 4.95L2 22l5.3-1.39a9.9 9.9 0 0 0 4.74 1.21h.01c5.46 0 9.9-4.44 9.9-9.9S17.5 2 12.04 2Zm5.8 14.14c-.24.68-1.4 1.3-1.93 1.35-.5.05-1.02.24-3.44-.72-2.9-1.16-4.76-4.1-4.9-4.3-.14-.2-1.17-1.56-1.17-2.97 0-1.4.74-2.09 1-2.38.26-.28.57-.35.76-.35h.55c.18 0 .42-.07.65.5.24.58.8 2 .87 2.14.07.14.12.31.02.5-.1.19-.15.31-.3.48-.15.17-.32.38-.45.5-.15.15-.31.31-.13.6.17.3.77 1.27 1.66 2.06 1.14 1.02 2.1 1.33 2.4 1.48.3.15.47.13.65-.08.18-.2.76-.88.96-1.19.2-.3.4-.25.66-.15.27.1 1.71.81 2 .96.3.15.5.22.57.35.07.13.07.75-.17 1.43Z"/></svg>
</a>
