@extends('layouts.app')
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
      "name": "Testimonial"
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
                <span class="W-500">Testimonial</span>
            </div>
        </div>
    </section>
<section id="testimonial">
    <div class="custom-container">
        <div class="section-header-left mbottom-20 pb-20">
            <h2 style="text-align: center !important;">
                <i class="fas fa-chat"></i> REVIEW JUJUR PELANGGAN Hafes RENT (GMAPS)
            </h2>
        </div>

        <div class="swiper-container swiper-container-testi">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"Mantap pelayanan nya. Banyak pilihan unit nya. Driver pengalaman dan bersih."</p>
                        <h4>- Very86 Magelang</h4>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"Pengalaman pertama naik mobil Hafes rent car sangat memuaskan, drivernya ramah² mobilnya wangi pokoknya next time kalau mau ke jkrt lagi pasti pake lagi🥰🥰🥰🥰"</p>
                        <h4>- Aji ST</h4>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"Pengalaman pertama saya pakai jasa rental sangat puas🥰,driver ramah tau jalan mobil bersih wangi,,,,,next ke jakarta saya pake jasa rental ini lagi good job👍👍👍"</p>
                        <h4>- Upi Epul</h4>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"Salah satu Rental terbaik di Jakarta...Driver ramah2...sopan unit bersih pokok e is the Best dah buat Hafes rent"</p>
                        <h4>- Hafes Sidiq</h4>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"pertama kali naik mobil Hafes ren bagus drvernya ramah2 mobil bersih dan wangi"</p>
                        <h4>- Tawiyo Tawiyo</h4>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
            
        </div>
        <div class="flex-center">
            <div class="product-buttons">
                <a class="btn buy-btn mtop-20 mbottom-20" href="https://maps.app.goo.gl/4iM59F62MqjvZRYj6" target="_blank" rel="nofollow noopener noreferrer"><i class="fa-solid fa-map-pin mright-10"></i>Cek Google Maps</a>
            </div>
        </div>
    </div>
</section>


<section id="armada">
    <div class="custom-container">
        <div class="section-header">
            <h2>Pilihan Armada - Hafes Rent Car</h2>
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
<div id="popupDiskon" class="popup-diskon">
  <div class="popup-content-diskon">
    <h2>🎉 Selamat!</h2>
    <p>Anda adalah salah satu orang beruntung yang mendapatkan <strong>diskon 25%</strong> untuk sewa mobil hari ini!</p>
    <p>Jangan lewatkan kesempatan langka ini.</p>
    <a href="{{$whatsappChat}}" target="_blank" class="popup-btn-diskon"><i class="fab fa-whatsapp pr-10"> </i>Hubungi Admin Sekarang</a>
    <span class="close-popup-diskon" onclick="document.getElementById('popupDiskon').style.display='none'">×</span>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Initialize Swiper for Testimonial with Auto-Slide
    const swiperTesti = new Swiper(".swiper-container-testi", {
        slidesPerView: "auto",
        spaceBetween: 20,
        freeMode: true,
        autoplay: {
            delay: 3000, // Ganti angka ini untuk mengatur kecepatan (ms)
            disableOnInteraction: false, // Tetap autoplay setelah user geser manual
        },
        loop: true, // Supaya looping terus tanpa berhenti
        breakpoints: {
            300: { slidesPerView: 1, spaceBetween: 10 },
            400: { slidesPerView: 1, spaceBetween: 15 },
            500: { slidesPerView: 1, spaceBetween: 15 },
            768: { slidesPerView: 2, spaceBetween: 20 },
            1024: { slidesPerView: 3, spaceBetween: 20 },
        },
    });

    // Custom button navigation for Testimonial
    const prevBtnTesti = document.getElementById("testi-prevBtn");
    const nextBtnTesti = document.getElementById("testi-nextBtn");

    if (prevBtnTesti && nextBtnTesti) {
        prevBtnTesti.addEventListener("click", function () {
            swiperTesti.slidePrev();
        });

        nextBtnTesti.addEventListener("click", function () {
            swiperTesti.slideNext();
        });
    }
});
</script>


@endsection