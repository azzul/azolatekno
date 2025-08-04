@extends('layouts.app2')
@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Beranda",
      "item": "{{ url('/') }}"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Kontak Kami",
      "item": "{{ url('/contact-us') }}"
    }
  ]
}
</script>
@endpush
@section('content')
<section class="store-section-contact pt-90">
    <div class="container">
        <div class="section-header">
            <h1>Kontak Layanan Web, SEO & AI Terpercaya – Azolatekno</h1>
        </div>
        <div class="store-card2">
            <div class="store-left">
                <h2 class="store-name text-center">AZOLATEKNO</h2>
                <p class="store-address text-center">Dalon RT 03 RW 04 Desa Sroyo, Kecamatan Jaten, Kabupaten Karanganyar 57731</p>
             
                <div class="store-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3450.563634109758!2d110.8748674!3d-7.545185200000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a17f5b247614b%3A0x7a0da7fb83487657!2sAzolatekno%20Web%20dan%20android%20developer!5e1!3m2!1sen!2sid!4v1754290730554!5m2!1sen!2sid" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                
                <div class="store-buttons">
                    <a href="https://maps.app.goo.gl/gFkE8o9RDReEhshq5" target="_blank" class="store-button" rel="nofollow noopener noreferrer">
                        <i class="fas fa-map-marker-alt"></i> Petunjuk Lokasi
                    </a>
                    <a href="https://wa.me/6287733930143?text=Halo%20Azolatekno,%20Saya%20tertarik%20dengan%20layanan%20web%2FSEO%20%2F%20AI%20yang%20ada%20di%20website%20https://azolatekno.com" target="_blank" class="store-button" rel="nofollow noopener noreferrer">
                        <i class="fab fa-whatsapp"></i> Konsultasi via WhatsApp
                    </a>
                </div>
            </div>
            <div class="store-right">
                <h3 class="operational-header text-center">Jam Operasional</h3>
                <ul class="operational-hours text-center">
                    <li>Senin - Sabtu: 08.00 – 21.00 WIB</li>
                    <li>Minggu & Libur Nasional: Tetap Melayani via WhatsApp</li>
                </ul>
                <h3 class="operational-header text-center">Whatsapp</h3>
                <p class="operational-hours text-center">+6287733930143</p>
                <p class="operational-hours text-center note pt-20">“Kami percaya masa depan dimulai dari diskusi hari ini. Hubungi Azolatekno untuk solusi digital yang relevan dengan kebutuhan Anda.”</p>
            </div>
        </div>
    </div>
</section>


@endsection