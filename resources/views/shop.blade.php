@extends('layouts.app-simple')
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
      "name": "Belanja",
      "item": "{{ url('/shop') }}"
    }
  ]
}
</script>
@endpush
@section('content')

    <!-- Navigasi Breadcrumb -->
    <section id="breadcrumb-section-shop" >
        <div class="custom-container">
            <div class="breadcrumb-text">
                <a href="{{ url('/') }}">Home</a> / <span class="W-500">Belanja</span>
            </div>
            <div class="breadcrumb-section-judul w-700"><H1>BELANJA KAIN KAOS BERKUALITAS</H1></div>
            <p class="paragraph-no-indent">Belanja Kain Kaos, Kain Kaos Polo, Bahan Jaket, Aksesoris Kain dan Katalog Warna Kain</p>
        </div>
    </section>

    <!-- Daftar Produk -->
  <section class="products-section">
    <div class="custom-container">
        @foreach($kategoriUtama->groupBy('kategori_utama') as $utama => $kategoriGroup)
            <div class="section-header-left pt-40">
                <h2>KAIN KAOS {{ $utama }} </h2>
                <p></p>
            </div>
            <div class="product-grid">
                @foreach($kategoriGroup as $kategori)
                    <div class="product-card-detail">
                        <img src="{{ asset('img/category/' . $kategori->img_kategori) }}" alt="{{ $kategori->nama_kategori }}"
                        width="600" 
                        height="400" 
                        fetchpriority="high"
                        srcset="
                        {{ asset('img/category/' . $kategori->img_kategori) }} 600w,
                        {{ asset('img/category/' . $kategori->img_kategori) }} 300w"
                        sizes="(max-width: 768px) 100vw, 600px"
                        style="max-width: 100%; height: auto;" >
                        <div class="product-card-content-category">
                            <h3 class="product-card-title-category mtop-0 pt-0 mleft-0 mright-0 pl-0 pr-0">{{ $kategori->nama_kategori }}</h3>
                            <div class="description">{{ $kategori->deskripsi_kategori }}</div>
                        </div>
                        <div class="btn-container">
                            <a class="circle-btn" href="{{ url('/shop/'. $kategori->tipe_kategori . '/' . $kategori->slug_kategori ) }}">
                                <span class="btn-text">Pilih Kategori </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</section>

@endsection