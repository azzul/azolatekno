@extends('layouts.app-struk')
@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "Struk Online Generator Gratis",
  "url": "{{ url('/tools/struk-online-generator') }}",
  "description": "Buat struk online 58mm atau 80mm untuk bisnis dan UMKM. Bisa download PDF atau print langsung ke printer Bluetooth menggunakan RawBT.",
  "applicationCategory": "BusinessApplication",
  "operatingSystem": "Web",
  "offers": { "@type": "Offer", "price": "0", "priceCurrency": "IDR" },
  "publisher": { "@type": "Organization", "name": "AzolaTekno", "url": "https://azolatekno.com" }
}
</script>
@endpush
@push('preload')
<style>
    /* Untuk HP (max-width: 768px) */
@media (max-width: 768px) {
    #items-wrapper .row {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    #items-wrapper .row .col,
    #items-wrapper .row .col-2,
    #items-wrapper .row .col-3 {
        width: 100% !important;
        flex: 0 0 auto;
    }
}
</style>
@endpush
@section('content')
<div class="custom-container pt-90">
      <h1 class="text-center mb-4">Struk Online Generator</h1>
  <p class="text-muted text-center mb-4">
    Buat dan cetak struk transaksi 58mm atau 80mm secara online. Cocok untuk kasir toko, UMKM, atau bisnis rumahan.
  </p>

  
  <form id="strukForm" action="{{ route('struk.pdf') }}" method="POST" class="mb-4">
      @csrf
    
      <div class="mb-3">
        <label>Nama Toko</label>
        <input type="text" name="store_name" class="form-control" required>
      </div>
    
      <div class="mb-3">
        <label>Alamat Toko</label>
        <textarea name="store_address" class="form-control" required></textarea>
      </div>
    
      <h5 class="mt-4">Daftar Item</h5>
        <div id="items-wrapper" class="mb-3">
            <div class="row row-cols-1 row-cols-sm-3 g-2 mb-2">
                <div class="col">
                    <label class="form-label small">Nama Barang</label>
                    <input type="text" name="items[0][name]" class="form-control" placeholder="Nama Barang" required>
                </div>
                <div class="col">
                    <label class="form-label small">Qty</label>
                    <input type="number" name="items[0][qty]" class="form-control" placeholder="Qty" required>
                </div>
                <div class="col">
                    <label class="form-label small">Harga</label>
                    <input type="number" name="items[0][price]" class="form-control" placeholder="Harga" required>
                </div>
            </div>
        </div>
      <button type="button" class="btn btn-outline-primary btn-sm mb-3" onclick="addItem()">+ Tambah Item</button>
    
      <div class="form-group mt-3">
        <label>
          <input type="checkbox" id="use_ppn_checkbox"> Tambahkan PPN
        </label>
        <input type="hidden" name="use_ppn" id="use_ppn_hidden" value="0">
      </div>
    
      <div class="form-group" id="ppn_field" style="display:none;">
        <label for="ppn_value">Persentase PPN (%)</label>
        <input type="number" id="ppn_value" name="ppn_value" class="form-control" value="11" min="0" step="0.1">
      </div>
    
      <div class="mb-3">
        <label>Ukuran Kertas</label>
        <select name="paper_size" class="form-select">
          <option value="58">58mm (Printer kecil)</option>
          <option value="80">80mm (Printer besar)</option>
        </select>
      </div>
    
      <div class="d-flex gap-2 mb-3">
        <button type="button" class="btn btn-success w-50" onclick="downloadPDF(event)">📄 Download PDF</button>
        <button type="button" class="btn btn-primary w-50" onclick="printRawbt(event)">🖨️ Print via Bluetooth</button>
      </div>
    </form>
    <p>Coba Tools bisnis gratis <strong><a href="https://azolatekno.com/tools/invoice-generator-online-gratis-pdf" target="_blank">Invoice Generator Online Gratis</strong></a> dan <a href="https://azolatekno.com/tools/quotation-penawaran-harga-online-gratis" target="_blank">Generator Penawaran Harga Online</a> serta <a href="https://azolatekno.com/tools/hpp-calculator-online" target="_blank">Kalkulator HPP Online</a></p>
</div>

<section class="faq mt-5 mb-5">
  <div class="custom-container">
    <h2 class="text-center mb-4">Pertanyaan yang Sering Diajukan (FAQ)</h2>

    <div class="faq-item">
      <button class="faq-question">Apa itu Struk Online Generator?</button>
      <div class="faq-answer">
        <p>Struk Online Generator adalah tool gratis dari AzolaTekno untuk membuat dan mencetak struk penjualan secara online dalam ukuran 58mm atau 80mm tanpa perlu software tambahan.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Apakah saya bisa mencetak langsung ke printer Bluetooth?</button>
      <div class="faq-answer">
        <p>Ya. Jika printer Bluetooth Anda sudah dipasangkan ke perangkat, Anda dapat langsung mencetak struk dari browser menggunakan fitur print di web.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Apakah bisa memilih ukuran kertas?</button>
      <div class="faq-answer">
        <p>Tentu. Tool ini mendukung dua ukuran populer untuk printer thermal yaitu 58mm dan 80mm, dan Anda bisa memilih sesuai kebutuhan saat mencetak atau mengunduh PDF.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Apakah perlu login untuk menggunakan tool ini?</button>
      <div class="faq-answer">
        <p>Tidak perlu. Anda bisa langsung membuat dan mencetak struk tanpa login atau registrasi, sepenuhnya gratis.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Apakah hasil struk bisa diunduh dalam format PDF?</button>
      <div class="faq-answer">
        <p>Ya, setiap struk yang Anda buat bisa diunduh dalam format PDF untuk disimpan atau dikirim ke pelanggan Anda.</p>
      </div>
    </div>
  </div>
</section>

<section id="layanan">
    <div class="custom-container">
        <div class="section-header">
            <h2>Pembuatan Web, SEO, AI dan Digital</h2>
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
<div class="custom-container">
<a href="https://member.jagoanhosting.com/aff.php?aff=8060"><img src=https://www.jagoanhosting.com/blog/wp-content/uploads/2023/08/Hosting-Murah-Middle-Post-1.png border="0" loading="lazy"></a>
</div>
<script>
// efek hover ringan (opsional)
document.querySelectorAll('a').forEach(a => {
  a.addEventListener('mouseenter', () => a.style.boxShadow = '0 3px 8px rgba(0,0,0,0.1)');
  a.addEventListener('mouseleave', () => a.style.boxShadow = '');
});
</script>

<script>
document.querySelectorAll(".faq-question").forEach(btn=>{
  btn.addEventListener("click",()=>{
    btn.classList.toggle("active");
    let answer=btn.nextElementSibling;
    answer.style.display=answer.style.display==="block"?"none":"block";
  });
});
</script>
@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Apa itu Struk Online Generator?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Struk Online Generator adalah tool gratis dari AzolaTekno untuk membuat dan mencetak struk penjualan secara online dalam ukuran 58mm atau 80mm tanpa perlu software tambahan."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah saya bisa mencetak langsung ke printer Bluetooth?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Ya. Jika printer Bluetooth Anda sudah dipasangkan ke perangkat, Anda dapat langsung mencetak struk dari browser menggunakan fitur print di web."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah bisa memilih ukuran kertas?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Tentu. Tool ini mendukung dua ukuran populer untuk printer thermal yaitu 58mm dan 80mm, dan Anda bisa memilih sesuai kebutuhan saat mencetak atau mengunduh PDF."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah perlu login untuk menggunakan tool ini?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Tidak perlu. Anda bisa langsung membuat dan mencetak struk tanpa login atau registrasi, sepenuhnya gratis."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah hasil struk bisa diunduh dalam format PDF?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Ya, setiap struk yang Anda buat bisa diunduh dalam format PDF untuk disimpan atau dikirim ke pelanggan Anda."
      }
    }
  ]
}
</script>
@endpush
<script>
document.addEventListener("DOMContentLoaded", function() {
  const checkbox = document.getElementById('use_ppn_checkbox');
  const hiddenInput = document.getElementById('use_ppn_hidden');
  const ppnField = document.getElementById('ppn_field');

  checkbox.addEventListener('change', function() {
    const checked = this.checked;
    hiddenInput.value = checked ? 1 : 0;
    ppnField.style.display = checked ? 'block' : 'none';
  });
});

function addItem() {
  const wrapper = document.getElementById('items-wrapper');
  const index = wrapper.children.length;
  const row = document.createElement('div');
  row.className = 'row g-2 mb-2';
  row.innerHTML = `
    <div class="col"><input type="text" name="items[${index}][name]" class="form-control" placeholder="Nama Barang" required></div>
    <div class="col-2"><input type="number" name="items[${index}][qty]" class="form-control" placeholder="Qty" required></div>
    <div class="col-3"><input type="number" name="items[${index}][price]" class="form-control" placeholder="Harga" required></div>
  `;
  wrapper.appendChild(row);
}

function submitForm(action, target, event) {
  event.preventDefault();
  const form = document.getElementById('strukForm');
  form.action = action;
  form.target = target;
  form.submit();
}

function downloadPDF(event) {
  event.preventDefault();
  const form = document.getElementById('strukForm');
  form.removeAttribute('target'); // hilangkan _blank
  form.action = "{{ route('struk.pdf') }}";
  form.submit();
}

function printRawbt() {
  const form = document.querySelector('form');
  form.action = "{{ route('struk.print') }}";
  form.target = "_self";
  form.submit();
}
</script>
@endsection