@extends('layouts.app')

@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}" },
    { "@type": "ListItem", "position": 2, "name": "Alat Online", "item": "{{ url('/tools') }}" },
    { "@type": "ListItem", "position": 3, "name": "Invoice Generator Online Gratis", "item": "{{ url()->current() }}" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "Invoice Generator Online Gratis",
  "url": "{{ url('/tools/invoice-generator-online-gratis-pdf') }}",
  "applicationCategory": "BusinessApplication",
  "operatingSystem": "Web",
  "offers": { "@type": "Offer", "price": "0", "priceCurrency": "IDR" },
  "publisher": { "@type": "Organization", "name": "Azolatekno", "url": "https://azolatekno.com" }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    { "@type": "Question", "name": "Apakah Invoice Generator ini benar-benar gratis tanpa watermark?", "acceptedAnswer": { "@type": "Answer", "text": "Ya, 100% gratis dan tanpa watermark. Anda bisa membuat invoice profesional dan langsung mengunduh PDF tanpa biaya, tanpa batasan jumlah invoice, dan tanpa perlu registrasi." } },
    { "@type": "Question", "name": "Apakah saya perlu daftar akun untuk menggunakan invoice maker online ini?", "acceptedAnswer": { "@type": "Answer", "text": "Tidak perlu. Anda dapat langsung mengisi form, menambahkan item, lalu download PDF. Tanpa login, tanpa password, tanpa verifikasi email." } },
    { "@type": "Question", "name": "Apakah data invoice saya aman diproses di website ini?", "acceptedAnswer": { "@type": "Answer", "text": "Sangat aman. Semua data yang Anda isi hanya diproses di sisi server untuk menghasilkan PDF, lalu tidak disimpan di database kami." } },
    { "@type": "Question", "name": "Apakah bisa menambahkan logo perusahaan ke invoice?", "acceptedAnswer": { "@type": "Answer", "text": "Ya. Anda bisa mengunggah logo perusahaan (opsional) pada form di atas. Logo akan otomatis muncul di sudut kiri atas invoice PDF." } },
    { "@type": "Question", "name": "Apakah tersedia pilihan PPN dan DP?", "acceptedAnswer": { "@type": "Answer", "text": "Tersedia. Anda bisa mengatur persentase PPN (default 11%) dan juga bisa mencentang 'Tanpa PPN'. Selain itu, terdapat fitur DP / pembayaran awal yang dapat dikurangkan dari total tagihan." } }
  ]
}
</script>
@endpush

@section('content')

<section class="relative overflow-hidden bg-ink-950 pb-16 pt-32 sm:pb-20 sm:pt-40">
    <div class="pointer-events-none absolute inset-0 bg-brand-gradient opacity-[0.85]"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.07]" style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:26px 26px;"></div>
    <div class="container-app relative">
        <nav class="text-sm text-white/70">
            <a href="{{ url('/') }}" class="hover:text-white">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ url('/tools') }}" class="hover:text-white">Tools</a>
            <span class="mx-2">/</span>
            <span class="text-white">Invoice Generator</span>
        </nav>
        <div class="mx-auto mt-6 max-w-2xl text-center">
            <span class="eyebrow bg-white/10 text-white ring-1 ring-white/25">Gratis, Tanpa Watermark</span>
            <h1 class="mt-5 text-3xl font-semibold text-white sm:text-4xl">Invoice Generator Online Gratis</h1>
            <p class="mx-auto mt-4 max-w-xl text-white/80">Buat invoice profesional dan langsung unduh PDF, tanpa login dan tanpa watermark.</p>
        </div>
    </div>
</section>

<section class="container-app py-16 sm:py-20">
    <div class="reveal card mx-auto max-w-2xl p-8 sm:p-10">
        <h2 class="text-xl">Buat Invoice Online Gratis</h2>
        <form id="invoiceForm" enctype="multipart/form-data" class="mt-6 space-y-5">
            @csrf

            <div>
                <label class="field-label">Upload Logo (opsional)</label>
                <input type="file" name="logo" class="field-input" accept="image/*">
            </div>

            <div>
                <label class="field-label">Dari (Penjual)</label>
                <textarea name="from" class="field-input" rows="3" placeholder="Nama, alamat, kontak penjual" required></textarea>
            </div>

            <div>
                <label class="field-label">Kepada (Pembeli)</label>
                <textarea name="to" class="field-input" rows="3" placeholder="Nama, alamat, kontak pembeli" required></textarea>
            </div>

            <div>
                <label class="field-label">Bank dan Rekening (Opsional)</label>
                <input type="text" name="rekening" class="field-input" placeholder="Misal: Bank BNI 083657782">
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="field-label">No. Invoice</label>
                    <input type="text" name="invoice_no" class="field-input" required>
                </div>
                <div>
                    <label class="field-label">Tanggal</label>
                    <input type="date" name="date" class="field-input" required>
                </div>
            </div>

            <div>
                <label class="field-label">Jatuh Tempo</label>
                <input type="date" name="due_date" class="field-input">
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="field-label">PPN (%)</label>
                    <input type="number" name="ppn" class="field-input" placeholder="11" value="11">
                    <label class="mt-2 flex items-center gap-2 text-sm text-ink-500">
                        <input type="checkbox" name="no_ppn" value="1" class="rounded border-ink-300 text-brand-600 focus:ring-brand-500"> Tanpa PPN
                    </label>
                </div>
                <div>
                    <label class="field-label">DP / Pembayaran Awal</label>
                    <input type="number" name="dp" class="field-input" placeholder="0" value="0">
                </div>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-ink-900">Item Transaksi</h3>
                <div id="items-container" class="mt-3 space-y-3">
                    <div class="flex flex-wrap items-center gap-2 item-row">
                        <input name="items[0][desc]" placeholder="Deskripsi" class="field-input flex-1 min-w-[140px]" required>
                        <input name="items[0][qty]" type="number" placeholder="Qty" class="field-input w-24">
                        <input name="items[0][unit]" placeholder="Satuan" class="field-input w-28">
                        <input name="items[0][unit_price]" type="number" step="0.01" placeholder="Harga/unit" class="field-input w-32" required>
                    </div>
                </div>
                <button type="button" id="add-item" class="btn-outline mt-3 text-sm">+ Tambah Item</button>
            </div>

            <button type="button" id="downloadBtn" class="btn-primary w-full">Download PDF</button>
        </form>
    </div>
</section>

<section class="bg-ink-50/60 py-16 sm:py-20">
    <div class="container-app">
        <div class="reveal mx-auto max-w-2xl text-center">
            <span class="eyebrow">FAQ</span>
            <h2 class="mt-4 text-3xl">Pertanyaan yang Sering Diajukan</h2>
        </div>
        <div class="faq-accordion reveal mx-auto mt-10 max-w-2xl">
            <div class="faq-item">
                <button class="faq-question">Apakah Invoice Generator online ini benar-benar gratis tanpa watermark?</button>
                <div class="faq-answer"><p>Ya, 100% gratis dan tanpa watermark. Anda bisa membuat invoice profesional dan langsung mengunduh PDF tanpa biaya, tanpa batasan jumlah invoice, dan tanpa perlu registrasi.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Apakah saya perlu daftar akun untuk menggunakan invoice maker online ini?</button>
                <div class="faq-answer"><p>Tidak perlu. Anda dapat langsung mengisi form, menambahkan item, lalu download PDF. Tanpa login, tanpa password, tanpa verifikasi email.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Apakah data invoice saya aman diproses di website ini?</button>
                <div class="faq-answer"><p>Sangat aman. Semua data yang Anda isi hanya diproses di sisi server untuk menghasilkan PDF, lalu tidak disimpan di database kami.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Apakah bisa menambahkan logo perusahaan ke invoice?</button>
                <div class="faq-answer"><p>Ya. Anda bisa mengunggah logo perusahaan (opsional) pada form di atas. Logo akan otomatis muncul di sudut kiri atas invoice PDF.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Apakah tersedia pilihan PPN dan diskon?</button>
                <div class="faq-answer"><p>Tersedia. Anda bisa mengatur persentase PPN (default 11%) dan juga bisa mencentang "Tanpa PPN". Selain itu, terdapat fitur DP / pembayaran awal yang dapat dikurangkan dari total tagihan.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Ada berapa banyak item yang bisa ditambahkan?</button>
                <div class="faq-answer"><p>Tanpa batasan. Anda dapat menambah dan menghapus item transaksi sesuai kebutuhan.</p></div>
            </div>
        </div>
    </div>
</section>

<section class="container-app py-16 sm:py-20">
    <article class="reveal prose prose-slate mx-auto max-w-3xl prose-headings:font-display prose-headings:font-medium prose-headings:text-ink-900 prose-a:text-brand-700 prose-strong:text-ink-900">
        <h2>Mengapa Invoice Penting untuk Bisnis Anda?</h2>
        <p>Invoice bukan sekadar bukti transaksi. Dokumen invoice adalah <strong>alat komunikasi resmi</strong> antara Anda dan klien yang menjelaskan detail layanan, jumlah pembayaran, hingga tenggat waktu. Dengan invoice yang rapi, bisnis Anda terlihat lebih profesional dan dipercaya.</p>

        <h3>Perbedaan Invoice dan Struk Belanja</h3>
        <ul>
            <li><strong>Invoice:</strong> Dokumen resmi dari penjual ke pembeli untuk meminta pembayaran. Biasanya digunakan untuk transaksi bisnis (B2B, jasa, proyek). Menampilkan rincian produk/jasa, harga, pajak, dan syarat pembayaran.</li>
            <li><strong>Struk Belanja:</strong> Bukti pembayaran langsung dari kasir. Digunakan sebagai tanda terima pembelian di toko ritel, biasanya tanpa syarat pembayaran atau detail bisnis formal.</li>
        </ul>

        <h3>Cara Menggunakan Invoice Generator Azolatekno</h3>
        <ol>
            <li>Isi data penjual (nama, alamat, kontak).</li>
            <li>Isi data pembeli (klien Anda).</li>
            <li>Upload logo (opsional) agar invoice terlihat lebih profesional.</li>
            <li>Tentukan nomor invoice &amp; tanggal.</li>
            <li>Isi item transaksi: deskripsi, kuantitas, satuan, harga per unit.</li>
            <li>Atur PPN dan DP jika ada.</li>
            <li>Klik <strong>Download PDF</strong>, file akan otomatis terunduh.</li>
        </ol>

        <h3>Butuh Sistem Invoice Otomatis + Manajemen Keuangan?</h3>
        <p>Invoice Generator ini cocok untuk kebutuhan sederhana dan instan. Jika bisnis Anda sudah berkembang dan butuh invoice berulang, pengiriman otomatis via email, atau integrasi payment gateway, <strong>Azolatekno</strong> siap membantu membangun sistem manajemen invoice &amp; keuangan custom sesuai kebutuhan bisnis Anda. Lihat juga <a href="{{ url('/layanan/layanan-integrasi-ai') }}">layanan integrasi AI</a> kami untuk otomatisasi proses bisnis.</p>
    </article>

    <div class="reveal mt-8 text-center">
        <a href="{{ url('/contact-us') }}" class="btn-primary">Konsultasi Gratis dengan Tim Azolatekno</a>
    </div>
</section>

@endsection

@push('scripts-bottom')
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

document.querySelectorAll(".faq-question").forEach(btn=>{
  btn.addEventListener("click",()=>{
    btn.classList.toggle("active");
    let answer=btn.nextElementSibling;
    answer.style.display=answer.style.display==="block"?"none":"block";
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const container = document.getElementById('items-container');
  const addBtn = document.getElementById('add-item');
  if (!container || !addBtn) return;

  let i = container.querySelectorAll('.item-row').length;

  addBtn.addEventListener('click', () => {
    const row = document.createElement('div');
    row.className = 'flex flex-wrap items-center gap-2 item-row';
    row.innerHTML = `
      <input name="items[${i}][desc]" placeholder="Deskripsi" class="field-input flex-1 min-w-[140px]" required>
      <input name="items[${i}][qty]" type="number" min="1" placeholder="Qty" class="field-input w-24" required>
      <input name="items[${i}][unit]" placeholder="Satuan" class="field-input w-28" required>
      <input name="items[${i}][unit_price]" type="number" step="0.01" placeholder="Harga/unit" class="field-input w-32" required>
      <button type="button" class="remove-item flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-50 text-red-500 hover:bg-red-100" title="Hapus item">&times;</button>
    `;
    container.appendChild(row);
    i++;
  });

  container.addEventListener('click', function (e) {
    if (e.target && e.target.matches('.remove-item')) {
      const row = e.target.closest('.item-row');
      if (!row) return;
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
@endpush
