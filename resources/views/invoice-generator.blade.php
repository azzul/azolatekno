@extends('layouts.app-tools')
@push('preload')
<link rel="preload" as="image" href="{{ asset('img/tools/invoice-generator.jpg') }}">
@endpush
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
      "name": "Alat Online",
      "item": "{{ url('/tools') }}"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "Invoice Generator Online Gratis"
    }
  ]
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
      "name": "Apakah Invoice Generator ini benar-benar gratis?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Ya, 100% gratis. Anda dapat membuat invoice tanpa biaya dan langsung mengunduhnya dalam format PDF."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah saya perlu mendaftar akun untuk membuat invoice?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Tidak perlu. Anda bisa langsung mengisi form dan download invoice tanpa login atau registrasi."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah invoice bisa diunduh dalam format selain PDF?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Saat ini format utama adalah PDF, namun bisa dicetak langsung dari browser."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah data invoice saya aman?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Ya, semua data diproses di sisi browser/server dengan aman. Kami tidak menyimpan data invoice Anda."
      }
    },
    {
      "@type": "Question",
      "name": "Bisakah invoice digunakan untuk kebutuhan bisnis resmi?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Tentu, template invoice yang dihasilkan cocok digunakan UMKM, freelancer, maupun startup."
      }
    }
  ]
}
</script>
@endpush
@push('preload')
<style>
    /* Tombol Umum */
.btn-tools {
    background: #011e33;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 40px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.btn-tools:hover {
    background: #023b60;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
}

.btn-tools.secondary-tools {
    background: #f5f5f5;
    color: #011e33;
    border: 1px solid #ccc;
}

.btn-tools.secondary-tools:hover {
    background: #e0e0e0;
}

/* Tombol tambah item (sekarang masih <button type="button" id="add-item" class="btn-tools secondary-tools mt-2">) */
#add-item {
    background: #28a745;
    color: white;
    border: none;
    margin-top: 16px;
}

#add-item:hover {
    background: #218838;
}

/* Tombol remove item dalam setiap baris */
.remove-item {
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: 0.2s;
    margin-left: 8px;
}

.remove-item:hover {
    background: #c82333;
    transform: scale(1.05);
}

/* Layout row item biar rapi */
.row-tools {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 16px;
    align-items: center;
}

.row-tools .input-tools {
    flex: 1;
    min-width: 120px;
}

/* Untuk layar kecil */
@media (max-width: 768px) {
    .row-tools {
        flex-direction: column;
    }
    .remove-item {
        align-self: flex-end;
    }
}

/* Tombol download utama */
#downloadBtn {
    background: #011e33;
    font-size: 1.1rem;
    padding: 14px 28px;
}
</style>
@endpush
@section('content')
<section id="tools">
     <div class="custom-container pt-90">
        <div class="section-header">
          <h1>Invoice Generator Online Gratis</h1>
        </div>
        <!--<x-responsive-img -->
        <!--    src="{{asset('/img/tools/invoice-generator.jpg')}}"-->
        <!--    alt="Invoice Generator Online Gratis"-->
        <!--    loading="eager"-->
        <!--    class="hero-img"-->
        <!--/>-->
<img style="width:100%;aspect-ratio: 480 / 280; margin: 25px 0px;" src="{{asset('/img/tools/invoice-generator.jpg')}}" fetchpriority="high" decoding="async"
                    loading="eager" alt="Invoice Generator Online Gratis">
  <div class="tools-wrapper">
  <div class="card-tools">
    <h2 class="title-tools">Buat Invoice Online Gratis</h2>
    <form id="invoiceForm" enctype="multipart/form-data">
  @csrf
      
      <div class="form-group">
        <label class="label-tools">Upload Logo (opsional)</label>
        <input type="file" name="logo" class="input-tools" accept="image/*">
      </div>

      <div class="form-group">
        <label class="label-tools">Dari (Penjual)</label>
        <textarea name="from" class="input-tools textarea-tools" placeholder="Nama, alamat, kontak penjual" required></textarea>
      </div>

      <div class="form-group">
        <label class="label-tools">Kepada (Pembeli)</label>
        <textarea name="to" class="input-tools textarea-tools" placeholder="Nama, alamat, kontak pembeli" required></textarea>
      </div>
        <div class="form-group">
        <label class="label-tools">Bank dan Rekening (Opsional)</label>
        <input type="text" name="rekening" class="input-tools" placeholder="Misal. Bank BNI 083657782" required>
      </div>
      <div class="grid-tools cols-2-tools">
        <div>
          <label class="label-tools">No. Invoice</label>
          <input type="text" name="invoice_no" class="input-tools" required>
        </div>
        <div>
          <label class="label-tools">Tanggal</label>
          <input type="date" name="date" class="input-tools" required>
        </div>
      </div>

      <div class="form-group">
        <label class="label-tools">Jatuh Tempo</label>
        <input type="date" name="due_date" class="input-tools">
      </div>
      
    <div class="form-group">
      <label class="label-tools">PPN (%)</label>
      <input type="number" name="ppn" class="input-tools" placeholder="11" value="11">
      <label>
        <input type="checkbox" name="no_ppn" value="1"> Tanpa PPN
      </label>
    </div>
    <div class="form-group">
      <label class="label-tools">DP / Pembayaran Awal</label>
      <input type="number" name="dp" class="input-tools" placeholder="0" value="0">
    </div>
    
      <h3 class="title-tools" style="margin-top:30px; font-size:20px;">📦 Item Transaksi</h3>
      <div id="items-container">
          <div class="row-tools item-row">
            <input name="items[0][desc]" placeholder="Deskripsi" class="input-tools" required>
            <input name="items[0][qty]" type="number" placeholder="Qty" class="input-tools" required>
            <input name="items[0][unit]" placeholder="Satuan (pcs, box, jam)" class="input-tools" required>
            <input name="items[0][unit_price]" type="number" step="0.01" placeholder="Harga/unit" class="input-tools" required>
            
          </div>
        </div>
        
        <button type="button" id="add-item" class="btn-tools secondary-tools mt-2">+ Tambah Item</button> 
      

      <div class="form-actions mt-6" style="display:flex; gap:12px;">
        <!--<button type="submit" name="preview" value="1" class="btn-tools secondary-tools" >Preview</button>-->
        <button type="button" id="downloadBtn" class="btn-tools">⬇️ Download PDF</button>
      </div>
    </form>
  </div>
</div>
</div>
</section>
<section class="faq">
    <div class="custom-container">
        <h2>Pertanyaan yang Sering Diajukan (FAQ) – Invoice Generator Online Gratis</h2>
        <div class="faq-item">
            <button class="faq-question">Apakah Invoice Generator online ini benar-benar gratis tanpa watermark?</button>
            <div class="faq-answer">
                <p>Ya, 100% gratis dan <strong>tanpa watermark</strong>. Anda bisa membuat invoice profesional dan langsung mengunduh PDF tanpa biaya, tanpa batasan jumlah invoice, dan tanpa perlu registrasi.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Apakah saya perlu daftar akun untuk menggunakan invoice maker online ini?</button>
            <div class="faq-answer">
                <p>Tidak perlu. Anda dapat langsung mengisi form, menambahkan item, lalu download PDF. Tanpa login, tanpa password, tanpa verifikasi email. Cepat dan mudah!</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Bisakah saya mendownload invoice dalam format selain PDF?</button>
            <div class="faq-answer">
                <p>Saat ini tool kami menghasilkan invoice dalam format PDF yang universal. Namun Anda juga bisa mencetak langsung dari browser (Ctrl+P) untuk menyimpan sebagai fisik atau file lain.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Apakah data invoice saya aman diproses di website ini?</button>
            <div class="faq-answer">
                <p>Sangat aman. Semua data yang Anda isi hanya diproses di sisi server untuk menghasilkan PDF, lalu <strong>tidak disimpan</strong> di database kami. Privasi Anda adalah prioritas utama.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Apakah invoice dari generator ini bisa digunakan untuk keperluan bisnis resmi?</button>
            <div class="faq-answer">
                <p>Tentu. Template invoice kami dirancang profesional, memuat kolom lengkap (penjual, pembeli, deskripsi item, harga, PPN, diskon, total, dan rekening bank). Cocok untuk UMKM, freelancer, toko online, hingga perusahaan.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Apakah bisa menambahkan logo perusahaan ke invoice?</button>
            <div class="faq-answer">
                <p>Ya. Anda bisa mengunggah logo perusahaan (opsional) pada form di atas. Logo akan otomatis muncul di sudut kiri atas invoice PDF.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Apakah tersedia pilihan PPN dan diskon?</button>
            <div class="faq-answer">
                <p>Tersedia. Anda bisa mengatur persentase PPN (default 11%) dan juga bisa mencentang "Tanpa PPN". Selain itu, terdapat fitur DP / pembayaran awal yang dapat dikurangkan dari total tagihan.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Apakah invoice generator ini bisa digunakan di HP (mobile)?</button>
            <div class="faq-answer">
                <p>Sangat bisa. Halaman kami responsif dan mendukung semua perangkat (desktop, tablet, HP). Anda dapat membuat invoice langsung dari smartphone dengan mudah.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Ada berapa banyak item yang bisa ditambahkan?</button>
            <div class="faq-answer">
                <p>Tanpa batasan. Anda dapat menambah dan menghapus item transaksi sesuai kebutuhan. Setiap item meliputi deskripsi, qty, satuan, dan harga per unit.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Apakah ada limit jumlah invoice yang bisa dibuat per hari?</button>
            <div class="faq-answer">
                <p>Hingga saat ini tidak ada limit. Anda bebas membuat invoice sebanyak yang Anda butuhkan, kapan saja. Gratis terus-menerus.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Apakah invoice generator ini mendukung mata uang Rupiah (IDR)?</button>
            <div class="faq-answer">
                <p>Ya, invoice otomatis menggunakan format Rupiah (Rp) dan berlaku untuk transaksi di Indonesia. Namun Anda juga bisa menggunakannya untuk mata uang lain dengan menuliskan simbolnya secara manual pada deskripsi.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Apakah ada rencana untuk menambah fitur invoice recurring atau otomatis?</button>
            <div class="faq-answer">
                <p>Untuk kebutuhan invoice berulang atau otomatis dengan manajemen pelanggan, kami merekomendasikan menggunakan layanan <a href="{{ url('/layanan/layanan-integrasi-ai') }}">sistem invoice otomatis dari AzolaTekno</a>. Silakan konsultasikan kebutuhan Anda.</p>
            </div>
        </div>
    </div>
</section>
<section id="about-tools">
<div class="education-section mt-8">
    <div class="custom-container">
        <div class="section-header">
            <h2>Mengapa Invoice Penting untuk Bisnis Anda?</h2>
        </div>
        <p>Invoice bukan sekadar bukti transaksi. Dokumen invoice adalah <strong>alat komunikasi resmi</strong> antara Anda dan klien yang menjelaskan detail layanan, jumlah pembayaran, hingga tenggat waktu. Dengan invoice yang rapi, bisnis Anda terlihat lebih profesional dan dipercaya.</p>
        <p>Selain itu, invoice juga membantu menjaga <em>cash flow</em>. Anda dapat mengetahui kapan pembayaran masuk, mana yang sudah lunas, dan mana yang masih tertunda. Hal ini sangat krusial agar bisnis tetap sehat dan berkembang.</p>

        <h2>Keunggulan Invoice Generator Online dari AzolaTekno</h2>
        <ul>
            <li>✅ <strong>100% Gratis Selamanya</strong> – Tidak ada biaya tersembunyi, tidak perlu berlangganan.</li>
            <li>✅ <strong>Tanpa Registrasi</strong> – Langsung pakai, tanpa login atau verifikasi email.</li>
            <li>✅ <strong>Tanpa Watermark</strong> – Hasil invoice bersih dan profesional.</li>
            <li>✅ <strong>Download PDF Instan</strong> – Klik tombol, file siap dikirim ke klien.</li>
            <li>✅ <strong>Upload Logo Perusahaan</strong> – Branding bisnis Anda pada setiap invoice.</li>
            <li>✅ <strong>Mendukung PPN & DP</strong> – Fleksibel untuk kebutuhan pajak dan pembayaran awal.</li>
            <li>✅ <strong>Responsif di Semua Perangkat</strong> – Bekerja di HP, tablet, dan komputer.</li>
        </ul>

        <h2>Perbedaan Invoice dan Struk Belanja (Yang Wajib Anda Tahu)</h2>
        <ul>
            <li><strong>Invoice:</strong> Dokumen resmi dari penjual ke pembeli untuk <strong>meminta pembayaran</strong>. Biasanya digunakan untuk transaksi bisnis (B2B, jasa, proyek). Menampilkan rincian produk/jasa, harga, pajak, dan syarat pembayaran.</li>
            <li><strong>Struk Belanja:</strong> Bukti pembayaran langsung dari kasir/mesin kasir. Digunakan sebagai tanda terima pembelian di toko ritel dan biasanya tidak menyertakan syarat pembayaran atau detail bisnis secara formal.</li>
        </ul>
        <p>Jadi, jika bisnis Anda sering menerima pembayaran termin atau memberikan layanan proyek, <strong>wajib menggunakan invoice</strong> untuk profesionalitas dan kejelasan administrasi.</p>

        <h2>Perbandingan Invoice Generator AzolaTekno vs Tools Lain</h2>
        <table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse:collapse; margin:20px 0;">
            <thead>
                <tr><th>Fitur</th><th>AzolaTekno</th><th>Kompetitor A (Global)</th><th>Kompetitor B (Lokal)</th></tr>
            </thead>
            <tbody>
                <tr><td>Gratis tanpa watermark</td><td>✅ Ya</td><td>❌ Berbayar atau watermark</td><td>✅ Ya (terbatas)</td></tr>
                <tr><td>Tanpa registrasi</td><td>✅ Ya</td><td>❌ Wajib login</td><td>❌ Wajib login</td></tr>
                <tr><td>Upload logo</td><td>✅ Ya</td><td>✅ Ya (berbayar)</td><td>✅ Ya</td></tr>
                <tr><td>PPN & DP</td><td>✅ Ya</td><td>✅ Ya (beberapa)</td><td>❌ Tidak</td></tr>
                <tr><td>Download PDF langsung</td><td>✅ Ya</td><td>✅ Ya</td><td>✅ Ya</td></tr>
                <tr><td>Tanpa batasan jumlah invoice</td><td>✅ Ya</td><td>❌ Terbatas (gratis versi trial)</td><td>✅ Ya (iklan)</td></tr>
            </tbody>
        </table>
        <p>Dari tabel di atas, jelas bahwa <strong>Invoice Generator AzolaTekno</strong> menawarkan keseimbangan terbaik antara kemudahan, fitur lengkap, dan tanpa biaya. Ideal untuk pelaku usaha di Indonesia.</p>

        <h2>Tips Memilih Invoice Maker Online yang Tepat untuk Bisnis Anda</h2>
        <ul>
            <li>Pastikan <strong>gratis tanpa watermark</strong> agar citra bisnis tetap profesional.</li>
            <li>Pilih yang <strong>tidak memerlukan registrasi</strong> – lebih cepat dan aman.</li>
            <li>Perhatikan apakah mendukung <strong>PPN (11%)</strong>, karena banyak transaksi di Indonesia wajib pajak.</li>
            <li>Cek apakah bisa <strong>upload logo</strong> untuk branding konsisten.</li>
            <li>Pastikan hasil invoice dapat diunduh dalam format <strong>PDF</strong> yang rapi.</li>
        </ul>

        <h2>Testimoni Pengguna Invoice Generator AzolaTekno</h2>
        <blockquote style="border-left: 4px solid #011e33; margin: 20px 0; padding: 10px 20px; background: #f9f9f9;">
            <p>"Saya pakai invoice generator ini untuk usaha catering di Solo. Sangat mudah, gratis, dan hasilnya profesional. Klien saya suka karena ada logo perusahaan. Terima kasih AzolaTekno!"</p>
            <footer>- Bpk. Ahmad, Owner Catering Solo</footer>
        </blockquote>
        <blockquote style="border-left: 4px solid #011e33; margin: 20px 0; padding: 10px 20px; background: #f9f9f9;">
            <p>"Sebagai freelancer desain grafis, saya sering butuh invoice cepat. Tool ini paling enak karena tanpa daftar dan langsung download PDF. Rekomendasi banget!"</p>
            <footer>- Sari, Freelancer Desain</footer>
        </blockquote>

        <h2>Cara Menggunakan Invoice Generator AzolaTekno (Langkah Mudah)</h2>
        <ol>
            <li><strong>Isi data penjual</strong> (nama, alamat, kontak) – wajib diisi.</li>
            <li><strong>Isi data pembeli</strong> (klien Anda) – wajib diisi.</li>
            <li><strong>Upload logo</strong> (opsional) agar invoice terlihat lebih profesional.</li>
            <li><strong>Tentukan nomor invoice & tanggal</strong> – sistem akan otomatis mengurutkan jika Anda konsisten.</li>
            <li><strong>Isi item transaksi</strong>: deskripsi, kuantitas, satuan, harga per unit. Klik <strong>"+ Tambah Item"</strong> jika perlu.</li>
            <li><strong>Atur PPN dan DP</strong> (jika ada). Centang "Tanpa PPN" jika tidak dikenakan pajak.</li>
            <li><strong>Klik tombol "Download PDF"</strong> – file akan otomatis terunduh.</li>
            <li><strong>Kirim invoice ke klien</strong> melalui email, WhatsApp, atau platform lain.</li>
        </ol>

        <h2>Manfaat Menggunakan Invoice Generator Online untuk UMKM & Freelancer</h2>
        <ul>
            <li><strong>Menghemat waktu</strong> – Tidak perlu membuat dari nol di Excel atau Word.</li>
            <li><strong>Meminimalisir kesalahan hitung</strong> – Total otomatis, PPN dan DP otomatis.</li>
            <li><strong>Meningkatkan profesionalisme</strong> – Invoice rapi meningkatkan kepercayaan klien.</li>
            <li><strong>Mempermudah rekonsiliasi keuangan</strong> – Semua invoice tersimpan di perangkat Anda (bisa diarsipkan sendiri).</li>
        </ul>

        <h2>Butuh Sistem Invoice Otomatis + Manajemen Keuangan?</h2>
        <p>Invoice Generator ini cocok untuk kebutuhan sederhana dan instan. Namun, jika bisnis Anda sudah berkembang, memiliki banyak klien, dan butuh fitur seperti:</p>
        <ul>
            <li>Membuat invoice berulang (recurring invoice)</li>
            <li>Pengiriman invoice otomatis via email</li>
            <li>Laporan laba rugi dan arus kas</li>
            <li>Integrasi dengan payment gateway (midtrans, tripay, xendit)</li>
        </ul>
        <p>Maka <strong>AzolaTekno</strong> siap membantu Anda membangun <strong>sistem manajemen invoice & keuangan custom</strong> sesuai kebutuhan bisnis. Kami juga menyediakan layanan:</p>
        <ul>
            <li><a href="{{ url('/layanan/paket-web-hosting-seo') }}" target="_blank">Paket Web Hosting + SEO</a> untuk website cepat, aman, dan mudah ditemukan di Google.</li>
            <li><a href="{{ url('/layanan/jasa-pembuatan-website') }}" target="_blank">Jasa Pembuatan Website</a> profesional sesuai kebutuhan bisnis Anda.</li>
            <li><a href="{{ url('/layanan/jasa-seo-google-ai') }}" target="_blank">Jasa SEO Google & AI</a> untuk optimasi peringkat website secara pintar.</li>
            <li><a href="{{ url('/layanan/course-online-ai') }}" target="_blank">Course Online AI</a> bagi tim atau individu yang ingin belajar implementasi AI dalam bisnis.</li>
            <li><a href="{{ url('/layanan/layanan-integrasi-ai') }}" target="_blank">Layanan Integrasi AI</a> untuk otomatisasi proses bisnis, termasuk invoice, laporan, dan manajemen data.</li>
            <li><a href="{{ url('/layanan/optimasi-google-maps') }}" target="_blank">Optimasi Google Maps</a> agar bisnis Anda lebih mudah ditemukan secara lokal.</li>
        </ul>
        <p>Bayangkan, semua invoice terkirim otomatis, laporan keuangan tersusun rapi, dan tim Anda bisa lebih fokus pada pengembangan bisnis. <strong>Konsultasikan kebutuhan Anda sekarang!</strong></p>

        <a href="{{ url('/contact-us') }}" class="btn-tools-secondary" style="display:inline-block; background:#011e33; color:white; padding:12px 28px; border-radius:40px; text-decoration:none; margin-top:20px;">📞 Konsultasi Gratis dengan Tim AzolaTekno</a>
    </div>
</div>
</section>
<script>
document.getElementById('downloadBtn').addEventListener('click', function(e) {
    e.preventDefault();
    
    let form = document.getElementById('invoiceForm');
    let formData = new FormData(form);
    
    fetch('{{ route("invoice.generate") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.blob())
    .then(blob => {
        let url = window.URL.createObjectURL(blob);
        let a = document.createElement('a');
        a.href = url;
        a.download = 'Invoice-{{ now()->timestamp }}.pdf';
        a.click();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Gagal download: ' + error);
    });
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
<script>
document.addEventListener('DOMContentLoaded', function () {
  const container = document.getElementById('items-container');
  const addBtn = document.getElementById('add-item');

  if (!container) {
    console.warn('items-container not found!');
    return;
  }
  if (!addBtn) {
    console.warn('add-item button not found!');
    return;
  }

  let i = container.querySelectorAll('.item-row').length; // start index based on existing rows

  addBtn.addEventListener('click', () => {
    const row = document.createElement('div');
    row.className = 'row-tools item-row';
    row.innerHTML = `
      <input name="items[${i}][desc]" placeholder="Deskripsi" class="input-tools" required>
      <input name="items[${i}][qty]" type="number" min="1" placeholder="Qty" class="input-tools" required>
      <input name="items[${i}][unit]" placeholder="Satuan (misal: pcs, jam, box)" class="input-tools" required>
      <input name="items[${i}][unit_price]" type="number" step="0.01" placeholder="Harga/unit" class="input-tools" required>
      <button type="button" class="remove-item btn-small" title="Hapus item">×</button>
    `;
    container.appendChild(row);
    i++;
  });

  // Event delegation untuk tombol remove
  container.addEventListener('click', function (e) {
    if (e.target && e.target.matches('.remove-item')) {
      const row = e.target.closest('.item-row');
      if (!row) return;

      // jika hanya 1 row tersisa, kosongkan field jangan hapus
      const rows = container.querySelectorAll('.item-row');
      if (rows.length <= 1) {
        row.querySelectorAll('input').forEach(inp => inp.value = '');
        return;
      }

      row.remove();
    }
  });
});
</script>
@endsection