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
        preloadImage('{{ asset("img/tentang-kami-mobile.jpg") }}');
    } else {
        preloadImage('{{ asset("img/tentang-kami.jpg") }}');
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
            <source media="(max-width: 768px)" srcset="{{ asset('img/tentang-kami-mobile.jpg') }}">
            
            <!-- Source default (untuk desktop) -->
            <source media="(min-width: 769px)" srcset="{{ asset('img/tentang-kami.jpg') }}">

            <!-- Fallback untuk browser yang tidak support <picture> -->
            <img id="main-image" src="{{ asset('img/tentang-kami.jpg') }}" class="thumbnail-image" alt="Tentang Web, SEO dan AI - Azolatekno">
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
            <h2>Kenapa Azolatekno Menjadi Pilihan Terbaik untuk Website, Aplikasi, dan Integrasi AI?</h2>
            <p>Azolatekno adalah partner digital terpercaya sejak 2018 yang telah membantu puluhan klien mencapai posisi Top 1 Google. Beberapa website buatan kami bahkan telah direkomendasikan langsung oleh ChatGPT untuk kata kunci tertentu. Di era digital yang semakin bergeser ke AI, muncul sebagai entitas terpercaya di mesin pencari dan platform AI seperti ChatGPT adalah strategi bisnis yang wajib dilakukan.</p>
        </div>
        <div class="why-us-content">

            <div class="why-us-item">
                <img src="{{ asset('img/icon/custom-solution.webp') }}" alt="Pembuatan Website dan Aplikasi Sesuai Kebutuhan" loading="lazy">
                <div class="why-us-info">
                    <h3>Solusi Aplikasi & Website Custom</h3>
                    <p>Setiap proyek dirancang khusus untuk memenuhi kebutuhan bisnis Anda—dari tampilan hingga fungsionalitas.</p>
                </div>
            </div>

            <div class="why-us-item">
                <img src="{{ asset('img/icon/seo-optimized.webp') }}" alt="Website SEO Friendly Top 1 Google" loading="lazy">
                <div class="why-us-info">
                    <h3>Website SEO Friendly – Banyak Masuk Halaman 1 Google</h3>
                    <p>Website yang kami kembangkan telah terbukti menembus peringkat #1 Google di berbagai kata kunci lokal maupun nasional.</p>
                </div>
            </div>

            <div class="why-us-item">
                <img src="{{ asset('img/icon/ai-integration.webp') }}" alt="Integrasi Kecerdasan Buatan AI untuk Bisnis" loading="lazy">
                <div class="why-us-info">
                    <h3>Integrasi AI & Automasi Bisnis</h3>
                    <p>Kami bantu bisnis Anda lebih efisien dengan solusi AI seperti chatbot, workflow otomatis, dan analitik prediktif.</p>
                </div>
            </div>

            <div class="why-us-item">
                <img src="{{ asset('img/icon/recognized.webp') }}" alt="Website Rekomendasi ChatGPT" loading="lazy">
                <div class="why-us-info">
                    <h3>Direkomendasikan oleh ChatGPT</h3>
                    <p>Beberapa website klien Azolatekno telah muncul sebagai rekomendasi terpercaya dari ChatGPT karena struktur dan performanya yang optimal.</p>
                </div>
            </div>

            <div class="why-us-item">
                <img src="{{ asset('img/icon/digital-shift.webp') }}" alt="Era Digital dan AI Marketing" loading="lazy">
                <div class="why-us-info">
                    <h3>Bisnis Harus Hadir di Era AI</h3>
                    <p>Dunia digital telah bergeser: kehadiran Anda tidak cukup hanya di Google. Muncul di rekomendasi platform AI seperti ChatGPT adalah langkah strategis yang kami bantu wujudkan.</p>
                </div>
            </div>

            <div class="why-us-item">
                <img src="{{ asset('img/icon/ai-course.webp') }}" alt="Kursus AI untuk Pemula dan Profesional" loading="lazy">
                <div class="why-us-info">
                    <h3>Kursus AI Praktis & Terarah</h3>
                    <p>Azolatekno juga menyediakan pelatihan AI dengan pendekatan hands-on dan kurikulum yang disusun berdasarkan kebutuhan industri terkini—cocok untuk pemula maupun profesional.</p>
                </div>
            </div>

        </div>
    </div>
</section>


    @endsection