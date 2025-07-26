@extends('layouts.app')

@section('content')

    <!-- Navigasi Breadcrumb -->
    <section id="breadcrumb-section" style="background-image: url('{{ asset('img/bg_ketebalan.svg') }}'); background-size: cover; background-position: center; height: 20vh;">
        <div class="custom-container">
            <div class="breadcrumb-text">
                 <a href="{{ url('/') }}">Home</a> / 
                <a href="{{ url('/shop') }}">Belanja</a> / 
                <a href="{{ url('/shop/'.$tipe_kategori.'/' . $category->slug_kategori) }}">{{ $category->nama_kategori }}</a> / 
                <span class="W-500">{{ $etalase}}</span>
            </div>
            <div class="breadcrumb-section-judul w-700">{{ $category->nama_kategori }}</div>
        </div>
    </section>

    <!-- Daftar Produk -->

<section class="products-section">
    <div class="custom-container">
        <div class="section-header">
            <h1>{{ $category->nama_kategori }} {{ $etalase }}</h1>
        </div>
        @if($allProducts)
        <div class="header-options">
            <div class="search-box">
                <input type="text" placeholder="Cari item.." id="searchItem" oninput="searchFunction()">
                <button onclick="searchFunction()">Cari</button>
            </div>
            <div class="item-options">
                <select id="itemsPerPage" onchange="setItemsPerPage()">
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                </select>
            </div>
        </div>
        <div class="product-grid">
            <!-- Product items are dynamically rendered by JavaScript -->
        </div>
       <div class="pagination-container">
    <!-- Tombol Previous -->
    <button 
        class="pagination-btn prev" 
        onclick="changePage(currentPage - 1)" 
    >
        <i class="fas fa-chevron-left"></i>
    </button>

    <!-- Nomor Halaman -->
    <div class="pagination-numbers">
        {{-- Pagination numbers will be dynamically generated --}}
    </div>

    <!-- Tombol Next -->
    <button 
        class="pagination-btn next" 
        onclick="changePage(currentPage + 1)"
    >
        <i class="fas fa-chevron-right"></i>
    </button>
</div>

<!-- Tombol Lihat Lainnya -->
<div class="lihat-lainnya">
    @if ($totalProducts > $products->count())
        <button id="loadMoreBtn" onclick="loadMore()">Lihat lainnya</button>
    @endif
</div>
                
@endif
    </div>
</section>

    <!-- Section Tentang Produk -->
@if ($aboutEtalase)

<section id="etalase-kain">
        <div class="custom-container">
            @if($tipe_kategori === 'fabric')
            <div class="section-header">
            <h2>Bahan Kaos {{ $category->nama_kategori }} {{ $etalase }}</h2>
            </div>
            <div class="pengertian">
                <p>Bahan Kaos {{ $category->nama_kategori }} {{ $etalase }} adalah {!! strip_tags($aboutEtalase->isi, '<br>') !!}</p>
            </div>
            @else
            <div class="section-header">
            <h2>{{ $category->nama_kategori }} {{ $etalase }}</h2>
            </div>
            <div class="pengertian">
                <p>{!! strip_tags($aboutEtalase->isi, '<br>') !!}</p>
            </div>
            @endif
            <div class="kelebihan">
                <h2 class="w-600 mtop-40 uppercase">KELEBIHAN {{ $category->nama_kategori }} {{ $etalase }}</h2>
                <div class="kelebihan-wrap">
                    @if($spesifikasi)
                    @foreach ($spesifikasi as $spek)
                        <div class="item">
                            <img src="{{ asset('img/icon/etalase/' . $spek->img_konten) }}" alt="Kelembutan Icon" class="icon">
                            <h5 class="text-center">{{$spek->judul}}</h5>
                            <div class="description">{!! $spek->isi !!}</div>
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>
        
            <div class="penggunaan" style="{{ $tipe_kategori != 'fabric' ? 'display:none !important;' : 'display:flex !important;' }}">
                <h2 class="w-600 mtop-40 uppercase">PENGGUNAAN {{ $category->nama_kategori }} {{ $etalase }}</h2>
            <div class="penggunaan-grid">
                <div class="item-kegunaan">
                    <img src="{{ asset('img/rekomendasi/o-neck-circle.svg') }}" alt="O-necck T-shirt" class="icon">
                    <h5 class="text-center font-1rem w-500">O-Neck T-shirt</h5>
                </div>
                <div class="item-kegunaan">
                    <img src="{{ asset('img/rekomendasi/v-neck-circle.svg') }}" alt="V-necck T-shirt" class="icon">
                    <h5 class="text-center font-1rem w-500">V-Neck T-shirt</h5>
                </div>
                <div class="item-kegunaan">
                    <img src="{{ asset('img/rekomendasi/sleeves-circle.svg') }}" alt="Long Sleeves" class="icon">
                    <h5 class="text-center font-1rem w-500">Long Sleeves</h5>
                </div>
                <div class="item-kegunaan">
                    <img src="{{ asset('img/rekomendasi/raglan-circle.svg') }}" alt="Raglan" class="icon">
                    <h5 class="text-center font-1rem w-500">Raglan</h5>
                </div>
                <div class="item-kegunaan">
                    <img src="{{ asset('img/rekomendasi/hoodie-circle.svg') }}" alt="Hoodie" class="icon">
                    <h5 class="text-center font-1rem w-500">Hoodie</h5>
                </div>
                <div class="item-kegunaan">
                    <img src="{{ asset('img/rekomendasi/sweater-circle.svg') }}" alt="Sweater" class="icon">
                    <h5 class="text-center font-1rem w-500">Sweater</h5>
                </div>
                <div class="item-kegunaan">
                    <img src="{{ asset('img/rekomendasi/zipper-circle.svg') }}" alt="Zipper-Hoodie" class="icon">
                    <h5 class="text-center font-1rem w-500">Zipper-Hoodie</h5>
                </div>
                </div>
            </div>
        </div>
    </section>
     @endif
  <script>
    // Initialize global variables
    const allProducts = @json($allProducts); // Assuming this is passed from the controller
    const etalase = @json($etalase);
    let currentPage = parseInt(new URLSearchParams(window.location.search).get('page')) || 1;
    let productsPerPage = parseInt(new URLSearchParams(window.location.search).get('itemsPerPage')) || 20;
    const MAX_SEARCHES = 100;
    const RESET_TIME = 60 * 60 * 1000; // 1 hour in milliseconds

    // Set itemsPerPage dropdown to the current value
    document.getElementById('itemsPerPage').value = productsPerPage;

    // Function to display products based on page and items per page
    function displayProducts(products) {
        const productGrid = document.querySelector('.product-grid');
        productGrid.innerHTML = ''; // Clear previous items

        products.forEach(product => {
            const hargaTerendah = Number(product.harga_terendah) || 0;
            const hargaTertinggi = Number(product.harga_tertinggi) || 0;

            const hargaTerendahFormatted = hargaTerendah.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            const hargaTertinggiFormatted = hargaTertinggi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            const productCard = `
                <div class="product-card-detail">
                    <img src="{{ asset('img/product/') }}/${product.image_produk}" alt="${product.nama_produk}">
                    ${product.hex_color ? `
                        <div class="product-color-info-top">
                            <span class="color-bullet" style="background-color: ${product.hex_color};"></span>
                            <span>${product.pantone_color || 'Tidak Diketahui'}</span>
                        </div>` : ''}
                    <div class="product-card-content-category">
                        <h3>${product.nama_produk}</h3>
                        <div class="product-price text-center dblock w-500" @if($settingServer->status === 'N') 
                                     style="display:none !important;" 
                                 @else 
                                     style="display:block !important;" 
                                 @endif>
                            Rp ${hargaTerendahFormatted} - 
                            Rp ${hargaTertinggiFormatted} /kg (Roll)
                        </div>
                        <div class="product-buttons">
                            <a class="btn buy-btn" href="/shop/${product.slug_produk}">
                                Beli
                            </a>
                        </div>
                    </div>
                </div>
            `;
            productGrid.innerHTML += productCard;
        });
    }

    // Function to dynamically update pagination
    function updatePagination(totalPages) {
        const paginationNumbers = document.querySelector('.pagination-numbers');
        paginationNumbers.innerHTML = ''; // Clear previous page numbers

        if (totalPages === 0) {
            paginationNumbers.innerHTML = 'No products found';
            return;
        }

        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement('button');
            button.className = 'pagination-btn';
            if (i === currentPage) button.classList.add('active');
            button.textContent = i;
            button.onclick = () => changePage(i);
            paginationNumbers.appendChild(button);
        }

        // Enable/disable prev and next buttons
        document.querySelector('.pagination-btn.prev').disabled = currentPage <= 1;
        document.querySelector('.pagination-btn.next').disabled = currentPage >= totalPages;
    }

    // Function to change the page
    function changePage(page) {
        const totalPages = Math.ceil(allProducts.length / productsPerPage);
        if (page >= 1 && page <= totalPages) {
            currentPage = page;
            updateUrlAndDisplay();
        }
    }

    // Function to update the URL without reloading the page and refresh display
    function updateUrlAndDisplay() {
        const totalPages = Math.ceil(allProducts.length / productsPerPage);
        const startIndex = (currentPage - 1) * productsPerPage;
        const endIndex = startIndex + productsPerPage;

        displayProducts(allProducts.slice(startIndex, endIndex));

        // Update the URL to reflect the current page and items per page
        const url = new URL(window.location.href);
        url.searchParams.set('page', currentPage);
        url.searchParams.set('itemsPerPage', productsPerPage);
        window.history.replaceState(null, '', url);

        // Update pagination buttons
        updatePagination(totalPages);
    }

    // Function to handle changes in itemsPerPage dropdown
    function setItemsPerPage() {
        productsPerPage = parseInt(document.getElementById('itemsPerPage').value);
        currentPage = 1; // Reset to first page when itemsPerPage is changed
        updateUrlAndDisplay();
    }

    // Initialize display on page load
    document.addEventListener('DOMContentLoaded', () => {
        // Attach event listener to dropdown
        document.getElementById('itemsPerPage').addEventListener('change', setItemsPerPage);

        // Initialize display based on current page and products per page
        updateUrlAndDisplay();
    });

    function searchFunction() {
    const query = sanitizeInput(document.getElementById('searchItem').value.trim().toLowerCase());
    if (!query) {
        updateDisplay(); // Tampilkan semua produk jika input kosong
        return;
    }

    // Filter produk
    const filteredProducts = allProducts.filter(product => {
        const productName = product.nama_produk ? product.nama_produk.toLowerCase() : '';
        const productColor = product.nama_warna ? product.nama_warna.toLowerCase() : '';
        return productName.includes(query) || productColor.includes(query);
    });

    console.log("Filtered products:", filteredProducts);

    // Tampilkan produk hasil pencarian
    displayProducts(filteredProducts.slice(0, productsPerPage));

    // Update paginasi
    const totalPages = Math.ceil(filteredProducts.length / productsPerPage);
    updatePagination(totalPages);
}

// Sanitasi Input
function sanitizeInput(input) {
    return input.replace(/[<>"'`]/g, ''); // Hapus karakter berbahaya
}

// Event Listener
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('searchItem').addEventListener('input', searchFunction);
    updateDisplay();
});
function updateDisplay() {
    const totalPages = Math.ceil(allProducts.length / productsPerPage);
    const startIndex = (currentPage - 1) * productsPerPage;
    const endIndex = startIndex + productsPerPage;

    // Tampilkan produk berdasarkan halaman saat ini
    displayProducts(allProducts.slice(startIndex, endIndex));

    // Perbarui paginasi
    updatePagination(totalPages);

    // Perbarui URL untuk mencerminkan perubahan
    const url = new URL(window.location.href);
    url.searchParams.set('page', currentPage);
    url.searchParams.set('itemsPerPage', productsPerPage);
    window.history.replaceState(null, '', url);
}

</script>
@endsection