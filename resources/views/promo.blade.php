@extends('layouts.app')
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
      "name": "{{ $konten->page_name }}",
      "item": "{{ url('/slug_content') }}"
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
                        <img src="{{ asset('img/merpati-circle.webp')}}" alt="Logo Merpati Trans">
                    </div>
                    <div class="card-content">
                        <h2 class="card-content-tittle">Hafes Rent Car</h2>
                        <p class="text-center pb-15">Hubungi Kami Via Whatsapp</p>
                        <div class="flex-icon-text">
                            <div class="btn-social"><i class="fab fa-whatsapp"></i></div>
                            @php
                                $phone = '6282125423807';
                                $message = "Halo admin Hafes Rent Car, saya mau tanya sewa mobilnya. Saya dapat info dari " . url()->current();
                                $whatsappLink = "https://wa.me/" . preg_replace('/[^0-9]/', '', $phone) . "?text=" . urlencode($message);
                            @endphp
                            <a href="{{ $whatsappLink }}" target="_blank" rel="nofollow noopener noreferrer">6282125423807</a>
                        </div>
                    </div>
                </div>
            </div>
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
            <h2>Pilihan Armada</h2>
        </div>
        <div class="product-grid">
            @foreach($products as $product)
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
            <h2>Kenapa Sewa Mobil Di Hafes Rent Car?</h2>
            
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
<script>
    function openWhatsApp() {
        let phone = '6282125423807';
        let message = "Halo admin Hafes Rent Car, saya mau tanya sewa mobilnya. Saya dapat info dari " + window.location.href;
        let whatsappLink = "https://wa.me/" + phone + "?text=" + encodeURIComponent(message);
        
        window.open(whatsappLink, "_blank");
    }
</script>
@endsection