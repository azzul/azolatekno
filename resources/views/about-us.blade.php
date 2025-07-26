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
      "name": "Tentang Kami",
      "item": "{{ url('/about-us') }}"
    }
  ]
}
</script>
@endpush
@push('scripts')
<script>

    if (isMobile) {
        preloadImage('{{ asset("img/tentang-rental-mobil-jakarta-small.jpg") }}');
    } else {
        preloadImage('{{ asset("img/tentang-rental-mobil-jakarta.jpg") }}');
    }
</script>
@endpush
@section('content')

    <!-- Navigasi Breadcrumb -->
    <section id="breadcrumb-section-about pt-90" >
        <div class="custom-container">
            <div class="breadcrumb-text">
                 <a href="{{ url('/') }}">Beranda</a> / 
                <span class="W-500">Tentang Kami</span>
            </div>
        </div>
    </section>

    <section class="about-us-section">
      <div class="custom-container ">
        <div class="flex-main-image">
            <picture>
            <!-- Source untuk layar kecil -->
            <source media="(max-width: 768px)" srcset="{{ asset('img/tentang-rental-mobil-jakarta-small.jpg') }}">
            
            <!-- Source default (untuk desktop) -->
            <source media="(min-width: 769px)" srcset="{{ asset('img/tentang-rental-mobil-jakarta.jpg') }}">

            <!-- Fallback untuk browser yang tidak support <picture> -->
            <img id="main-image" src="{{ asset('img/tentang-rental-mobil-jakarta.jpg') }}" class="thumbnail-image" alt="Tentang Rental Mobil Jakarta - Hafes Rent Car">
        </picture>
    </div>
       <div class="section-header">
  <h1>Tentang Hafes Megah Lestari</h1>
  <p></p>
</div>

<p class="about-description">
  <strong>PT Hafes Megah Lestari</strong> adalah penyedia jasa rental mobil profesional berbasis di Jakarta. Kami dikenal sebagai rental mobil middle hingga premium, dengan armada elegan berwarna gelap dan layanan sopir ahli.
  <br><br>
  Terbuka untuk kebutuhan perorangan, bisnis, maupun acara spesial—layanan kami dapat dipesan online 24/7, lengkap dengan sopir berpengalaman dan ramah yang selalu siap di setiap waktu.
  <br><br>
  Armada kami mencakup kendaraan seperti Avanza, Innova, Pajero, serta kelas premium—semua dirawat dengan standar tinggi demi kenyamanan dan keamanan Anda selama perjalanan.
</p>

<p class="about-highlight">
  “Hafes MegahLestari – Rental Mobil Elegan, Profesional, dan Andal di Jakarta”
</p>

<div class="about-content">
  <div class="about-column">
    <h2>Visi Kami</h2>
    <p>
      Menjadi perusahaan rental mobil premium paling tepercaya di Jakarta, memberikan layanan yang unggul, aman, dan memberi nilai lebih bagi pelanggan.
    </p>

    <h2>Misi Kami</h2>
    <ul>
      <li>Menghadirkan kemudahan pemesanan via online 24/7, kapan pun Anda butuh kendaraan.</li>
      <li>Memastikan armada elegan kami selalu dalam kondisi prima, bersih, dan nyaman.</li>
      <li>Menyediakan sopir profesional yang berpengalaman, tepat waktu, dan siap membantu setiap kebutuhan Anda.</li>
      <li>Menawarkan pilihan paket harga fleksibel—tanpa biaya tersembunyi—untuk perjalanan perorangan, bisnis, atau event.</li>
      <li>Menjalin kepercayaan melalui pelayanan yang jujur, bertanggung jawab, dan peduli terhadap detail.</li>
      <li>Terus berinovasi untuk menghadirkan teknologi dan layanan yang relevan bagi mobilitas urban modern.</li>
    </ul>
  </div>
</div>


    </section>

  <section id="why-us">
    <div class="custom-container">
        <div class="section-header">
            <h2>Bukan Sembarang Rental: Ini Rahasia Sukses Hafes Megah Lestari</h2>
            
        </div>
        <div class="why-us-content">

            <div class="why-us-item">
                <img src="{{ asset('img/icon/fleet.webp') }}" alt="Armada Variatif" loading="lazy">
                <div class="why-us-info">
                    <h3>Armada Lengkap & Terupdate</h3>
                    <p>Dari city car, MPV, hingga kendaraan eksekutif—PT Hafes Megah Lestari menghadirkan solusi perjalanan untuk segala kebutuhan Anda, pribadi maupun bisnis.</p>
                </div>
            </div>

            <div class="why-us-item">
                <img src="{{ asset('img/icon/comfort.webp') }}" alt="Kendaraan Bersih dan Nyaman" loading="lazy">
                <div class="why-us-info">
                    <h3>Mobil Bersih, AC Dingin, Siap Jalan</h3>
                    <p>Setiap kendaraan kami dirawat secara berkala dan dibersihkan sebelum digunakan, memberikan kenyamanan maksimal untuk setiap perjalanan.</p>
                </div>
            </div>

            <div class="why-us-item">
                <img src="{{ asset('img/icon/driver.webp') }}" alt="Sopir Handal Jakarta" loading="lazy">
                <div class="why-us-info">
                    <h3>Sopir Berpengalaman Lokal Jakarta</h3>
                    <p>Kami hanya mempekerjakan sopir yang hafal rute-rute strategis di Jakarta dan sekitarnya, ramah, tepat waktu, dan siap membantu Anda selama perjalanan.</p>
                </div>
            </div>

            <div class="why-us-item">
                <img src="{{ asset('img/icon/price-tag.webp') }}" alt="Rental Mobil Harga Wajar" loading="lazy">
                <div class="why-us-info">
                    <h3>Harga Transparan & Fleksibel</h3>
                    <p>Tidak ada biaya tersembunyi. PT Hafes Megah Lestari memberikan harga jujur dan paket rental yang bisa disesuaikan dengan durasi dan tujuan Anda.</p>
                </div>
            </div>

        </div>
    </div>
</section>

    @endsection