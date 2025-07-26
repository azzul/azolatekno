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
      "name": "Armada Kami",
      "item": "{{ url('/armada') }}"
    }
  ]
}
</script>
@endpush
@push('scripts')
<script>

    if (isMobile) {
        preloadImage('{{ asset("img/armada-rental-mobil-jakarta-small.jpg") }}');
    } else {
        preloadImage('{{ asset("img/armada-rental-mobil-jakarta.jpg") }}');
    }
</script>
@endpush
@section('content')
    <section id="breadcrumb-section-about" >
        <div class="custom-container">
            <div class="breadcrumb-text">
                 <a href="{{ url('/') }}">Beranda</a> / 
                <span class="W-500">Armada Kami</span>
            </div>
        </div>
    </section>
    <section id="image-page">
        <div class="custom-container">
             <picture>
            <!-- Source untuk layar kecil -->
            <source media="(max-width: 768px)" srcset="{{ asset('img/armada-rental-mobil-jakarta-small.jpg') }}">
            
            <!-- Source default (untuk desktop) -->
            <source media="(min-width: 769px)" srcset="{{ asset('img/armada-rental-mobil-jakarta.jpg') }}">

            <!-- Fallback untuk browser yang tidak support <picture> -->
            <img src="{{ asset('img/armada-rental-mobil-jakarta.jpg') }}" class="image-page" alt="Armada Rental Mobil Jakarta - PT Hafes Megah Lestari" >
        </picture>
        </div>
    </section>
<section id="armada">
    <div class="custom-container">
        <div class="section-header">
            <h2>Pilihan Armada Rental Mobil - Hafes Rent Car</h2>
        </div>
        <div class="product-grid">
            @foreach($products as $product)
            @if($loop->index < 3) {{-- Preload hanya untuk 3 gambar pertama --}}
                @push('preload')
                    <link rel="preload" as="image" href="{{ asset('img/product/' . $product->image_produk) }}">
                @endpush
            @endif
                <div class="card-product">
                     <a href="{{ url('/armada/' . $product->slug_produk) }}" >
                    <img src="{{ asset('img/product/' . $product->image_produk)}}" alt="{{$product->nama_produk}}" loading="lazy">
                    <div class="product-content">
                        <p class="product-content-tittle ">{{$product->nama_produk}}</p>
                        @foreach ($product->harga as $harga)
                        <div class="description">{{ $harga->jenisHarga->jenis_harga }}</div>
                        <p class="product-content-price ">Rp {{ number_format($harga->harga, 0, ',', '.') }}</p>
                      @endforeach
                        
                        <div class="product-buttons">
                             @php
                                $phone = '6282125423807';
                                $message = "Halo admin Hafes Rent Car, saya mau tanya " . $product->nama_produk . ". Saya dapat info dari " . url()->current();
                                $whatsappChat = "https://wa.me/" . preg_replace('/[^0-9]/', '', $phone) . "?text=" . urlencode($message);
                            @endphp
                                <a class="btn buy-btn" href="{{$whatsappChat}}" target="_blank" rel="nofollow noopener noreferrer">Hubungi Kami</a>
                                <!-- <button class="btn sample-btn">Sample Gratis</button> -->
                            </div>
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
            <h2>Hafes Rent Car: Solusi Cerdas untuk Sewa Mobil Tanpa Ribet</h2>
            
        </div>
        <div class="why-us-content">

            <div class="why-us-item">
                <img src="{{ asset('img/icon/fleet.webp') }}" alt="Armada Lengkap" loading="lazy">
                <div class="why-us-info">
                    <h3>Pilihan Armada Lengkap</h3>
                    <p>Kami menyediakan berbagai jenis kendaraan, mulai dari city car hingga kendaraan premium, sesuai kebutuhan perjalanan Anda.</p>
                </div>
            </div>

            <div class="why-us-item">
                <img src="{{ asset('img/icon/comfort.webp') }}" alt="Nyaman & Bersih" loading="lazy">
                <div class="why-us-info">
                    <h3>Mobil Nyaman & Terawat</h3>
                    <p>Selalu dalam kondisi prima dengan perawatan rutin, memastikan kenyamanan dan keamanan selama perjalanan.</p>
                </div>
            </div>

            <div class="why-us-item">
                <img src="{{ asset('img/icon/driver.webp') }}" alt="Driver Berpengalaman" loading="lazy">
                <div class="why-us-info">
                    <h3>Driver Profesional & Ramah</h3>
                    <p>Jika memilih layanan dengan driver, kami menyediakan pengemudi berpengalaman yang siap melayani dengan ramah dan profesional.</p>
                </div>
            </div>

            <div class="why-us-item">
                <img src="{{ asset('img/icon/price-tag.webp') }}" alt="Harga Terjangkau" loading="lazy">
                <div class="why-us-info">
                    <h3>Harga Terjangkau</h3>
                    <p>Menawarkan harga yang kompetitif dengan berbagai pilihan paket sesuai kebutuhan perjalanan Anda.</p>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection