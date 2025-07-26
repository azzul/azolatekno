@extends('layouts.app2')


@section('content')
    
    <!-- Navigasi Breadcrumb -->
    <section id="breadcrumb-section" >
        <div class="custom-container pb-10">
            <div class="breadcrumb-text text-left pb-0">
                 <a href="{{ url('/') }}">Home</a>/
                <a href="{{ url('/shop') }}">Belanja</a>/
                <a href="{{ url('/shop/'. $tipe_kategori.'/' . $category->slug_kategori)}}">{{$category->nama_kategori }}</a>/
                <a href="{{ url('/shop/'. $tipe_kategori.'/' .$category->slug_kategori)}}/{{$etalase}}">{{ $etalase}}</a>/
                <span class="W-500">{{$product->slug_produk}}</span>
            </div>
        </div>
    </section>

    <!-- Daftar Produk -->
  <section class="product-detail-page mtop-0">
  	<div class="custom-container pt-0">
    <!-- Main Product Section -->
    <div class="product-main">
       <div class="product-image-section-detail">
            <div class="product-full-image-wrapper">
               <div class="product-full-image">
                    @if ($images->isNotEmpty())
                        <img 
                            src="{{ asset('img/product/' . $images->first()->src_image) }}" 
                            srcset="
                                {{ asset('img/product/' . $images->first()->src_image) }} 600w,
                                {{ asset('img/product/' . $images->first()->src_image) }} 800w
                            "
                            sizes="(max-width: 500px) 100%, 600px"
                            alt="{{$product->nama_produk}}" 
                            id="mainImage" 
                            fetchpriority="high">
                    @else
                        <img 
                            src="{{ asset('img/product/default.svg') }}" 
                            alt="Full Product Image" 
                            id="mainImage">
                    @endif
                </div>
                <button class="slider-nav prev" onclick="changeImage('prev')">&#10094;</button>
                <button class="slider-nav next" onclick="changeImage('next')">&#10095;</button>
            </div>
            
           <div class="product-image-thumbnails">
                @foreach ($images as $index => $image)
                    <img 
                        src="{{ asset('img/product/' . $image->src_image) }}" 
                        data-fullsize="{{ asset('img/product/' . $image->src_image) }}"
                        data-srcset="
                            {{ asset('img/product/' . $image->src_image) }} 600w,
                            {{ asset('img/product/' . $image->src_image) }} 800w
                        "
                        data-sizes="(max-width: 500px) 100%, 600px"
                        alt="Thumbnail {{ $index + 1 }}" 
                        id="thumb{{ $index + 1 }}" 
                        class="{{ $index == 0 ? 'active' : '' }}" 
                        loading="lazy">
                @endforeach
            </div>
        </div>
        
        <div class="product-info-section-detail">
            <!-- Breadcrumb Navigation -->
            <!-- Product Name -->
            <h1 class="product-name-detail">{{$product->nama_produk}} </h1>

            <!-- Product Price -->

            <div class="price-container" >
             
            <div class="product-price-detail"
            @if($settingServer->status === 'N') 
                                                 style="display:none !important;" 
                                             @else 
                                                 style="display:block !important;" 
                                             @endif>
                <h5 class="harga-roll" data-roll="{{$product->harga_roll}}">Rp {{ format_rupiah_tanpa_simbol($product->harga_roll) }}<span class="unit"> /kg (Bruto)</span>
                <p class="pl-0 w-500 mbottom-0">*Min. Order 1 roll ( &plusmn; 25 kg)</p>
            </div>

            <div class="price-cards"
            @if($settingServer->status === 'N') 
                                                 style="display:none !important;" 
                                             @else 
                                                 style="display:flex !important;" 
                                             @endif>
                <div class="price-card">
                    <p class="harga-ecer" data-ecer="{{$product->harga_ecer}}"><strong>Rp {{ format_rupiah_tanpa_simbol($product->harga_ecer) }}</strong> Harga Ecer / Kg</p>
                </div>
            </div>
             </div>
			           
            <!-- Fabric Color Options -->
          <div class="fabric-color">
    <h5 class="w-600 font-1rem mbottom-10">Warna Kain :</h5>
    <div class="fabric-color-content">
        <div class="color-options-detail">
             <div id="loading" style="display: none;">Loading...</div>
            @include('partials.color_options', ['activeColors' => $activeColors ?? [], 'inactiveColors' => $inactiveColors ?? []])
        </div>
        <div class="color-options-bottom-sheet" id="colorOptionsBottomSheet">
            <div class="close-sheet-button"><i class="fas fa-close"></i></div>
    <div class="bottom-sheet-header">
        <input type="text" id="colorSearch" placeholder="Cari Warna Kain..." />
    </div>
    <div class="color-options-detail-sheet">
        @foreach ($warna as $warna_sheet)
            <div class="color-option-detail-sheet new-style" id="sheetColor" slug-sheet="{{ $warna_sheet->slug_produk }}">
                <div class="color-option-circle" style="background-color: {{ $warna_sheet->hex_color }};" data-name="{{ $warna_sheet->nama_warna }}"></div>
                <div class="color-desc-sheet">{{ $warna_sheet->nama_warna }}</div>
            </div>
        @endforeach
    </div>
</div>
        <button class="more-colors-btn-detail" style="display: none;">Pilih Warna Lainnya <i class="fas fa-palette"></i> </button>
    </div>
</div>

 <!-- Color Categories -->
            <div class="color-category">
                <h5 class="w-600 font-1rem mbottom-10 ">Kategori Warna :</h5>
                <div class="category-buttons">
                    <div class="category-button active" id-ktgwarna="0">SEMUA</div>
                    @foreach ($ktgwarna as $ktg_warna)
                    <div class="category-button" id-ktgwarna="{{ $ktg_warna->id_ktgwarna}}">{{ $ktg_warna->kategori_warna}}</div>
                    @endforeach
                </div>
            </div>
            <div class="etalase">
                <h5 class="w-600 font-1rem mbottom-10 ">Opsi :</h5>
                 <div class="thickness-options">
                    @foreach($group_etalase as $opsi)
                    <span class="thickness-option {{ $opsi === $product->etalase ? 'active' : '' }}" data-etalase="{{ $opsi }}">
                {{ $opsi }}
            </span>
                    @endforeach
                </div>
            </div>
            <div class="spesification">    
                <h5 class="w-600 font-1rem mbottom-10">Spesifikasi Produk :</h5>
                <div class="detail-info-wrap">
                    {!! $product->spesifikasi !!}
                    <!-- Fabric Thickness -->
                    @if($product->pantone_color === null || $product->pantone_color === 'misty')
                    @else
                     <p><strong>Kode Pantone TPG:</strong> {{$product->pantone_color}}</p>
                     @endif
                </div>
            </div>

            
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                @if($isCheckout->status === 'N') 
                <button class="buy-now" id="checkout" onclick="checkoutWhatsapp()">Beli Via Whatsapp<i class="fas fa-shopping-cart"></i></button>
                <button class="add-to-cart" id="askcs" onclick="chatAdmin()">Tanya Admin <i class="fab fa-whatsapp"></i></button>
            @else 
                <button class="buy-now" id="checkout" onclick="checkoutWhatsapp()">Beli Sekarang <i class="fas fa-shopping-bag"></i></button>
                <button class="add-to-cart" id="addcart">Tambah Ke Keranjang<i class="fas fa-shopping-cart"></i></button>
                
                 <button class="add-to-cart" id="askcs" onclick="chatAdmin()">Tanya Admin <i class="fab fa-whatsapp"></i></button>
            @endif
                

            </div>
        </div>
    </div>
</div>

<!-- UNTUK ADD CART -->
<!-- END ADD CART --> 
</section>

    <section class="fabric-info">
    <div class="custom-container">
        <div class="section-header-info">
            <h2>INFORMASI PRODUK</h2>
        </div>
    <div class="fabric-info-tab">

<div class="fabric-info-sub-tab">
    <div class="fabric-description">
        <h2 >Deskripsi {{$product->nama_produk}}</h2>
        <p>
           @if($product->pantone_color === null || $product->pantone_color === 'misty' )
           <p>Bahan Kaos {{$product->nama_produk}} adalah {!! strip_tags($aboutEtalase->isi, '<br>') !!}</p>
           <p>Kain {{$product->nama_produk}} ini termasuk dalam kategori warna {{$product->kategori_warna}}.</p> 
            <p>Harga Kain {{$product->nama_produk}} Per roll adalah Rp {{ format_rupiah_tanpa_simbol($product->harga_roll) }} dan harga Kain {{$product->nama_produk}} per kg adalah Rp {{ format_rupiah_tanpa_simbol($product->harga_ecer) }}</p>
           <p>Untuk download katalog warna {{$category->nama_kategori }} {{$etalase }} gratis silahkan klik <a href="https://kainsakurasandang.com/katalog" ><strong>Download Catalog Warna Kain Gratis</strong></a> </p>
            
             <!-- <p class="note" style="text-indent: 0 !important"> *harga diatas dapat berubah sewaktu-waktu tanpa pemberitahuan terlebih dahulu.</p>  -->
           @else
           <p>Bahan Kaos {{$product->nama_produk}} adalah {!! strip_tags($aboutEtalase->isi, '<br>') !!}</p>
           <p>Bahan Kaos {{$product->nama_produk}} ini memiliki kode {{$product->pantone_color}} dengan kode hex {{$product->hex_color}}. Dimana kami menggunakan Pantone TPG sebagai standar warna untuk semua produk kami. Kain {{$product->nama_produk}} ini termasuk dalam ketegori warna {{$product->kategori_warna}}. </p>
           <p>Harga Kain {{$product->nama_produk}} Per roll adalah Rp {{ format_rupiah_tanpa_simbol($product->harga_roll) }} dan harga Kain {{$product->nama_produk}} per kg adalah Rp {{ format_rupiah_tanpa_simbol($product->harga_ecer) }}</p>
            <p>Untuk download katalog warna {{$category->nama_kategori }} {{$etalase }} gratis silahkan klik <a href="https://kainsakurasandang.com/katalog" ><strong>Download Catalog Warna Kain Gratis</strong></a> </p>
            <!-- <p class="note" style="text-indent: 0 !important"> *harga diatas dapat berubah sewaktu-waktu tanpa pemberitahuan terlebih dahulu.</p>  -->
           @endif
        </p>
    </div>

             <div class="fabric-parameters">
                <h2>Penggunaan</h2>
                <div class="fabric-usable">
                <div class="usable">
                    <img src="{{ asset('img/rekomendasi/o-neck-circle.svg') }}" alt="O-necck T-shirt" class="icon" loading='lazy'>
                    <p class="text-center font-08rem w-600 pd-0">O-Neck T-shirt</p>
                </div>
                <div class="usable">
                    <img src="{{ asset('img/rekomendasi/v-neck-circle.svg') }}" alt="V-necck T-shirt" class="icon" loading='lazy'>
                    <p class="text-center font-08rem w-600 pd-0">V-Neck T-shirt</p>
                </div>
                <div class="usable">
                    <img src="{{ asset('img/rekomendasi/sleeves-circle.svg') }}" alt="Long Sleeves" class="icon" loading='lazy'>
                    <p class="text-center font-08rem w-600 pd-0">Long Sleeves</p>
                </div>
                <div class="usable">
                    <img src="{{ asset('img/rekomendasi/raglan-circle.svg') }}" alt="Raglan" class="icon" loading='lazy'>
                    <p class="text-center font-08rem w-600 pd-0">Raglan</p>
                </div>
                <div class="usable">
                    <img src="{{ asset('img/rekomendasi/hoodie-circle.svg') }}" alt="Hoodie" class="icon" loading='lazy'>
                    <p class="text-center font-08rem w-600 pd-0">Hoodie</p>
                </div>
                <div class="usable">
                    <img src="{{ asset('img/rekomendasi/sweater-circle.svg') }}" alt="Sweater" class="icon" loading='lazy'>
                    <p class="text-center font-08rem w-600 pd-0">Sweater</p>
                </div>
                <div class="usable">
                    <img src="{{ asset('img/rekomendasi/zipper-circle.svg') }}" alt="Zipper-Hoodie" class="icon" loading='lazy'>
                    <p class="text-center font-08rem w-600 pd-0">Zipper-Hoodie</h5>
                </div>
                </div>
            </div>
        </div> <!--SUB -->
</div>
</div>
</section>


   
   <section class="estimation-section">
    <div class="custom-container">

        <div class="section-header-info">
            <h2>Perkiraan Hasil Jadi dari <span id="kg-value">1</span> Kg Kain</h2>
            
        </div>
        <div class="calculator">
            <input type="number" id="kgInput" placeholder="Masukkan Kg" min="1" />
            <button onclick="calculateResults()">Hitung</button>
        </div>
        <table class="result-table">
            <thead>
                <tr>
                    <th>Ukuran S</th>
                    <th>Ukuran M</th>
                    <th>Ukuran L</th>
                    <th>Ukuran XL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="size-s">5 Kaos</td>
                    <td id="size-m">4 Kaos</td>
                    <td id="size-l">3 Kaos</td>
                    <td id="size-xl">2 Kaos</td>
                </tr>
            </tbody>
        </table>
        <p class="note">*Ini adalah perkiraan, untuk lebih pastinya silahkan konsultasikan dengan partner konveksi anda.</p>
    </div>
</section>

<section id="latest-product" style="background-color:#ffa3c9;">
    <div class="custom-container">
        <div class="section-header-left">
            <h2>REKOMENDASI KAIN KAOS SAKURA SANDANG</h2>
        </div>
<!--                 <div class="slider-wrapper-latest">
            <div class="latest-product-slider"> -->
        <div class="swiper-container-latest">
            <div class="swiper-wrapper latest-product-container">
                @foreach ($recomendations as $recomendation)
                    <div class="swiper-slide latest-product-card">
                         @if($recomendation->hex_color)
                                <div class="product-color-info-top  text-center jcenter">
                                    <span class="color-bullet" style="background-color: {{ $recomendation->hex_color }};"></span>
                                    <span>{{ $recomendation->pantone_color }}</span>
                                </div>
                            @endif
                        <img 
                            src="{{ $recomendation->image_produk ? asset('img/product/' . $recomendation->image_produk) : asset('img/default.jpg') }}" 
                            srcset="
                                {{ asset('img/product/' . $recomendation->image_produk) }} 480w,
                                {{ asset('img/product/' . $recomendation->image_produk) }} 768w,
                                {{ asset('img/product/' . $recomendation->image_produk) }} 1200w
                            " 
                            sizes="100%" 
                            alt="{{ $recomendation->nama_produk }}" 
                            class="icon" 
                            loading="lazy" 
                            fetchpriority="high">
                        <div class="latest-product-card-content">
                            <div class="latest-product-card-title">{{ $recomendation->nama_produk }}</div>
                            
                            <div class="product-price  text-center dblock w-500"
                            @if($settingServer->status === 'N') 
                                     style="display:none !important;" 
                                 @else 
                                     style="display:block !important;" 
                                 @endif>
                                Rp {{ format_rupiah_tanpa_simbol($recomendation->harga_terendah) }} - 
                                Rp {{ format_rupiah_tanpa_simbol($recomendation->harga_tertinggi) }} /kg (Roll)
                            </div>
                            <div class="product-buttons">
                                <a class="btn buy-btn" href="{{ url('/shop/'. $recomendation->slug_produk ) }}">Beli</a>
                                <!--<button class="btn sample-btn">Sample Gratis</button>-->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            </div>
           
<!--                 </div>

</div> -->
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
    function chatAdmin() {
    var currentUrl = encodeURIComponent(window.location.href); // Mengambil URL halaman saat ini
    var message = 'Halo Admin Sakura Sandang, Saya mau tanya tentang kain {{ urlencode($product->nama_produk) }} yang ada di website. Berikut link produknya: ' + currentUrl;

    var whatsappUrl = 'https://wa.me/6282125423807?text=' + message;
    window.location.href = whatsappUrl; // Redirect ke WhatsApp
}
function mintaSample() {
    var currentUrl = encodeURIComponent(window.location.href); // Mengambil URL halaman saat ini
    var message = 'Halo Admin Sakura Sandang, Saya mau minta sample kain {{ urlencode($product->nama_produk) }} yang ada di website. Berikut link produknya : ' + currentUrl;

    var whatsappUrl = 'https://wa.me/6282125423807?text=' + message;
    window.location.href = whatsappUrl; // Redirect ke WhatsApp
}
function shareWhatsapp() {
    var currentUrl = encodeURIComponent(window.location.href); // Mengambil URL halaman saat ini
    var message = 'Bahan Kaos {{ urlencode($product->nama_produk) }} dari Sakura Sandang Group. Berikut link produknya : ' + currentUrl;

    var whatsappUrl = 'https://wa.me/6282125423807?text=' + message;
    window.location.href = whatsappUrl; // Redirect ke WhatsApp
}
function checkoutWhatsapp() {
    var currentUrl = encodeURIComponent(window.location.href); // Mengambil URL halaman saat ini
    var message = 'Halo Admin Sakura Sandang, Saya mau beli kain {{ urlencode($product->nama_produk) }}  yang ada di website. Berikut link produknya: ' + currentUrl;

    var whatsappUrl = 'https://wa.me/6282125423807?text=' + message;
    window.location.href = whatsappUrl; // Redirect ke WhatsApp
}
</script>

<script type="text/javascript">
    function calculateResults() {
    const kg = parseFloat(document.getElementById('kgInput').value) || 1;
    document.getElementById('kg-value').innerText = kg;

    const results = {
        s: Math.floor(5 * kg),
        m: Math.floor(4 * kg),
        l: Math.floor(3 * kg),
        xl: Math.floor(2 * kg)
    };

    document.getElementById('size-s').innerText = `${results.s} Kaos`;
    document.getElementById('size-m').innerText = `${results.m} Kaos`;
    document.getElementById('size-l').innerText = `${results.l} Kaos`;
    document.getElementById('size-xl').innerText = `${results.xl} Kaos`;
}
    
</script>

<script>
    document.querySelectorAll('.category-button').forEach(button => {
        button.addEventListener('click', function() {
            // Ambil id kategori yang dipilih
            const idKtgwarna = this.getAttribute('data-id');

            const url = new URL(window.location.href);
            url.searchParams.set('id_ktgwarna', idKtgwarna); // Update parameter di URL
            
            // Lakukan fetch untuk mendapatkan warna yang sesuai
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    // Update div dengan warna baru
                    document.querySelector('.color-options-detail').innerHTML = data;
                });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var colorCircles = document.querySelectorAll('.color-option-circle');

        colorCircles.forEach(function(circle) {
            circle.addEventListener('mouseenter', function(event) {
                var colorName = circle.getAttribute('data-name');
                var tooltip = document.createElement('div');
                tooltip.classList.add('tooltip');
                tooltip.textContent = colorName;

                // Mendapatkan posisi lingkaran warna
                var rect = circle.getBoundingClientRect();
                tooltip.style.position = 'absolute';
                tooltip.style.left = (rect.left + window.pageXOffset + rect.width / 2) + 'px';
                tooltip.style.top = (rect.top + window.pageYOffset - 40) + 'px'; // Adjust di atas lingkaran

                document.body.appendChild(tooltip); // Tambahkan tooltip ke body
                circle.tooltip = tooltip;
            });

            circle.addEventListener('mouseleave', function() {
                if (circle.tooltip) {
                    document.body.removeChild(circle.tooltip);
                    circle.tooltip = null;
                }
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

    var colorOptions = document.querySelectorAll('.color-option-detail');
    var moreColorsBtn = document.querySelector('.more-colors-btn-detail');
    var bottomSheet = document.getElementById('colorOptionsBottomSheet');
    var colorSearch = document.getElementById('colorSearch');
    var closeSheet = document.querySelector('.close-sheet-button');
    var colorSheets = document.querySelectorAll('.color-option-detail-sheet');
    var buyNowBtn = document.querySelector('.buy-now');
    var addCart = document.getElementById('addcart');
    var closeAddCart = document.getElementById('closeAddCart');

    var tipe_kategori = "{{ $tipe_kategori }}";
    // Cek jumlah warna yang ditampilkan
    if (colorOptions.length > 5) {
        moreColorsBtn.style.display = 'inline-flex'; // Munculkan tombol jika lebih dari 5 warna
        // Sembunyikan opsi warna tambahan
        colorOptions.forEach(function(option, index) {
            if (index >= 5) {
                option.style.display = 'none'; // Sembunyikan opsi tambahan
            }
        });
    } else {
        moreColorsBtn.style.display = 'none'; // Sembunyikan tombol jika tidak lebih dari 5 warna
    }

    // Klik pada warna untuk mengubah status aktif
    colorOptions.forEach(function(option) {
        option.addEventListener('click', function() {
            // Hapus kelas aktif dari opsi lain dan sembunyikan keterangan warna untuk semua
            colorOptions.forEach(function(opt) {
                opt.classList.remove('active');
                opt.querySelector('.color-desc').style.display = 'none'; // Sembunyikan keterangan warna
            });

            // Tambahkan kelas aktif ke opsi yang diklik dan tampilkan keterangan warna
            option.classList.add('active');
            option.querySelector('.color-desc').style.display = 'block'; // Tampilkan keterangan warna

            // Ambil data-slug dan redirect ke URL
            var slug = option.getAttribute('data-slug');
             
            var category = "{{ $category->slug_kategori }}";
            
            var etalase = "{{ $etalase }}"; // ambil ketebalan dari variabel blade
            window.location.href = `/shop/${tipe_kategori}/${category}/${etalase}/${slug}`;
        });
    });

    // Klik tombol "Pilih Warna Lainnya" untuk menampilkan semua warna
    moreColorsBtn.addEventListener('click', function() {
        bottomSheet.style.display = 'block'; // Tampilkan bottom sheet
    });

    // Klik tombol "close button" untuk keluar sheet
    closeSheet.addEventListener('click', function() {
        bottomSheet.style.display = 'none'; // Tampilkan bottom sheet
        addCartBottomSheet.style.display = 'none';
    });

    // Klik pada warna di sheet untuk mengubah status aktif
    colorSheets.forEach(function(opti) {
        opti.addEventListener('click', function() {
            var slugSheet = opti.getAttribute('slug-sheet');
            

            var category = "{{ $category->slug_kategori }}"; // ambil slug kategori dari variabel blade
            var etalase = "{{ $etalase }}"; // ambil ketebalan dari variabel blade

            // Redirect ke URL
            window.location.href = `/shop/${slugSheet}`;
        });
    });

    // Klik di luar bottom sheet untuk menutupnya
    window.addEventListener('click', function(event) {
        if (event.target === bottomSheet) {
            bottomSheet.style.display = 'none'; // Tutup bottom sheet
        }
    });

    // Filter warna berdasarkan input pencarian
    colorSearch.addEventListener('input', function() {
        var filter = this.value.toLowerCase();
        colorSheets.forEach(function(option) {
            var colorName = option.querySelector('.color-desc-sheet').textContent.toLowerCase();
            if (colorName.includes(filter)) {
                option.style.display = 'flex'; // Tampilkan jika cocok
            } else {
                option.style.display = 'none'; // Sembunyikan jika tidak cocok
            }
        });
    });
    
});
</script>
   <script>
    const prevButton = document.querySelector('.slider-nav.prev');
const nextButton = document.querySelector('.slider-nav.next');

// Get all thumbnail images
const thumbnails = document.querySelectorAll('.product-image-thumbnails img');
const imageContainer = document.querySelector('.product-full-image-wrapper');

// Create an array of image objects from thumbnail elements
const images = Array.from(thumbnails).map(img => ({
    fullsize: img.dataset.fullsize, // Full-size image URL
    srcset: img.dataset.srcset,    // Srcset for responsive images
    sizes: img.dataset.sizes       // Sizes attribute for responsive images
}));

// Initialize current index
let currentIndex = 0;

// Function to change image based on index or next/prev
function changeImage(imagePath, thumbnail = null) {
    if (imagePath === 'prev') {
        currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
    } else if (imagePath === 'next') {
        currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
    } else {
        const index = images.findIndex(img => img.fullsize === imagePath);
        currentIndex = (index !== -1) ? index : currentIndex;
    }

    // Update the main image attributes
    const mainImage = document.getElementById('mainImage');
    mainImage.src = images[currentIndex].fullsize;
    mainImage.srcset = images[currentIndex].srcset;
    mainImage.sizes = images[currentIndex].sizes;

    // Update active thumbnail
    thumbnails.forEach((img, index) => {
        img.classList.toggle('active', index === currentIndex);
    });
}

// Event listeners for mouse enter and leave
imageContainer.addEventListener('mouseenter', showButtons);
imageContainer.addEventListener('mouseleave', hideButtons);

let hideTimeout;

// Function to hide buttons after 6 seconds
function hideButtons() {
    hideTimeout = setTimeout(() => {
        prevButton.classList.add('hidden');
        nextButton.classList.add('hidden');
    }, 6000);
}

// Function to show buttons
function showButtons() {
    clearTimeout(hideTimeout);
    prevButton.classList.remove('hidden');
    nextButton.classList.remove('hidden');
    hideButtons(); // Restart the timer
}

// Initialize button visibility
hideButtons();

// Set initial image and active thumbnail
changeImage(images[0].fullsize);
thumbnails.forEach(thumbnail => {
    thumbnail.addEventListener('click', () => {
        changeImage(thumbnail.dataset.fullsize);
    });
});
   </script>
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.category-button').on('click', function() {
        var ktgwarna = this.getAttribute('id-ktgwarna');
        var category = "{{ $category->slug_kategori }}"; // ambil slug kategori dari variabel blade
        var etalase = "{{ $etalase }}"; // ambil ketebalan dari variabel blade
        var activeColorElement = document.querySelector('.color-option-detail.active');
        var slugproduk = activeColorElement.getAttribute('data-slug');
        var datacolor = activeColorElement.getAttribute('data-color');
        // Check if activeColorElement is not null
        if (activeColorElement) {
            var hexColor = activeColorElement.getAttribute('data-hex');
           
        } else {
            console.error('No active color element found.');
            return; // Stop execution if no active color element
        }

        // Update active class for category buttons
        $('.category-button').removeClass('active');
        $(this).addClass('active');

          $('#loading').show();
        $('.color-options-detail').hide();

        // Perform AJAX request
        $.ajax({
            url: '/shop/filter-colors',
            type: 'POST',
            data: {
                category: category,
                etalase: etalase,
                ktgwarna: ktgwarna,
                hexcolor: hexColor,
                slugproduk: slugproduk,
                datacolor: datacolor
            },
            success: function(response) {
                console.log(response);
               $('.color-options-detail').html(response.html);
                $('.color-options-detail').show();
            },
            error: function(xhr) {
                console.log('Error:', xhr.responseText);
            },
            complete: function() {
                $('#loading').hide(); // Hide loading indicator after request completion
            }
        });
    });
        
    
    

});
</script>
@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "{{ $product->nama_produk }}",
  "image": "https://kainsakurasandang.com/img/product/{{ $product->image_produk }}",
  "description": "Bahan Kaos {{$product->nama_produk}} adalah {!! strip_tags($aboutEtalase->isi, '<br>') !!}",
  "sku": "{{$product->kode_produk}}",
  "mpn": "{{ $product->kode_produk }}",
  "brand": {
    "@type": "Brand",
    "name": "Sakura Sandang"
  },
  "offers": {
    "@type": "Offer",
    "url": "{{ url()->current() }}",
    "priceCurrency": "IDR",
    "price": "{{ $product->harga_roll }}",
    "priceValidUntil": "2025-12-31",  // Misalnya, harga ini valid sampai akhir tahun 2025
    "itemCondition": "https://schema.org/NewCondition",
    "availability": "https://schema.org/InStock"
  }
}
</script>
@endpush
@endsection

