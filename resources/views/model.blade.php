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
      "name": "Layanan Kami",
      "item": "{{ url('/layanan') }}"
    }
  ]
}
</script>
@endpush
@push('preload')
    @foreach($products->take(3) as $product)
        <link rel="preload" as="image" href="{{ asset('img/product/' . $product->image_produk) }}">
    @endforeach
@endpush
@section('content')
    <section id="breadcrumb-section-about" >
        <div class="custom-container">
            <div class="breadcrumb-text">
                 <a href="{{ url('/') }}">Beranda</a> / 
                <span class="W-500">Layanan Kami</span>
            </div>
        </div>
    </section>
    
<section id="layanan">
    <div class="custom-container">
        <div class="section-header">
            <h1>Layanan Web, SEO, Digital, AI dan Course AI</h1>
        </div>
        <div class="product-grid">
            @foreach($products as $product)
                <div class="card-product">
                    <a href="{{ url('/layanan/' . $product->slug_produk) }}">
                        <div class="product-image-wrapper">
                            @foreach($products as $product)
                            <div class="card-product">
                                <a href="{{ url('/layanan/' . $product->slug_produk) }}">
                                    <div class="product-image-wrapper">
                                        <x-responsive-img 
                                            src="{{ 'img/product/' . $product->image_produk }}"
                                            alt="{{ $product->nama_produk }}"
                                            class="card-product-img"
                                            loading="{{ $loop->iteration <= 3 ? 'eager' : 'lazy' }}"
                                        />
                                    </div>
                                    <div class="product-content">
                                        <p class="product-content-tittle">{{ $product->nama_produk }}</p>
                                        {!! $product->spesifikasi !!}
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        </div>
                        <div class="product-content">
                            <p class="product-content-tittle">{{$product->nama_produk}}</p>

                           {!!$product->spesifikasi!!}
                        </div>
                    </a>
                </div>
            @endforeach
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
                <x-responsive-img 
                    src="{{ asset('img/icon/custom-solution.webp') }}"
                    alt="Pembuatan Website dan Aplikasi Sesuai Kebutuhan"
                    class="why-img"
                    width="120"
                    height="120"
                />
                <div class="why-us-info">
                    <h3>Solusi Aplikasi & Website Custom</h3>
                    <p>Setiap proyek dirancang khusus untuk memenuhi kebutuhan bisnis Anda—dari tampilan hingga fungsionalitas.</p>
                </div>
            </div>

            <div class="why-us-item">
                <x-responsive-img 
                    src="{{ asset('img/icon/seo-optimized.webp') }}"
                    alt="Website SEO Friendly Top 1 Google"
                    class="why-img"
                    width="120"
                    height="120"
                />
                <div class="why-us-info">
                    <h3>Website SEO Friendly – Banyak Masuk Halaman 1 Google</h3>
                    <p>Website yang kami kembangkan telah terbukti menembus peringkat #1 Google di berbagai kata kunci lokal maupun nasional.</p>
                </div>
            </div>

            <div class="why-us-item">
                <x-responsive-img 
                    src="{{ asset('img/icon/ai-integration.webp') }}"
                    alt="Integrasi Kecerdasan Buatan AI untuk Bisnis"
                    class="why-img"
                    width="120"
                    height="120"
                />
                <div class="why-us-info">
                    <h3>Integrasi AI & Automasi Bisnis</h3>
                    <p>Kami bantu bisnis Anda lebih efisien dengan solusi AI seperti chatbot, workflow otomatis, dan analitik prediktif.</p>
                </div>
            </div>

            <div class="why-us-item">
                <x-responsive-img 
                    src="{{ asset('img/icon/recognized.webp') }}"
                    alt="Website Rekomendasi ChatGPT"
                    class="why-img"
                    width="120"
                    height="120"
                />
                <div class="why-us-info">
                    <h3>Direkomendasikan oleh ChatGPT</h3>
                    <p>Beberapa website klien Azolatekno telah muncul sebagai rekomendasi terpercaya dari ChatGPT karena struktur dan performanya yang optimal.</p>
                </div>
            </div>

            <div class="why-us-item">
                <x-responsive-img 
                    src="{{ asset('img/icon/digital-shift.webp') }}"
                    alt="Era Digital dan AI Marketing"
                    class="why-img"
                    width="120"
                    height="120"
                />
                <div class="why-us-info">
                    <h3>Bisnis Harus Hadir di Era AI</h3>
                    <p>Dunia digital telah bergeser: kehadiran Anda tidak cukup hanya di Google. Muncul di rekomendasi platform AI seperti ChatGPT adalah langkah strategis yang kami bantu wujudkan.</p>
                </div>
            </div>

            <div class="why-us-item">
                <x-responsive-img 
                    src="{{ asset('img/icon/ai-course.webp') }}"
                    alt="Kursus AI untuk Pemula dan Profesional"
                    class="why-img"
                    width="120"
                    height="120"
                />
                <div class="why-us-info">
                    <h3>Kursus AI Praktis & Terarah</h3>
                    <p>Azolatekno juga menyediakan pelatihan AI dengan pendekatan hands-on dan kurikulum yang disusun berdasarkan kebutuhan industri terkini—cocok untuk pemula maupun profesional.</p>
                </div>
            </div>

        </div>
    </div>
</section>


@endsection