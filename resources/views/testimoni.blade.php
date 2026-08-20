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
        <div class="section-header mbottom-20 pb-20">
                         <h1>Testimonial - Apa Kata Klien tentang Azolatekno?</h1>
      <p>Kepercayaan dari klien kami adalah bukti nyata dari kualitas layanan Azolatekno dalam membangun website, aplikasi, hingga integrasi AI yang berdampak nyata.</p>
        </div>

        <div class="swiper-container swiper-container-testi">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"Web Design dan SEO nya bagus, sekarang web perusahaan textile kami sudah di halaman 1 google dan banyak yang top 1 google. Orderan kain meningkat ke WhatsApp kami hariannya capai puluhan order tanpa iklan sama sekali. Dan sudah masuk rekomendasi supplier kain terbaik di chatgpt dan AI lainnya. Keren sih totalitas banget dengan biaya yang terjangkau."</p>
                        <h4>- Altratex Group (Group Perusahaan textile di jawa tengah dengan 4 Factory dan 6 Depo Kain Kaos di berbagai kota)</h4>
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


<section id="layanan">
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
                        </div>
                    </a>
                </div>
            @endforeach
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


@endsection