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
      "name": "Daftar Harga",
      "item": "{{ url('/pricelist') }}"
    }
  ]
}
</script>
@endpush
@push('scripts')
<script>

    if (isMobile) {
        preloadImage('{{ asset("img/pricelist-mobile.jpg") }}');
    } else {
        preloadImage('{{ asset("img/pricelist.jpg") }}');
    }
</script>
@endpush
@section('content')
    <section id="breadcrumb-section-about" >
        <div class="custom-container">
            <div class="breadcrumb-text">
                 <a href="{{ url('/') }}">Home</a> / 
                <span class="W-500">Pricelist</span>
            </div>
        </div>
    </section>
<section id="pricelist-table" class="pt-0">
    <div class="custom-container pt-0">
        <div class="section-header">
            <h1>{{$meta->title}}</h1>
            <p>{{$meta->description}}</p>
        </div>
         <picture>
            <!-- Source untuk layar kecil -->
            <source media="(max-width: 768px)" srcset="{{ asset('img/pricelist-mobile.jpg') }}">
            
            <!-- Source default (untuk desktop) -->
            <source media="(min-width: 769px)" srcset="{{ asset('img/pricelist.jpg') }}">

            <!-- Fallback untuk browser yang tidak support <picture> -->
            <img src="{{ asset('img/pricelist.jpg') }}" class="image-page" alt="Daftar Harga Layanan Web, SEO, Digital, AI dan Course AI" loading="lazy">
        </picture>
        <div class="action-buttons">
                         <a href="{{ route('pricelist.pdf') }}" class="add-to-cart" target="_blank">
                            <i class="fas fa-download"></i> Download Pricelist PDF
                        </a>
                         <p>* Klik Tombol download untuk download pricelist pdf</p>
                    </div>
        <div class="price-list">
            <div class="table-container">
                    <div class="category-section" >
                       
                        <table class="priceTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Armada</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach($prices as $index => $price)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if($price->produk && $price->produk->image_produk)
                                                <img src="{{ asset('img/product/' . $price->produk->image_produk) }}" alt="{{ $price->produk->nama_produk }}" height="90">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $price->produk->nama_produk ?? '-' }}</td>
                                        <td>Rp {{ number_format($price->harga, 0, ',', '.') }}</td>
                                        <td>{{ $price->produk->short_desc ?? '-' }}</td>
                                        <td>
                                            <a href="{{url('/layanan/' .$price->produk->slug_produk)}}" class="btn btn-sm btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection