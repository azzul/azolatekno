@extends('layouts.app-new-tools')
@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "Quotation Generator Online Gratis",
  "url": "{{ url('/tools/quotation-penawaran-harga-online-gratis') }}",
  "applicationCategory": "BusinessApplication",
  "operatingSystem": "Any",
  "description": "Buat penawaran harga profesional dalam bentuk PDF secara gratis. Cocok untuk UMKM, startup, hingga perusahaan besar.",
  "offers": {
    "@type": "Offer",
    "price": "0",
    "priceCurrency": "IDR",
    "category": "Free"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Fajar Rent Car",
    "url": "{{ url('/') }}",
    "logo": {
      "@type": "ImageObject",
      "url": "https://azolatekno.com/img/azolatekno-square.webp"
    }
  }
}
</script>
@endpush
@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Apa itu Quotation Penawaran Harga Online?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Quotation Penawaran Harga Online adalah tool gratis untuk membuat penawaran harga instan yang bisa diunduh dalam format PDF."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah saya harus daftar akun untuk membuat quotation?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Tidak. Anda bisa langsung membuat quotation tanpa login atau registrasi."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah hasil quotation atau penawaran harga bisa diunduh dalam bentuk PDF?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Ya, hasil penawaran harga dapat diunduh dalam format PDF dan langsung dibagikan ke klien."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah quotation ini bisa digunakan untuk kebutuhan bisnis resmi?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Tentu. Template quotation yang dihasilkan cocok digunakan oleh UMKM, freelancer, maupun perusahaan."
      }
    }
  ]
}
</script>
@endpush
@section('content')
<section id="tools">
<div class="custom-container pt-90">
    <h1 class="mb-4 text-center">Quotation atau Penawaran Harga Generator Online Gratis</h1>
    <p class="text-muted text-center">
        Buat penawaran harga profesional dalam bentuk PDF secara gratis. Cocok untuk UMKM, startup, hingga perusahaan besar.
    </p>

    <form action="{{ route('quotation.generate') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Logo Perusahaan (opsional)</label>
            <input type="file" name="logo" class="form-control" accept="image/png,image/jpeg,image/jpg,image/webp">
            <small class="text-muted">Format: JPG, PNG, atau WEBP. Maks 2MB.</small>
        </div>
        <div class="mb-3">
            <label>Dari (Perusahaan Anda)</label>
            <textarea name="from" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Kepada (Client)</label>
            <textarea name="to" class="form-control" required></textarea>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>No. Quotation</label>
                <input type="text" name="quotation_no" class="form-control" required>
            </div>
            <div class="col">
                <label>Tanggal</label>
                <input type="date" name="date" class="form-control" required>
            </div>
        </div>
        <h4 class="mt-4">Item Penawaran</h4>
        <div id="items-wrapper">
            <div class="row mb-2">
                <div class="col"><input type="text" name="items[0][desc]" placeholder="Deskripsi" class="form-control" required></div>
                <div class="col-2"><input type="number" name="items[0][qty]" placeholder="Qty" class="form-control" required></div>
                <div class="col-2"><input type="text" name="items[0][unit]" placeholder="Satuan" class="form-control"></div>
                <div class="col-3"><input type="number" name="items[0][unit_price]" placeholder="Harga/Unit" class="form-control" required></div>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary mb-3" onclick="addItem()">+ Tambah Item</button>
        <div class="mb-3">
            <label>PPN (%)</label>
            <input type="number" name="ppn_rate" class="form-control" placeholder="Contoh : 11. Isi 0 jika tanpa PPN">
        </div>
        <button type="submit" class="btn btn-success w-100">Generate PDF</button>
    </form>
</div>
</section>

<hr class="my-5">
<section id="seo">
<div class="seo-section">
    <div class="custom-container">
    <h2 class="mb-3">Apa Itu Quotation atau Penawaran Harga?</h2>
    <p>
        Quotation atau penawaran harga adalah dokumen resmi yang dibuat oleh perusahaan atau penyedia jasa untuk memberikan estimasi biaya kepada calon pelanggan. 
        Dokumen ini biasanya mencakup detail produk atau jasa, jumlah, harga satuan, total harga, serta syarat dan ketentuan. 
        Dengan adanya quotation, baik perusahaan maupun klien memiliki acuan tertulis yang jelas sebelum terjadi transaksi.
    </p>

    <h2 class="mt-5 mb-3">Mengapa Quotation Penting untuk Bisnis?</h2>
    <ul>
        <li><strong>Transparansi:</strong> Menunjukkan rincian biaya secara jelas kepada calon pelanggan.</li>
        <li><strong>Profesional:</strong> Memberikan citra perusahaan yang lebih terpercaya di mata klien.</li>
        <li><strong>Efisiensi:</strong> Mempercepat proses negosiasi karena sudah ada dasar harga yang tertulis.</li>
        <li><strong>Legalitas:</strong> Dapat dijadikan dasar kesepakatan sebelum pembuatan kontrak.</li>
    </ul>

    <h2 class="mt-5 mb-3">Ciri-Ciri Quotation yang Baik</h2>
    <p>
        Sebuah penawaran harga yang baik sebaiknya memenuhi beberapa kriteria berikut:
    </p>
    <ol>
        <li>Mencantumkan identitas perusahaan dengan jelas (nama, alamat, dan logo bila ada).</li>
        <li>Memuat detail item barang/jasa yang ditawarkan, termasuk deskripsi, kuantitas, dan harga.</li>
        <li>Memberikan informasi tambahan seperti pajak (PPN), diskon, dan total harga akhir.</li>
        <li>Mudah dipahami oleh klien tanpa istilah yang membingungkan.</li>
        <li>Menggunakan format profesional agar terlihat rapi dan resmi.</li>
    </ol>

    <h2 class="mt-5 mb-3">Contoh Penggunaan Quotation Generator Online</h2>
    <p>
        Dengan menggunakan <strong>Quotation Generator Online Gratis</strong>, Anda bisa membuat penawaran harga untuk berbagai kebutuhan bisnis, seperti:
    </p>
    <ul>
        <li>Quotation untuk jasa sewa mobil perusahaan.</li>
        <li>Quotation untuk penjualan produk retail atau grosir.</li>
        <li>Quotation proyek konstruksi atau kontraktor.</li>
        <li>Quotation untuk jasa kreatif seperti desain grafis atau digital marketing.</li>
    </ul>

    <h2 class="mt-5 mb-3">Tips Membuat Penawaran Harga yang Menarik</h2>
    <p>
        Selain mencantumkan harga, sebuah quotation yang menarik juga bisa menyertakan keunggulan layanan atau nilai tambah dari perusahaan Anda. 
        Misalnya, garansi, after sales service, atau bonus tertentu. Hal ini bisa membuat calon klien lebih yakin untuk memilih penawaran Anda dibandingkan kompetitor.
    </p>

    <h2 class="mt-5 mb-3">Gunakan Quotation Generator untuk Mempermudah Bisnis Anda</h2>
    <p>
        Tidak perlu lagi repot membuat penawaran harga manual menggunakan Excel atau Word. 
        Dengan tool ini, Anda bisa membuat <em>quotation</em> secara otomatis, profesional, dan langsung tersimpan dalam bentuk PDF. 
        Cobalah sekarang juga untuk mempercepat proses bisnis Anda!
    </p>
    </div>
</div>

<div class="related-services mt-5 pt-4 border-top">
    <div class="custom-container">
    <h2 class="mb-3">Layanan Terkait untuk Mendukung Bisnis Anda</h2>
    <p>
        Selain menggunakan <strong>Quotation Generator Online Gratis</strong>, Anda juga bisa mengoptimalkan bisnis dengan layanan digital terbaik dari Azola Tekno, seperti:
    </p>
    <ul>
        <li><a href="https://azolatekno.com/layanan/paket-web-hosting-seo" target="_blank">Paket Web Hosting SEO</a> untuk website cepat, aman, dan mudah ditemukan di Google.</li>
        <li><a href="https://azolatekno.com/layanan/jasa-pembuatan-website" target="_blank">Jasa Pembuatan Website</a> profesional untuk UMKM, startup, maupun perusahaan besar.</li>
        <li><a href="https://azolatekno.com/layanan/jasa-seo-google-ai" target="_blank">Jasa SEO Google AI</a> agar website Anda tampil di halaman pertama pencarian.</li>
        <li><a href="https://azolatekno.com/layanan/course-online-ai" target="_blank">Course Online AI</a> untuk menguasai teknologi kecerdasan buatan yang sedang tren.</li>
        <li><a href="https://azolatekno.com/layanan/layanan-integrasi-ai" target="_blank">Layanan Integrasi AI</a> agar bisnis Anda semakin efisien dengan otomatisasi modern.</li>
        <li><a href="https://azolatekno.com/layanan/optimasi-google-maps" target="_blank">Optimasi Google Maps</a> supaya lokasi bisnis Anda lebih mudah ditemukan pelanggan.</li>
        <li><a href="https://azolatekno.com/jasa-pembuatan-web-solo" target="_blank">Jasa Pembuatan Web Solo</a> khusus untuk pelaku usaha di wilayah Solo dan sekitarnya.</li>
        <li><a href="https://azolatekno.com/jasa-seo-google-solo" target="_blank">Jasa SEO Google Solo</a> untuk membantu bisnis lokal bersaing di pencarian Google.</li>
    </ul>
    <p>
        Semua layanan ini dirancang untuk membantu bisnis Anda tumbuh lebih cepat dan menjangkau lebih banyak pelanggan potensial. 
        Gunakan tool gratis kami bersama layanan digital profesional agar usaha Anda semakin unggul.
    </p>
    </div>
</div>
</section>
<hr class="my-5">
<section class="faq">
    <div class="custom-container">
  <h2>Pertanyaan yang Sering Diajukan (FAQ)</h2>
  <div class="faq-item">
    <button class="faq-question">Apa itu Quotation Penawaran Harga Online?</button>
    <div class="faq-answer"><p>Quotation Penawaran Harga Online adalah tool gratis untuk membuat penawaran harga instan yang bisa diunduh dalam format PDF.</p></div>
  </div>
  <div class="faq-item">
    <button class="faq-question">Apakah saya harus daftar akun untuk membuat quotation?</button>
    <div class="faq-answer"><p>Tidak. Anda bisa langsung membuat quotation tanpa login atau registrasi.</p></div>
  </div>
  <div class="faq-item">
    <button class="faq-question">Apakah hasil quotation bisa diunduh dalam bentuk PDF?</button>
    <div class="faq-answer"><p>Ya, hasil penawaran harga dapat diunduh dalam format PDF dan langsung dibagikan ke klien.</p></div>
  </div>
  <div class="faq-item">
    <button class="faq-question">Apakah quotation ini bisa digunakan untuk kebutuhan bisnis resmi?</button>
    <div class="faq-answer"><p>Tentu. Template quotation yang dihasilkan cocok digunakan oleh UMKM, freelancer, maupun perusahaan.</p></div>
  </div>
  </div>
</section>
<script>
document.querySelectorAll(".faq-question").forEach(btn=>{
  btn.addEventListener("click",()=>{
    btn.classList.toggle("active");
    let answer=btn.nextElementSibling;
    answer.style.display=answer.style.display==="block"?"none":"block";
  });
});
</script>
<script>
let itemIndex = 1;
function addItem() {
    const wrapper = document.getElementById('items-wrapper');
    const row = document.createElement('div');
    row.className = 'row mb-2';
    row.innerHTML = `
        <div class="col"><input type="text" name="items[${itemIndex}][desc]" placeholder="Deskripsi" class="form-control" required></div>
        <div class="col-2"><input type="number" name="items[${itemIndex}][qty]" placeholder="Qty" class="form-control" required></div>
        <div class="col-2"><input type="text" name="items[${itemIndex}][unit]" placeholder="Satuan" class="form-control"></div>
        <div class="col-3"><input type="number" name="items[${itemIndex}][unit_price]" placeholder="Harga/Unit" class="form-control" required></div>
    `;
    wrapper.appendChild(row);
    itemIndex++;
}
</script>
@endsection