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
        preloadImage('{{ asset("img/pricelist-rental-mobile.webp") }}');
    } else {
        preloadImage('{{ asset("img/pricelist-rental.webp") }}');
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
            <h1>DAFTAR HARGA SEWA MOBIL PT HAFES MEGAH LESTARI</h1>
            <p>Rental Dengan Harga Terjangkau, Layanan Prima – Hafes Rent Car</p>
        </div>
         <picture>
            <!-- Source untuk layar kecil -->
            <source media="(max-width: 768px)" srcset="{{ asset('img/pricelist-rental-mobile.webp') }}">
            
            <!-- Source default (untuk desktop) -->
            <source media="(min-width: 769px)" srcset="{{ asset('img/pricelist-rental.webp') }}">

            <!-- Fallback untuk browser yang tidak support <picture> -->
            <img src="{{ asset('img/pricelist-rental.webp') }}" class="image-page" alt="Daftar Harga Rental Mobil Jakarta" loading="lazy">
        </picture>
        <div class="action-buttons">
                         <a href="javascript:void(0);" id="downloadPdf" class="add-to-cart">
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
                                        <td>{{ $price->jenisHarga->jenis_harga ?? '-' }}</td>
                                        <td>
                                            <a href="{{url('/armada/$price->produk->slug_produk')}}" class="btn btn-sm btn-primary">Detail</a>
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
<div id="popupDiskon" class="popup-diskon">
  <div class="popup-content-diskon">
    <h2>🎉 Selamat!</h2>
    <p>Anda adalah salah satu orang beruntung yang mendapatkan <strong>diskon 25%</strong> untuk sewa mobil hari ini!</p>
    <p>Jangan lewatkan kesempatan langka ini.</p>
    <a href="{{$whatsappChat}}" target="_blank" class="popup-btn-diskon"><i class="fab fa-whatsapp pr-10"> </i>Hubungi Admin Sekarang</a>
    <span class="close-popup-diskon" onclick="document.getElementById('popupDiskon').style.display='none'">×</span>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const downloadBtn = document.getElementById("downloadPdf");

    if (downloadBtn) {
        downloadBtn.addEventListener("click", function () {
            const pricelistTable = document.getElementById("pricelist-table");
            const breadcumb = document.getElementById("breadcrumb-section-about");
            if (breadcumb) breadcumb.style.display = "none";
            // Sembunyikan action-buttons sebelum download
            const actionButtons = document.querySelector(".action-buttons");
            if (actionButtons) actionButtons.style.display = "none";

            // Konversi ke PDF dengan pengaturan pagebreak
            html2pdf()
                .set({
                    margin: 3,
                    filename: 'pricelist_sewa_mobil.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
                    pagebreak: { mode: ['avoid-all', 'css', 'legacy'] } // Hindari pemotongan elemen
                })
                .from(pricelistTable)
                .save()
                .then(() => {
                    // Tampilkan kembali action-buttons setelah selesai
                    if (actionButtons) actionButtons.style.display = "flex";
                    if (breadcumb) breadcumb.style.display = "block";
                });
        });
    }
});
</script>
@endsection