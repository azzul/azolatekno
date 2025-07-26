@extends('layouts.app2')


@section('content')
@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "{{ url('/') }}"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Toko Bahan Kaos",
      "item": "{{ url('/stores') }}"
    }
    @foreach ($stores as $index => $store)
    ,{
      "@type": "ListItem",
      "position": {{ $index + 3 }},
      "name": "Toko Bahan Kaos {{ ucwords(strtolower($store->nama_toko)) }}",
      "item": "{{ url('/stores/' . $store->slug_toko) }}"
    }
    @endforeach
  ]
}
</script>
@endpush
<section class="detail-store-section" >
        <div class="custom-container">
            <div class="section-header" style="margin-bottom:20px !important;margin-top:20px !important;">
          <h1>TOKO BAHAN KAOS TERBAIK</h1>
          <p>Untuk mempermudah anda menjangkau toko bahan kaos terdekat dengan kualitas terbaik harga menarik. Kami telah memiliki toko kain kaos terbaik di 6 kota yaitu Solo, Yogyakarta, Semarang, jakarta, Cirebon dan Bali. </p>
        </div>
         <div class="flex-main-image">
        <img id="main-image" src="{{ asset('img/content/toko-bahan-kaos.webp') }}" 
     srcset="{{ asset('img/content/toko-bahan-kaos.webp') }} 480w, 
             {{ asset('img/content/toko-bahan-kaos.webp') }} 768w, 
             {{ asset('img/content/toko-bahan-kaos.webp') }} 1200w"
     sizes="(max-width: 480px) 480px, 
            (max-width: 768px) 768px, 
            1200px"
     class="thumbnail-image" 
     alt="Toko Bahan Kaos" >
    </div>
           <div class="store-list-new">
    @foreach ($stores as $store)
        <div class="store-card">
            <div class="store-content-new">
                <h2 class="store-title">
                    TOKO KAIN KAOS {{ $store->nama_toko }}
                </h2>
                <p class="store-address">{{ capitalizeWordsFromUppercase($store->alamat) }}</p>
                
                @if ($store->iframe_gmaps)
                    <div class="map-container">
                        <iframe src="{{ $store->iframe_gmaps }}" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                @endif

                <div class="store-links-new">
                    <a href="{{ $store->link_gmaps }}" target="_blank" class="store-link-new" rel="nofollow noopener noreferrer">
                        <i class="fas fa-map-marker-alt"></i> Petunjuk Lokasi
                    </a>
                    <a href="https://wa.me/6282313996109?text=Halo%20Admin%20Altratex,%2C%20Saya%20dapat%20kontak%20dari%20website%20{{ urlencode(url()->current()) }}.%20Mau%20minta%20kontak%20whatsapp%20toko%20{{ urlencode(capitalizeWordsFromUppercase($store->nama_toko)) }}." target="_blank" class="store-link-new" rel="nofollow noopener noreferrer">
                        <i class="fab fa-whatsapp"></i> Pesan WhatsApp
                    </a>
                </div>
                
            </div>
        </div>
    @endforeach
</div>
    </div>
    </section>

<section id="catalog">
    <div class="width_100 bg_image1">
        <div class="catalog-wrapper">
        <div class="catalog-card">
            <img src="{{ asset('img/catalog.webp') }}" alt="Catalog Warna Bahan Kaos" class="catalog-image" loading="lazy">
            <div class="catalog-content">
                <h2>Download Katalog Warna Kain Kaos Gratis Dari Altratex Sekarang</h2>
                <p>Tersedia Katalog warna combed 20s, Katalog warna combed 24s, Katalog warna combed 30s, Katalog warna carded 20s, Katalog warna carded 24s, Katalog warna carded 30s</p>

                <a href="https://altratex.com/catalog">
                    <button class="catalog-button">
                        <i class="fas fa-download"></i> Download E-Katalog 
                    </button>
                </a>
        </div>
        </div>
    </div>
</section>

<section id="produk" >
    <div class="custom-container">
        <div class="section-header" style="margin-bottom:20px !important;margin-top:20px !important;">
          <h2>PRODUK KAIN KAOS TERLENGKAP YANG TERSEDIA DI TOKO KAMI</h2>
          <p>Sebagai produsen kain kaos yang terintegrasi, kami menyediakan koleksi kain terlengkap dan terbaik untuk kebutuhan usaha anda.</p>
        </div>
        <div class="daftar-container">
        <div class="daftar-produk">
            <h2>Produk Katun dan Variasi</h2>
            <ul>
              <li><a href="{{ url('/shop/fabric/cotton-combed/20s') }}" style="font-weight: bold;">Cotton Combed 20s</a></li>
              <li><a href="{{ url('/shop/fabric/cotton-combed/24s') }}" style="font-weight: bold;">Cotton Combed 24s</a></li>
              <li><a href="{{ url('/shop/fabric/cotton-combed/30s') }}" style="font-weight: bold;">Cotton Combed 30s</a></li>
              <li>Cotton Combed 32s</li>
              <li>Cotton Combed 40s</li>
              <li>Cotton Combed 50s</li>
              <li>Cotton Combed Bakar Bulu, Enzim Washing</li>
              <li><a href="{{ url('/shop/fabric/cotton-carded/20s') }}" style="font-weight: bold;">Cotton Carded 20s</a></li>
              <li><a href="{{ url('/shop/fabric/cotton-carded/24s') }}" style="font-weight: bold;">Cotton Carded 24s</a></li>
              <li><a href="{{ url('/shop/fabric/cotton-carded/30s') }}" style="font-weight: bold;">Cotton Carded 30s</a></li>
              <li>Cotton Carded 32s</li>
              <li>Cotton Carded 40s</li>
              <li>Cotton Carded 50s</li>
              <li>Cotton Carded Bakar Bulu, Enzim Washing</li>
              <li>Cotton Bamboo dan Cotton Tencel</li>
              <li>Melange CM, CVC, TCM (M61, M68, M71, M81)</li>
              <li>Fleece Cotton, CVC, PE</li>
              <li>Bodysize Cotton, TCM, CVC, Rayon, PE</li>
            </ul>
          </div>

          <div class="daftar-produk">
            <h2>Spandex, PE dan Kain Lainnya</h2>
            <ul>
              <li>CVC, TCM, TR, Rayon, Polyester</li>
              <li>Spandex Cotton Comb, CVC, TR, Rayon</li>
              <li>Spandex Sutra Cool Max, Balon, Denim</li>
              <li>Aerosoft Rayon LICRA (390-410 GSM)</li>
              <li>Excelsoft Rayon LICRA (320-340 GSM)</li>
              <li>SKPE20, SKPE24, SKPE30, DKPE40</li>
              <li>Lacoste Cotton, CVC, TC, PE</li>
              <li>Kain Kulit Jeruk, Abutay, Higet, Lotto</li>
              <li>Scuba, Diadora, Adidas, Paragon</li>
              <li>Jersey Golf Dryfit, Bensema, RockSport</li>
              <li>Printing Piqmen/Reaktif di Cotton/CVC</li>
              <li>Kain Motif Knitting (Herringbone, Twill Knit)</li>
              <li>Baby Terry, Fency Terry, Handuk 1 Muka</li>
            </ul>
          </div>

          <div class="daftar-produk">
            <h2>Produk Tambahan</h2>
            <ul>
              <li>Kain Voal dan Baby Kanvas</li>
              <li>Anti Bakteri, Anti UV, Quick Dry</li>
              <li>Anti Nyamuk, Warm Efek, Cool Max</li>
              <li>Water Repellent</li>
              <li>Macam-macam Rib dan Kerah</li>
              <li>Elastik dan Plastic BOPP & LLDPE</li>
              <li>Dan Lain-Lain</li>
            </ul>
          </div>
        </div>
    </div>
</section>
@endsection