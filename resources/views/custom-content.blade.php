@extends('layouts.app2')
@push('preload')
    <link rel="preload" as="image" href="{{asset('img/content/' .$konten->img_content)}}">
@endpush
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
      "name": "{{ $konten->page_name }}"
    }
  ]
}
</script>
@endpush
@section('content')

<section id="breadcrumb-section-about pt-90" >
        <div class="custom-container">
            <div class="breadcrumb-text">
                 <a href="{{ url('/') }}">Beranda</a> / 
                <span class="W-500">{{$konten->page_name}}</span>
            </div>
        </div>
    </section>

<section id="konten" class="mtop-0">
    <div class="custom-container">
        <div class="section-header-left ">
                    <h1 class="no-transform">{{$konten->judul}}</h1> 
                </div>
        <div class="flex-content">
            <div class="custom-content-image">
                <div class="image-wrapper" onclick="openWhatsApp()"> 
                <img src="{{ asset('img/content/' . $konten->img_content) }}" 
                     alt="{{ $konten->judul }}"
                     fetchpriority="high"
                     srcset="
                     @if(!empty($konten->img_small)) {{ asset('img/content/' . $konten->img_small) }} 720w, @endif
                     @if(!empty($konten->img_medium)) {{ asset('img/content/' . $konten->img_medium) }} 1024w, @endif
                     {{ asset('img/content/' . $konten->img_content) }} 1436w"
                     sizes="(max-width: 768px) 720px, (max-width: 1024px) 1024px, 1436px">
                </div>
            </div>
            <div class="sidebar pt-0">
                <div class="card-sidebar">
                    <div class="card-sidebar-img">
                        <img src="{{ asset('img/logo-Hafesrent.webp')}}" alt="Logo Hafes Rent Car">
                    </div>
                    <div class="card-content">
                        <h2 class="card-content-tittle">Hafes Rent Car</h2>
                        <div class="flex-icon-text">
                            <div class="btn-social"><i class="fab fa-whatsapp"></i></div>
                            @php
                                $phone = '6282125423807';
                                $message = "Halo admin Hafes Rent Car, saya mau tanya Rental Mobil. Saya dapat info dari " . url()->current();
                                $whatsappLink = "https://wa.me/" . preg_replace('/[^0-9]/', '', $phone) . "?text=" . urlencode($message);
                            @endphp
                            <a href="{{ $whatsappLink }}" target="_blank" rel="nofollow noopener noreferrer">6282125423807</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-content-detail">
            <div class="content-detail-wrapper">
                {!!$konten->isi!!}
            </div>
        </div>
        
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

<script>
    function openWhatsApp() {
        let phone = '6282125423807';
        let message = "Halo admin Hafes Rent Car, saya mau tanya sewa mobilnya. Saya dapat info dari " + window.location.href;
        let whatsappLink = "https://wa.me/" + phone + "?text=" + encodeURIComponent(message);
        
        window.open(whatsappLink, "_blank");
    }
</script>


@endsection