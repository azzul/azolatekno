@extends('layouts.app2')
@push('preload')
    <link rel="preload" as="image" href="{{asset('img/product/' .$product->image_produk)}}">
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
      "name": "Armada",
      "item": "{{ url('/armada') }}"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "{{ $product->nama_produk }}"
    }
  ]
}
</script>
@endpush
@section('content')
<section id="breadcrumb-section-about" >
        <div class="custom-container">
            <div class="breadcrumb-text">
                 <a href="{{ url('/') }}">Beranda</a> / 
                 <a href="{{ url('/armada') }}">Armada</a> / 
                <span class="W-500">{{$product->nama_produk}}</span>
            </div>
        </div>
    </section>

<section id="detail-product" class="mtop-0">
    <div class="custom-container">
        <div class="section-header-left mtop-0">
                    <h1>{{$product->nama_produk}}</h1> 
                </div>
        <div class="flex-content">
            <div class="main-content-image">
                <div class="image-wrapper"> 
                <img src="{{asset('img/product/' .$product->image_produk)}}" alt="{{$product->nama_produk}}">
                </div>
            </div>
            <div class="sidebar pt-0">
                <div class="card-sidebar">
                    <img src="{{ asset('img/logo-hafesrent.webp')}}" alt="Logo Hafes Rental Mobil Jakarta">
                    <div class="card-content">
                        <h2 class="card-content-tittle">Hafes Rent Car - Rental Mobil Jakarta</h2>
                        <div class="flex-icon-text">
                            <div class="btn-social"><i class="fab fa-whatsapp"></i></div>
                            @php
                                $phone = '6282125423807';
                                $message = "Halo admin Hafes Rent Car, saya mau tanya " . $product->nama_produk . ". Saya dapat info dari " . url()->current();
                                $whatsappLink = "https://wa.me/" . preg_replace('/[^0-9]/', '', $phone) . "?text=" . urlencode($message);
                            @endphp
                            <a href="{{ $whatsappLink }}" target="_blank">6282125423807</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content-detail">
            <div class="content-detail-wrapper">
                {!!$product->long_desc!!}
            </div>
        </div>
        
    </div>
</section>
<section id="recomendations">
    <div class="custom-container">
        <div class="recomendation" data-title="Lainnya">
            <div class="pricelist-badge"><h2><i class="fas fa-shuffle"></i> REKOMENDASI ARMADA LAINNYA<h2></div>
        </div>

<!--                 <div class="slider-wrapper-latest">
            <div class="latest-product-slider"> -->
        <div class="swiper-container-latest">
            <div class="swiper-wrapper latest-product-container">
                @foreach ($recomendations as $recomendation)
                @if($loop->index < 3) {{-- Preload hanya untuk 3 gambar pertama --}}
                @push('preload')
                    <link rel="preload" as="image" href="{{ asset('img/product/' . $recomendation->image_produk) }}">
                @endpush
            @endif
                    <div class="swiper-slide card-product">
                     <a href="{{ url('/armada/' . $recomendation->slug_produk) }}">
                    <img src="{{ asset('img/product/' . $recomendation->image_produk)}}" alt="{{$recomendation->nama_produk}}" >
                    <div class="product-content">
                        <p class="product-content-tittle ">{{$recomendation->nama_produk}}</p>
                         @foreach ($recomendation->harga as $harga)
                        <div class="description">Unit terbatas, pastikan Anda jadi yang pertama!</div>
                        <!-- <p class="product-content-price ">Rp {{ number_format($harga->harga, 0, ',', '.') }}</p> -->
                      @endforeach
                        
                        <div class="product-buttons">
                            @php
                                $phone = '6282125423807';
                                $message = "Halo admin Hafes Rent Car, saya mau tanya " . $recomendation->nama_produk . ". Saya dapat info dari " . url()->current();
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
            <div class="latest-product-navigation">
                <button id="latest-prevBtn" aria-label="Previous">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button id="latest-nextBtn" aria-label="Next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div> 
        </div>

</section>
@push('json-ld') 
<script type="application/ld+json"> 
{  
  "@context": "https://schema.org",  
  "@type": "Product",  
  "name": "{{ $product->nama_produk }}",  
  "image": "{{ asset('img/product/' . $product->image_produk) }}",  
  "description": "{{ strip_tags($product->short_desc) }}",  
  "brand": {  
    "@type": "Brand",  
    "name": "Merpati Trans"  
  },  
  "offers": {  
    "@type": "Offer",  
    "url": "{{ url()->current() }}",  
    "priceCurrency": "IDR",  
    "price": "{{ $product->harga }}",  
    "priceValidUntil": "{{ now()->addMonths(6)->toDateString() }}",  
    "availability": "https://schema.org/InStock",  
    "seller": {  
      "@type": "Organization",  
      "name": "Merpati Trans"  
    }  
  }  
} 
</script> 
@endpush
<script>
 document.addEventListener('DOMContentLoaded', function () {
    // Initialize Swiper
    const swiper = new Swiper('.swiper-container-latest', {
        slidesPerView: 'auto',
        spaceBetween: 20,
        navigation: false, // Disable default Swiper navigation
        breakpoints: {
            300: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            400: {
                slidesPerView: 1,
                spaceBetween: 15,
            },
            500: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 20,
            }
        },
        freeMode: true, // Enable free scrolling mode
    });

    // Custom button navigation
    const prevBtn = document.getElementById('latest-prevBtn');
    const nextBtn = document.getElementById('latest-nextBtn');

    prevBtn.addEventListener('click', function () {
        swiper.slidePrev(); // Use swiper instance
    });

    nextBtn.addEventListener('click', function () {
        swiper.slideNext(); // Use swiper instance
    });
});


</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".pricelist-detail").forEach(function (element) {
        let title = element.getAttribute("data-title");
        let badge = document.createElement("span");

        badge.classList.add("pricelist-badge");
        badge.innerHTML = `<h2><i class="fas fa-tag"></i> Harga ${title}<h2>`;

        element.appendChild(badge);
    });
});
</script>

@endsection