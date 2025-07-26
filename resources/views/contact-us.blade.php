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
            <h1>Kontak Rental Mobil Jakarta Paling Terpercaya - Hafes Rent Car</h1>
        </div>
        <div class="store-card2">
            <div class="store-left">
                <h2 class="store-name text-center">HAFES RENT CAR</h2>
                <p class="store-address text-center">Ruko NEO Fierra, Jl. AMD No.33 No C-07, Pd. Kacang Bar., Kec. Pd. Aren, Kota Tangerang Selatan, Banten 15226</p>
             
                <div class="store-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.0651110584085!2d106.68439409999999!3d-6.255152700000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fbe742d63d3b%3A0x5385e3036d9c4399!2sHAFES%20MEGAH%20LESTARI!5e0!3m2!1sid!2sid!4v1749911961635!5m2!1sid!2sid" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                
                <div class="store-buttons">
                    <a href="https://maps.app.goo.gl/QBoPJcj3qEFuX5pC6" target="_blank" class="store-button" rel="nofollow noopener noreferrer">
                        <i class="fas fa-map-marker-alt"></i> Petunjuk Lokasi
                    </a>
                    <a href="https://wa.me/6282125423807?text=Halo%20Hafes%20Rent%20Car,%20Saya%20mau%20tanya%20paket%20rental%20yang%20ada%20di%20website%20https://Hafesrentcar.id" target="_blank" class="store-button" rel="nofollow noopener noreferrer">
                        <i class="fab fa-whatsapp"></i> Pesan WhatsApp
                    </a>
                </div>
            </div>
            <div class="store-right">
                <h3 class="operational-header text-center">Jam Operasional</h3>
                <ul class="operational-hours text-center">
                    <li>Senin - Minggu: 24 Jam</li>
                </ul>
                <h3 class="operational-header text-center">Whatsapp</h3>
                <p class="operational-hours text-center">+6282125423807</p>
                <p class="operational-hours text-center note pt-20">“Perjalanan hebat dimulai dari komunikasi yang baik. Hubungi kami, dan biarkan kami bantu mewujudkan perjalanan terbaik Anda.”</p>
            </div>
        </div>
    </div>
</section>


@endsection