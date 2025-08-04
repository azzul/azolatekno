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
      "name": "Tentang Azolatekno",
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
  <h1>Tentang Azolatekno</h1>
  <p>Mitra Digital & AI Anda Sejak 2018</p>
</div>

<p class="about-description">
  <strong>Azolatekno</strong> adalah penyedia solusi teknologi digital yang berfokus pada pengembangan website, aplikasi, SEO, dan integrasi Artificial Intelligence (AI). Sejak 2018, kami telah membantu ratusan klien—dari UMKM, korporasi, hingga institusi pendidikan—dalam membangun kehadiran digital yang kuat dan berkelanjutan.
  <br><br>
  Tidak hanya membangun, kami juga mengembangkan. Website klien kami tak hanya tampil menarik, tetapi juga masuk halaman pertama Google, bahkan beberapa muncul dalam hasil referensi ChatGPT—sebagai bukti kualitas dan struktur teknis yang mumpuni.
  <br><br>
  Di tengah era transformasi digital dan revolusi AI, Azolatekno hadir sebagai mitra teknologi yang siap membawa bisnis Anda melangkah lebih jauh.
</p>

<p class="about-highlight">
  “Azolatekno – From Code to Intelligence. Solusi Digital dan AI untuk Masa Depan Bisnis Anda.”
</p>

<div class="about-content">
  <div class="about-column">
    <h2>Visi Kami</h2>
    <p>
      Menjadi perusahaan teknologi lokal yang terpercaya dan berpengaruh dalam pengembangan solusi digital dan kecerdasan buatan di Indonesia.
    </p>

    <h2>Misi Kami</h2>
    <ul>
      <li>Membantu bisnis dari berbagai skala membangun identitas digital yang kuat dan optimal.</li>
      <li>Menyediakan layanan pembuatan website dan aplikasi yang cepat, aman, dan SEO-friendly.</li>
      <li>Menawarkan layanan SEO dan digital marketing untuk meningkatkan visibilitas dan konversi.</li>
      <li>Menyediakan solusi integrasi AI yang aplikatif, efisien, dan berdampak nyata.</li>
      <li>Mengedukasi masyarakat melalui program <strong>Course Online AI</strong> berbasis praktik dan teknologi terkini.</li>
      <li>Terus berinovasi dalam layanan, mengikuti perkembangan teknologi dan kebutuhan pasar modern.</li>
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