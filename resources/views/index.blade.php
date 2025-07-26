@extends('layouts.app')

@section('content')
<section id="intro">
    <div class="video-container">
        <!-- Initially display this image -->
            <!-- Fallback untuk browser yang tidak support <picture> -->
            <img id="endImage"
     src="{{ asset('img/rental-mobil-jakarta.jpg') }}"
     data-src-mobile="{{ asset('img/rental-mobil-jakarta-mobile.jpg') }}"
     data-src-desktop="{{ asset('img/rental-mobil-jakarta.jpg') }}"
     class="endImage"
     alt="End Image">
    </div>
    <div class="intro-container hide fadeIn">
    <h2 class="mb-4 pb-0 typed-text">KENYAMANAN <br><span>PERJALANAN ANDA</span> ADALAH PRIORITAS KAMI</h2>
    <h1 class="mb-4 pb-0 subtext show">Rental Mobil Jakarta Terjangkau Mulai Rp 500 Ribu - Hafes Rent Car</h1>
     <p class=" pb-0 subtext show">
  <i class="fas fa-star text-warning"></i>
  <i class="fas fa-star text-warning"></i>
  <i class="fas fa-star text-warning"></i>
  <i class="fas fa-star text-warning"></i>
  <i class="fas fa-star text-warning"></i>
</p>
    <p class="pb-0 subtext show">Rating 5 di Aplikasi Tiket.com</p>

    @php
                $phone2 = '62';
                $message2 = "Halo admin Hafes rent car, saya mau tanya sewa mobilnya. Saya dapat info dari " . url()->current();
                $whatsappLink2 = "https://wa.me/" . preg_replace('/[^0-9]/', '', $phone2) . "?text=" . urlencode($message2);
            @endphp
    <div class="welcome-buttons">
    <a class="welcome-btn yuk-btn" href="{{ $whatsappLink2 }}">
        <i class="fab fa-whatsapp"></i>HUBUNGI KAMI
    </a>
</div>
</div>
</section>

<section id="home-main">
    <div class="custom-container pt-0 pb-0">
        <div class="flex-row-main">
          <div class="column-left-50">
            <div class="section-header-left">
              <h2>Rental Mobil Jakarta Terbaik - PT Hafes Megah Lestari</h2>
            </div>
            <p>
              PT Hafes Megah Lestari adalah rental mobil dengan pilihan armada terlengkap dan terjangkau di Jabodetabek. Rental Mobil Profesional untuk wedding, bisnis, kunjungan bisnis, traveling, personal dan event.
            </p>
            <p>
                📢 <strong>Pesan Segera, pasti aman karena udah PT!</strong>
            </p>
            @php
                $phone = '6282125423807';
                $message = "Halo admin Hafes rent car, saya mau tanya sewa mobilnya. Saya dapat info dari " . url()->current();
                $whatsappLink = "https://wa.me/" . preg_replace('/[^0-9]/', '', $phone) . "?text=" . urlencode($message);
            @endphp
            <a class="btn-main mtop-20" href="{{ $whatsappLink }}" target="_blank" rel="nofollow noopener noreferrer"><i class="fab fa-whatsapp pr-10"></i>Hubungi Whatsapp Kami!</a>
          </div>
          
        </div>
    </div>
</section>

<section id="partner">
    <div class="custom-container">
        <div class="section-header">
            <h2>Kami Berpartner Dengan Aplikasi Sewa Mobil Terpercaya</h2>
            
        </div>
        <div class="partner-grid">

            <div class="partner-card">
                <div class="partner-card-content">
                    <img src="{{ asset('img/partner/ticketcom.webp') }}" alt="Rental Mobil Partner dari Tiket.com" loading="lazy">
                </div>
            </div>
            <div class="partner-card">
                <div class="partner-card-content">
                    <img src="{{ asset('img/partner/antavaya.webp') }}" alt="Rental Mobil Partner dari Antavaya" loading="lazy">
                </div>
            </div>
            <div class="partner-card">
                <div class="partner-card-content">
                    <img src="{{ asset('img/partner/wita-tour.webp') }}" alt="Rental Mobil Partner dari Wita Tour" loading="lazy">
                </div>
            </div>

            

        </div>
    </div>
</section>

<section id="armada">
    <div class="custom-container">
        <div class="section-header">
            <h2>Pilihan Armada Rental Mobil</h2>
        </div>
        <div class="product-grid">
            @foreach($products as $product)
                <div class="card-product">
                    <a href="{{ url('/armada/' . $product->slug_produk) }}">
                        <div class="product-image-wrapper">
                            <img src="{{ asset('img/product/' . $product->image_produk) }}" alt="{{$product->nama_produk}}" loading="lazy">
                            <!-- @foreach ($product->harga as $harga)
                            @if($harga->diskon > 0)
                                <div class="badge-diskon">Diskon {{ $harga->diskon }}%</div>
                            @endif
                             @endforeach -->
                        </div>
                        <div class="product-content">
                            <p class="product-content-tittle">{{$product->nama_produk}}</p>

                           <!--  @foreach ($product->harga as $harga)
                                <div class="description">{{ $harga->jenisHarga->jenis_harga }}</div>

                                @if($harga->diskon > 0)
                                    @php
                                        $hargaAsli = $harga->harga;
                                        $nominalDiskon = $harga->diskon;
                                        $hargaSebelumDiskon = $nominalDiskon > 0 ? $hargaAsli / (1 - $nominalDiskon / 100) : null;
                                    @endphp
                                    <p class="product-content-price">
                                        Rp {{ number_format($hargaAsli, 0, ',', '.') }}
                                        <span class="harga-asli">Rp {{ number_format($hargaSebelumDiskon, 0, ',', '.') }}</span>
                                        <span class="persen-diskon">-{{ $nominalDiskon }}%</span>
                                    </p>
                                @else
                                    <p class="product-content-price">Rp {{ number_format($harga->harga, 0, ',', '.') }}</p>
                                @endif
                            @endforeach -->

                            <!-- <div class="product-buttons">
                                @php
                                    $phone = '6282125423807';
                                    $message = "Halo admin Hafes Rent Car, saya mau tanya " . $product->nama_produk . ". Saya dapat info dari " . url()->current();
                                    $whatsappChat = "https://wa.me/" . preg_replace('/[^0-9]/', '', $phone) . "?text=" . urlencode($message);
                                @endphp
                                <a class="btn buy-btn" href="{{$whatsappChat}}" target="_blank" rel="nofollow noopener noreferrer"><i class="fab fa-whatsapp pr-10"></i> Hubungi Kami</a>
                            </div> -->
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="slider-container-hero">
    <div class="custom-container">
        <div class="section-header">
            <h2>Layanan Kami</h2>
            
        </div>
  <div class="slider-hero" id="sliderHero">
    <div class="slide-hero active">
      <img src="{{ asset('img/service/rental-mobil-jakarta.webp') }}" alt="Rental Mobil Jakarta">
        <div class="content-slide-hero">
        <h3>Rental Mobil Jakarta</h3>
        <div class="caption-hero">
        <p>Rental Mobil Jakarta dengan supir untuk semua kebutuhan area jakarta dan sekitanya.</p>
      </div>
    </div>
    </div>
    <div class="slide-hero active">
  <img src="{{ asset('img/service/rental-mobil-jakarta-pusat.webp') }}" alt="Rental Mobil Jakarta Pusat">
  <div class="content-slide-hero">
    <h3>Rental Mobil Jakarta Pusat</h3>
    <div class="caption-hero">
      <p>Sewa mobil dengan sopir di Jakarta Pusat, cocok untuk perjalanan bisnis, acara resmi, hingga city tour yang nyaman.</p>
    </div>
  </div>
</div>

<div class="slide-hero">
  <img src="{{ asset('img/service/rental-mobil-jakarta-selatan.webp') }}" alt="Rental Mobil Jakarta Selatan">
  <div class="content-slide-hero">
    <h3>Rental Mobil Jakarta Selatan</h3>
    <div class="caption-hero">
      <p>Jelajahi kawasan elit Jakarta Selatan dengan layanan sewa mobil plus driver yang ramah dan profesional.</p>
    </div>
  </div>
</div>

<div class="slide-hero">
  <img src="{{ asset('img/service/rental-mobil-jakarta-utara.webp') }}" alt="Rental Mobil Jakarta Utara">
  <div class="content-slide-hero">
    <h3>Rental Mobil Jakarta Utara</h3>
    <div class="caption-hero">
      <p>Rental mobil area Jakarta Utara untuk keperluan keluarga, antar jemput pelabuhan, hingga kunjungan bisnis.</p>
    </div>
  </div>
</div>

<div class="slide-hero">
  <img src="{{ asset('img/service/rental-mobil-jakarta-timur.webp') }}" alt="Rental Mobil Jakarta Timur">
  <div class="content-slide-hero">
    <h3>Rental Mobil Jakarta Timur</h3>
    <div class="caption-hero">
      <p>Nikmati perjalanan aman dan nyaman dengan layanan sewa mobil terpercaya di wilayah Jakarta Timur.</p>
    </div>
  </div>
</div>

<div class="slide-hero">
  <img src="{{ asset('img/service/rental-mobil-jakarta-barat.webp') }}" alt="Rental Mobil Jakarta Barat">
  <div class="content-slide-hero">
    <h3>Rental Mobil Jakarta Barat</h3>
    <div class="caption-hero">
      <p>Butuh kendaraan fleksibel di Jakarta Barat? Sewa mobil kami siap menemani aktivitas harian Anda.</p>
    </div>
  </div>
</div>

<div class="slide-hero">
  <img src="{{ asset('img/service/rental-mobil-tangerang.webp') }}" alt="Rental Mobil Tangerang">
  <div class="content-slide-hero">
    <h3>Rental Mobil Tangerang</h3>
    <div class="caption-hero">
      <p>Mobil siap jalan untuk area Tangerang dan Bandara Soekarno-Hatta dengan driver profesional dan on-time.</p>
    </div>
  </div>
</div>

<div class="slide-hero">
  <img src="{{ asset('img/service/rental-mobil-bekasi.webp') }}" alt="Rental Mobil Bekasi">
  <div class="content-slide-hero">
    <h3>Rental Mobil Bekasi</h3>
    <div class="caption-hero">
      <p>Solusi sewa mobil Bekasi untuk harian, mingguan, maupun antar kota dengan layanan yang nyaman dan terpercaya.</p>
    </div>
  </div>
</div>

<div class="slide-hero">
  <img src="{{ asset('img/service/rental-mobil-depok.webp') }}" alt="Rental Mobil Depok">
  <div class="content-slide-hero">
    <h3>Rental Mobil Depok</h3>
    <div class="caption-hero">
      <p>Layanan rental mobil area Depok dengan harga terjangkau dan sopir berpengalaman, cocok untuk kebutuhan keluarga atau kerja.</p>
    </div>
  </div>
</div>
  </div>
</div>
  <!-- Navigasi tombol -->
  <button class="prev-hero">&#10094;</button>
  <button class="next-hero">&#10095;</button>

  <!-- Dots indikator -->
  <div class="dots-hero" id="dotsHero"></div>
</section>


<section id="why-us">
    <div class="custom-container">
        <div class="section-header">
            <h2>Kenapa Sewa Mobil Di Hafes Megah Lestari?</h2>
            
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

<section id="testimonial">
    <div class="custom-container">
        <div class="section-header-left mbottom-20 pb-20">
            <h2 style="text-align: center !important;">
                <i class="fas fa-chat"></i> REVIEW JUJUR PELANGGAN PT HAFES MEGAH LESTARI (GMAPS)
            </h2>
        </div>

        <div class="swiper-container swiper-container-testi">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"Driver tepat waktu, sopan dan tau jalan"</p>
                        <h4>- Yolanda Pello</h4>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"Ramah, Rapih dan baik sama penumpang. Juga jujur drivernya."</p>
                        <h4>- Saiful Bahri</h4>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"Mobil baru, bersih, supir tau jalan, tepat waktu juga sopan"</p>
                        <h4>- Upi Epul</h4>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"Salah satu Rental terbaik di Jakarta...Driver ramah2...sopan unit bersih pokok e is the Best dah buat Hafes rent"</p>
                        <h4>- Mavin</h4>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
            
        </div>
        <div class="flex-center">
            <div class="product-buttons">
                <a class="btn buy-btn mtop-20 mbottom-20" href="https://maps.app.goo.gl/Fb3ffGN2kWV3iZae7" target="_blank" rel="nofollow noopener noreferrer"><i class="fa-solid fa-map-pin mright-10"></i>Cek Google Maps</a>
            </div>
        </div>
    </div>
</section>


 <script src="https://player.vimeo.com/api/player.js"></script>
<script>
     function updateImageSource() {
    const endImage = document.getElementById("endImage");
    const mobileSrc = endImage.getAttribute("data-src-mobile");
    const desktopSrc = endImage.getAttribute("data-src-desktop");
    endImage.src = window.innerWidth <= 500 ? mobileSrc : desktopSrc;
}

    
    window.addEventListener("resize", updateImageSource);

    // Jalankan setelah load
    window.addEventListener("load", function () {
        const videoContainer = document.querySelector('.video-container');
        const endImage = document.getElementById('endImage');

        setTimeout(() => {
            // Sembunyikan gambar awal
            endImage.style.display = 'none';

            // Tambahkan iframe Vimeo
            const iframe = document.createElement('iframe');
            iframe.id = 'introVideo';
            iframe.src = "https://player.vimeo.com/video/1089227577?h=5dbdea13e0&autoplay=1&muted=1&loop=1&background=1";
            iframe.frameBorder = "0";
            iframe.allowFullscreen = true;
            iframe.allow = "autoplay; fullscreen";

            // Tambahkan styling sesuai CSS-mu
            iframe.style.position = "absolute";
            // iframe.style.top = "50%";
            // iframe.style.left = "50%";
            // iframe.style.minWidth = "110%";
            // iframe.style.minHeight = "113%";
            // iframe.style.width = "100%";
            // iframe.style.height = "100%";
            // iframe.style.transform = "translate(-50%, -50%)";
            // iframe.style.pointerEvents = "none";
            iframe.style.zIndex = "-1";

            videoContainer.appendChild(iframe);

            // Optional: kontrol dengan Vimeo Player API
            const player = new Vimeo.Player(iframe);
            player.on('ended', function () {
                // jika tidak pakai loop, bisa tampilkan gambar lagi
                iframe.style.display = 'none';
                endImage.style.display = 'block';
                updateImageSource;
            });

        }, 2000); // Delay 5 detik
    });
    // Memasukkan API YouTube IFrame
    let tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    let firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    // Pencarian produk dinamis
    document.addEventListener('DOMContentLoaded', function() {
        var mainTexts = [
            "RENTAL MOBIL JAKARTA<br><span>LEBIH MUDAH</span> BERSAMA HAFES",
          "ARMADA LENGKAP<br><span>DARI CITY CAR</span> HINGGA HIACE",
          "HARGA TERJANGKAU<br><span>JAMINAN</span> PELAYANAN TERBAIK",
          "DRIVER PROFESIONAL<br><span>SIAP ANTAR</span> KE MANA SAJA",
          "LAYANAN DENGAN SUPIR<br><span>UNTUK KENYAMANAN</span> TANPA REPOT"
        ];

        var subTexts = [
            "Karena kepuasan pelanggan adalah kebanggaan kami.",
            "Dapatkan harga terbaik dengan belanja langsung dari pabrik.",
            "Kami memiliki tim laboratorium terbaik untuk memberikan warna dan kualitas kain terbaik untukmu.",
            ""
        ];

        var typed = new Typed('.typed-text', {
            strings: mainTexts,
            typeSpeed: 80, // Kecepatan mengetik
            backSpeed: 0, // Kecepatan menghapus teks (0 berarti tidak ada efek hapus)
            loop: true, // Tidak ada loop untuk menghindari animasi ulang
            showCursor: false, // Menyembunyikan kursor
            cursorChar: '|',
            onStringTyped: function(index) {},
            onComplete: function(self) {}
        });
    });


 

    
</script>
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