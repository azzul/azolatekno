@extends('layouts.app')

@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}" },
    { "@type": "ListItem", "position": 2, "name": "Kontak Kami", "item": "{{ url('/contact-us') }}" }
  ]
}
</script>
@endpush

@section('content')

@php
    $waHref = 'https://wa.me/6285129370703?text=' . rawurlencode('Halo Azolatekno, saya tertarik dengan layanan web/SEO/AI yang ada di website https://azolatekno.com');
@endphp

<section class="relative overflow-hidden bg-ink-950 pb-24 pt-36 sm:pb-28 sm:pt-44">
    <div class="pointer-events-none absolute inset-0 bg-brand-gradient opacity-[0.85]"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.07]" style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:26px 26px;"></div>

    <div class="container-app relative">
        <nav class="text-sm text-white/70">
            <a href="{{ url('/') }}" class="hover:text-white">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-white">Kontak Kami</span>
        </nav>

        <div class="mx-auto mt-6 max-w-2xl text-center">
            <span class="eyebrow bg-white/10 text-white ring-1 ring-white/25">Kontak</span>
            <h1 class="mt-5 text-4xl font-semibold text-white sm:text-5xl">Diskusikan Kebutuhan Digital Anda</h1>
            <p class="mx-auto mt-5 max-w-xl text-white/80">
                Kami percaya masa depan dimulai dari diskusi hari ini. Hubungi Azolatekno untuk solusi digital yang relevan dengan kebutuhan bisnis Anda.
            </p>
        </div>
    </div>
</section>

<section class="container-app py-20 sm:py-24">
    <div class="mx-auto grid max-w-5xl gap-6 lg:grid-cols-5">
        <div class="reveal card overflow-hidden lg:col-span-3">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3450.563634109758!2d110.8748674!3d-7.545185200000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a17f5b247614b%3A0x7a0da7fb83487657!2sAzolatekno%20Web%20dan%20android%20developer!5e1!3m2!1sen!2sid!4v1754290730554!5m2!1sen!2sid"
                width="100%" height="360" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                class="block"
            ></iframe>
            <div class="p-8">
                <h2 class="text-xl">AZOLATEKNO</h2>
                <p class="mt-2 text-sm leading-relaxed text-ink-500">Dalon RT 03 RW 04 Desa Sroyo, Kecamatan Jaten, Kabupaten Karanganyar 57731</p>
                <a href="https://maps.app.goo.gl/gFkE8o9RDReEhshq5" target="_blank" rel="nofollow noopener noreferrer" class="btn-outline mt-5">
                    Petunjuk Lokasi
                </a>
            </div>
        </div>

        <div class="reveal card flex flex-col p-8 lg:col-span-2" style="transition-delay: 100ms">
            <span class="eyebrow w-fit">Jam Operasional</span>
            <ul class="mt-4 space-y-2 text-sm text-ink-600">
                <li>Senin &ndash; Sabtu: 08.00 &ndash; 21.00 WIB</li>
                <li>Minggu &amp; Libur Nasional: Tetap melayani via WhatsApp</li>
            </ul>

            <div class="mt-6 border-t border-ink-100 pt-6">
                <span class="eyebrow w-fit">WhatsApp</span>
                <p class="mt-3 text-lg font-semibold text-ink-900">+62 851 2937 0703</p>
                <a href="{{ $waHref }}" target="_blank" rel="nofollow noopener noreferrer" class="btn-primary mt-4 w-full">
                    Konsultasi via WhatsApp
                </a>
            </div>

            <p class="mt-6 flex-1 text-sm italic leading-relaxed text-ink-400">
                &ldquo;Kami percaya masa depan dimulai dari diskusi hari ini. Hubungi Azolatekno untuk solusi digital yang relevan dengan kebutuhan Anda.&rdquo;
            </p>
        </div>
    </div>
</section>

@endsection
