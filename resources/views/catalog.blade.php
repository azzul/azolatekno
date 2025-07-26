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
      "name": "Katalog",
      "item": "{{ url('/katalog') }}"
    }
  ]
}
</script>
@endpush
@section('content')
    <section id="breadcrumb-section-about" >
        <div class="custom-container">
            <div class="breadcrumb-text">
                 <a href="{{ url('/') }}">Home</a> / 
                <span class="W-500">Katalog</span>
            </div>
        </div>
    </section>
<section class="products-section">
    <div class="custom-container">

            <div class="section-header-left">
                <h1>KATALOG WARNA KAIN</h2>
                <p>
                    Temukan katalog warna kain lengkap dengan berbagai pilihan bahan berkualitas, seperti kain combed, PE, TC, dan lainnya. 
                    Kami menyediakan katalog kain terbaik untuk kebutuhan produksi pakaian, konveksi, atau bisnis tekstil Anda. 
                    Jelajahi warna-warna menarik dan temukan inspirasi untuk proyek kreatif Anda. 
                    Pilihan kain berkualitas tinggi dengan harga terbaik hanya di sini.
                </p>
            </div>
            <div class="product-grid">
                    <div class="product-card-detail">
                        <img src="{{ asset('img/content/katalog-cotton.webp') }}" alt="Katalog Kain Cotton"
                        width="600" 
                        height="400" 
                        fetchpriority="high"
                        srcset="
                       {{ asset('img/content/katalog-cotton.webp') }} 600w,
                        {{ asset('img/content/katalog-cotton.webp') }} 300w"
                        sizes="(max-width: 768px) 100vw, 600px"
                        style="max-width: 100%; height: auto;" >
                        <div class="product-card-content-category">
                            <h3 class="product-card-title-category mtop-0 pt-0 mleft-0 mright-0 pl-0 pr-0">Katalog Cotton</h3>
                            <div class="description">Pilihan warna kain cotton terbaik untuk kenyamanan dan kualitas tinggi.</div>
                        <div class="product-buttons">
                        <a href="https://drive.google.com/file/d/1271ny_-mj56bgp__zeyJqRneMfD9vTB_/view?usp=sharing" rel="nofollow" target="_blank" class="btn buy-btn" href="">Download Pdf</a>
                        </div>
                        </div>
                        
                    </div>
                    <div class="product-card-detail">
                        <img src="{{ asset('img/content/katalog-pe.webp') }}" alt="Katalog Kain PE"
                        width="600" 
                        height="400" 
                        fetchpriority="high"
                        srcset="
                       {{ asset('img/content/katalog-pe.webp') }} 600w,
                        {{ asset('img/content/katalog-pe.webp') }} 300w"
                        sizes="(max-width: 768px) 100vw, 600px"
                        style="max-width: 100%; height: auto;" >
                        <div class="product-card-content-category">
                            <h3 class="product-card-title-category mtop-0 pt-0 mleft-0 mright-0 pl-0 pr-0">Katalog PE (Polyester)</h3>
                            <div class="description">Katalog warna kain PE tahan lama dengan harga terjangkau.</div>
                            <div class="product-buttons">
                        <a href="https://drive.google.com/file/d/1OpLyZ4h7ra6mNbQf1I3d6MK8Btx8PBBT/view?usp=sharing" rel="nofollow" target="_blank" class="btn buy-btn" href="">Download Pdf</a>
                        </div>
                        </div>
                        
                    </div>
            </div>
    </div>
</section>
<section id="supplier">

      <div class="custom-container">

        <div class="section-header-left">
          <h2>KOLEKSI LENGKAP BAHAN KAOS - SAKURA SANDANG SOLO</h2>
          <p></p>
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
      </div>
    </section>
@endsection