@extends('layouts.app')

@section('content')

    <!-- Navigasi Breadcrumb -->
    <section id="breadcrumb-section" style="background-image: url('{{ asset('img/bg_category.svg') }}'); background-size: cover; background-position: center; height: 20vh;">
        <div class="custom-container">
            <div class="breadcrumb-text">
                <a href="{{ url('/') }}">Home</a> / <a href="{{ url('/shop') }}">Belanja</a> / <span class="W-500">{{ $category->nama_kategori }} </span>
            </div>
            <div class="breadcrumb-section-judul w-700">{{ $category->nama_kategori }}</div>
        </div>
    </section>

    <!-- Daftar Produk -->
    <section class="products-section">
        <div class="custom-container">
             <div class="section-header">
            <h1>{{ $category->nama_kategori }} - Sakura Sandang </h1>
        </div>
           <div class="product-grid">
    @foreach ($products as $product)
        <div class="product-card-detail">
            <img src="{{ asset('img/etalase/' . $product->img_etalase) }}" alt="{{ $product->nama_kategori }} {{ $product->etalase }}">
            <div class="product-card-content-category">
                @if (!empty($product->total)) 
                    <p class="text-center pleft-0 mbottom-10 main-red w-600">{{ $product->total }} varian produk</p>
                @endif
                <h3 class="product-card-title-category mtop-0 pt-0 mleft-0 mright-0 pl-0 pr-0">
                    {{ $product->nama_kategori }} {{ $product->etalase }}
                </h3>
                <!-- Menampilkan warna produk -->
                <div class="product-colors">
                    @php
                        $colors = explode(',', $product->hex_colors); // Pisahkan warna
                        $displayColors = array_slice($colors, 0, 5); // Ambil 5 warna pertama
                        $remainingColors = count($colors) - count($displayColors); // Hitung sisa warna
                    @endphp
                    <div class="circle-color-flex">
                        @foreach ($displayColors as $color)
                            <span class="color-circle" style="background-color: {{ $color }};"></span>
                        @endforeach
                    </div>
                    @if ($remainingColors > 0)
                        <button class="more-colors-btn">{{ $remainingColors }} warna lainnya <i class="fas fa-palette"></i></button>
                    @endif
                </div>
                <div class="product-price text-center dblock w-500"
                    @if($settingServer->status === 'N') 
                        style="display:none !important;" 
                    @else 
                        style="display:block !important;" 
                    @endif>
                    Rp {{ format_rupiah_tanpa_simbol($product->harga_terendah) }} - 
                    Rp {{ format_rupiah_tanpa_simbol($product->harga_tertinggi) }} /kg (Roll)
                </div>
                <div class="product-buttons">
                    <a class="btn buy-btn" href="{{ url('/shop/'.$tipe_kategori .'/'.$category->slug_kategori. '/' . $product->etalase) }}">PILIH</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
    </section>

    <!-- Section Tentang Produk -->

    <section class="product-info-section">
    <div class="custom-container">
        <div class="section-header">
            <h2>Tentang {{ $category->nama_kategori }}</h2>
            <p></p>
        </div>
        
        <div class="product-info-card">
            <div class="product-info-content">
                <div class="product-info-text">
                    <div class="expandable-section expanded">
                        <div class="expandable-header">
                            <h2>Ringkasan Produk {{ $category->nama_kategori }}</h2>
                            <button class="expand-btn">-</button>
                        </div>
                        {!! $konten->long_desc !!}
                    </div>
                    <div class="expandable-section">
                        <div class="expandable-header">
                            <h2>Penggunaan {{ $category->nama_kategori }}</h2>
                            <button class="expand-btn">+</button>
                        </div>
                        {!! $konten->penggunaan !!}
                    </div>
                    <div class="expandable-section">
                        <div class="expandable-header">
                            <h2>Perawatan Produk {{ $category->nama_kategori }}</h2>
                            <button class="expand-btn">+</button>
                        </div>
                        {!! $konten->perawatan !!}
                    </div>
                </div>
                <div class="product-media">
                   @php
                        use Illuminate\Support\Str;
                    @endphp
                    <img 
                        src="{{ Str::contains($category->nama_kategori, 'Plastik') ? asset('img/category/plastik-opp.png') : asset('img/detail/combed-zoom.jpg') }}" 
                        alt="Cotton Combed" 
                        class="product-info-img"
                    />
                </div>
            </div>
        </div>

        <!-- <div class="product-video">
      <iframe width="560" height="315" src="https://www.youtube.com/embed/C9C7djmw7jw?si=UE6t3VC4Sf336hFw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div> -->

    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const expandableSections = document.querySelectorAll('.expandable-section');

    expandableSections.forEach(section => {
        const button = section.querySelector('.expand-btn');
        button.addEventListener('click', function() {
            const isExpanded = section.classList.contains('expanded');
            
            // Collapse all sections
            expandableSections.forEach(sec => {
                sec.classList.remove('expanded');
                sec.querySelector('.expandable-text').style.display = 'none';
                sec.querySelector('.expand-btn').textContent = '+';
            });

            // Expand the clicked section
            if (!isExpanded) {
                section.classList.add('expanded');
                section.querySelector('.expandable-text').style.display = 'block';
                section.querySelector('.expand-btn').textContent = '-';
            }
        });
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

    $('.category-item').on('click', function() {
        var filter = $(this).data('filter');
        var categoryName = "{{ $category->slug_kategori }}"; 
        var tipe = "{{ $tipe_kategori }}";// Make sure this is correctly populated

        $('.category-item').removeClass('active');
        $(this).addClass('active');

        $.ajax({
            url: '/shop/' + tipe + '/' + categoryName + '/filter',
            type: 'POST',
            data: {
                filter: filter
            },
            success: function(response) {
                $('.product-grid').html(response.html);
            },
            error: function(xhr) {
                console.log('Error:', xhr.responseText);
            }
        });
    });
});

</script>
@endsection