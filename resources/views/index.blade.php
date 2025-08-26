@extends('layouts.app')

@section('content')
<section id="intro">
    <div class="video-container">
        <!-- Initially display this image -->
            <!-- Fallback untuk browser yang tidak support <picture> -->
            <img id="endImage"
     src="{{ asset('img/bg-azolatekno.jpg') }}"
     data-src-mobile="{{ asset('img/bg-azolatekno-mobile.jpg') }}"
     data-src-desktop="{{ asset('img/bg-azolatekno.jpg') }}"
     class="endImage"
     alt="End Image">
    </div>
    <div class="intro-container hide fadeIn">
        <h1 class="mb-4 pb-0 subtext show">Jasa Pembuatan Website, SEO Google, dan Integrasi AI Terbaik <br><span>Azolatekno</span></h1>
     <p class=" pb-0 subtext show">
  <i class="fas fa-star text-warning"></i>
  <i class="fas fa-star text-warning"></i>
  <i class="fas fa-star text-warning"></i>
  <i class="fas fa-star text-warning"></i>
  <i class="fas fa-star text-warning"></i>
</p>
    <p class="pb-0 subtext show">Rating 5 di Aplikasi Google Maps</p>

    @php
                $phone2 = '6287733930143';
                $message2 = "Halo admin Azolatekno, saya mau tanya layanan digitalnya. Saya dapat info dari " . url()->current();
                $whatsappLink2 = "https://wa.me/" . preg_replace('/[^0-9]/', '', $phone2) . "?text=" . urlencode($message2);
            @endphp
    <div class="welcome-buttons">
    <a class="welcome-btn yuk-btn" href="{{ $whatsappLink2 }}">
        <i class="fab fa-whatsapp"></i>HUBUNGI KAMI
    </a>
</div>
</div>
</section>

<section id="about-azolatekno" class="mtop-40">
  <div class="custom-container pt-0 pb-0">
    <div class="flex-row-main">
      <div class="column-left-50">
        <div class="section-header-left">
          <h2>Jasa Pembuatan Website, Aplikasi, dan Integrasi AI Terpercaya Sejak 2018</h2>
        </div>
        <p>
          Azolatekno adalah agensi digital kreatif yang telah berdiri sejak 2018, menyediakan layanan pembuatan website profesional, aplikasi custom, serta integrasi AI untuk kebutuhan bisnis modern. Kami telah dipercaya oleh berbagai perusahaan, UMKM, dan instansi untuk membangun solusi digital yang efisien dan berdaya saing.
        </p>
        <p>
          Puluhan proyek website buatan kami berhasil menembus halaman pertama Google, berkat pendekatan yang menggabungkan desain elegan, performa optimal, dan strategi SEO yang tepat sasaran.
        </p>
        <p>
          Komitmen kami adalah membantu Anda tumbuh melalui teknologi yang relevan dan terukur.
        </p>
      </div>
    </div>
  </div>
</section>



<section id="armada">
    <div class="custom-container">
        <div class="section-header">
            <h2>Layanan Web, SEO, Digital, AI dan Course AI</h2>
        </div>
        <div class="product-grid">
            @foreach($products as $product)
                <div class="card-product">
                    <a href="{{ url('/layanan/' . $product->slug_produk) }}">
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

                           {!!$product->spesifikasi!!}
                           <div class="description">Mulai</div>
                           @foreach ($product->harga as $h)
                                <p class="product-content-price">Rp{{ number_format($h->harga, 0, ',', '.') }}</p>
                            @endforeach
                           
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section id="partner">
  <div class="custom-container">
    <div class="section-header">
      <h2>Dipercaya oleh Klien dari Berbagai Industri Sejak 2018</h2>
      <p>Berikut adalah beberapa perusahaan dan brand yang telah mempercayakan pengembangan website, SEO, dan layanan digital lainnya kepada Azolatekno.</p>
    </div>
    <div class="partner-grid">

      <div class="partner-card">
        <div class="partner-card-content">
          <img src="{{ asset('img/client/altra-width.webp') }}" alt="Website Perusahaan Textile Altratex Group" loading="lazy">
          <p class="partner-caption">Altratex Group – Grup Textile Jawa Tengah, 4 Pabrik & 6 Depo</p>
        </div>
      </div>

      <div class="partner-card">
        <div class="partner-card-content">
          <img src="{{ asset('img/client/merpati-width.webp') }}" alt="Website Rental Mobil Merpati Trans Jakarta" loading="lazy">
          <p class="partner-caption">Merpati Trans – Rental Mobil Jakarta | Web + SEO</p>
        </div>
      </div>

      <div class="partner-card">
        <div class="partner-card-content">
          <img src="{{ asset('img/client/fajar-width.webp') }}" alt="Fajar Rent Car Website & SEO Ads" loading="lazy">
          <p class="partner-caption">Fajar Rent Car – Web, SEO, & Google Ads</p>
        </div>
      </div>

      <div class="partner-card">
        <div class="partner-card-content">
          <img src="{{ asset('img/client/hafes-width.webp') }}" alt="Website Rental Mobil Tangerang Azolatekno" loading="lazy">
          <p class="partner-caption">PT Hafes Megah Lestari – Rental Mobil Tangerang | Web Only</p>
        </div>
      </div>

      <div class="partner-card">
        <div class="partner-card-content">
          <img src="{{ asset('img/client/sakura-width.webp') }}" alt="Toko Bahan Kaos Sakura Website Ecer Grosir" loading="lazy">
          <p class="partner-caption">Toko Bahan Kaos Sakura – 6 Website di Jakarta, Solo, Jogja, Bali, Cirebon, Semarang</p>
        </div>
      </div>

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

<section id="testimonial">
    <div class="custom-container">
        <div class="section-header mbottom-20 pb-20">
                         <h2>Apa Kata Klien tentang Azolatekno?</h2>
      <p>Kepercayaan dari klien kami adalah bukti nyata dari kualitas layanan Azolatekno dalam membangun website, aplikasi, hingga integrasi AI yang berdampak nyata.</p>
        </div>

        <div class="swiper-container swiper-container-testi">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"Web Design dan SEO nya bagus, sekarang web perusahaan textile kami sudah di halaman 1 google dan banyak yang top 1 google. Orderan kain meningkat ke WhatsApp kami hariannya capai puluhan order tanpa iklan sama sekali. Dan sudah masuk rekomendasi supplier kain terbaik di chatgpt dan AI lainnya. Keren sih totalitas banget dengan biaya yang terjangkau."</p>
                        <h4>- Altratex Group (Group Perusahaan textile dengan 4 Factory dan 6 Depo Kain Kaos di berbagai kota)</h4>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"Mantap. Kualitas web dan SEO nya bagus, harga relatif murah, profesional & fast respon.
Lanjutkan lur. Mantul"</p>
                        <h4>- Dian Heditio</h4>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"Saya suka banget"</p>
                        <h4>- Pribadi Welas Asih / Tarmuji - Owner Fajar Rent Car</h4>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"mantap"</p>
                        <h4>- Hanifan - Owner Merpati Trans</h4>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"Kualitas, Profesionalisme, Nilai."</p>
                        <h4>- Ghozi</h4>
                    </div>
                </div>
                
            </div>
            <div class="swiper-pagination"></div>
            
        </div>
        <div class="flex-center">
            <div class="product-buttons">
                <a class="btn buy-btn mtop-20 mbottom-20" href="https://maps.app.goo.gl/cCtVpEtf5mTbQTuc9" target="_blank" rel="nofollow noopener noreferrer"><i class="fa-solid fa-map-pin mright-10"></i>Cek Google Maps</a>
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
            iframe.src = "https://player.vimeo.com/video/1110429533?h=5588577461&autoplay=1&muted=1&loop=1&background=1";
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
  "Jasa Teknologi Digital<br><span>Aplikasi & Website</span> Untuk Bisnis Anda",
  "Kami Kembangkan<br><span>Web & App</span> Berbasis AI Modern",
  "Layanan Komplit<br><span>Coding, SEO</span> Hingga AI Solution",
  "Kursus Teknologi<br><span>Siapkan Skill</span> Untuk Masa Depan",
  "Azolatekno<br><span>Human. Code.</span> Intelligence"
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
        let phone = '6287733930143';
        let message = "Halo admin Azolatekno, saya mau tanya sewa mobilnya. Saya dapat info dari " + window.location.href;
        let whatsappLink = "https://wa.me/" + phone + "?text=" + encodeURIComponent(message);
        
        window.open(whatsappLink, "_blank");
    }
</script>
@endsection