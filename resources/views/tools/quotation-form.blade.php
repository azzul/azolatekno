@extends('layouts.app')

@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}" },
    { "@type": "ListItem", "position": 2, "name": "Alat Online", "item": "{{ url('/tools') }}" },
    { "@type": "ListItem", "position": 3, "name": "Quotation Generator Online Gratis", "item": "{{ url()->current() }}" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "Quotation Generator Online Gratis",
  "url": "{{ url('/tools/quotation-penawaran-harga-online-gratis') }}",
  "applicationCategory": "BusinessApplication",
  "operatingSystem": "Any",
  "description": "Buat penawaran harga profesional dalam bentuk PDF secara gratis. Cocok untuk UMKM, startup, hingga perusahaan besar.",
  "offers": { "@type": "Offer", "price": "0", "priceCurrency": "IDR", "category": "Free" },
  "publisher": {
    "@type": "Organization",
    "name": "Azolatekno",
    "url": "{{ url('/') }}",
    "logo": { "@type": "ImageObject", "url": "https://azolatekno.com/img/azolatekno-square.webp" }
  }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    { "@type": "Question", "name": "Apa itu Quotation Penawaran Harga Online?", "acceptedAnswer": { "@type": "Answer", "text": "Quotation Penawaran Harga Online adalah tool gratis untuk membuat penawaran harga instan yang bisa diunduh dalam format PDF." } },
    { "@type": "Question", "name": "Apakah saya harus daftar akun untuk membuat quotation?", "acceptedAnswer": { "@type": "Answer", "text": "Tidak. Anda bisa langsung membuat quotation tanpa login atau registrasi." } },
    { "@type": "Question", "name": "Apakah hasil quotation atau penawaran harga bisa diunduh dalam bentuk PDF?", "acceptedAnswer": { "@type": "Answer", "text": "Ya, hasil penawaran harga dapat diunduh dalam format PDF dan langsung dibagikan ke klien." } },
    { "@type": "Question", "name": "Apakah quotation ini bisa digunakan untuk kebutuhan bisnis resmi?", "acceptedAnswer": { "@type": "Answer", "text": "Tentu. Template quotation yang dihasilkan cocok digunakan oleh UMKM, freelancer, maupun perusahaan." } }
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
            <span class="text-white">Quotation Generator</span>
        </nav>
        <div class="mx-auto mt-6 max-w-2xl text-center">
            <span class="eyebrow bg-white/10 text-white ring-1 ring-white/25">Gratis, Tanpa Login</span>
            <h1 class="mt-5 text-3xl font-semibold text-white sm:text-4xl">Quotation / Penawaran Harga Generator Online</h1>
            <p class="mx-auto mt-4 max-w-xl text-white/80">Buat penawaran harga profesional dalam bentuk PDF secara gratis. Cocok untuk UMKM, startup, hingga perusahaan besar.</p>
        </div>
    </div>
</section>

<section class="container-app py-16 sm:py-20">
    <div class="reveal card mx-auto max-w-2xl p-8 sm:p-10">
        <form action="{{ route('quotation.generate') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label class="field-label">Logo Perusahaan (opsional)</label>
                <input type="file" name="logo" class="field-input" accept="image/png,image/jpeg,image/jpg,image/webp">
                <p class="mt-1 text-xs text-ink-400">Format: JPG, PNG, atau WEBP. Maks 2MB.</p>
            </div>
            <div>
                <label class="field-label">Dari (Perusahaan Anda)</label>
                <textarea name="from" class="field-input" rows="3" required></textarea>
            </div>
            <div>
                <label class="field-label">Kepada (Client)</label>
                <textarea name="to" class="field-input" rows="3" required></textarea>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="field-label">No. Quotation</label>
                    <input type="text" name="quotation_no" class="field-input" required>
                </div>
                <div>
                    <label class="field-label">Tanggal</label>
                    <input type="date" name="date" class="field-input" required>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-ink-900">Item Penawaran</h3>
                <div id="items-wrapper" class="mt-3 space-y-3">
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                        <input type="text" name="items[0][desc]" placeholder="Deskripsi" class="field-input col-span-2 sm:col-span-1" required>
                        <input type="number" name="items[0][qty]" placeholder="Qty" class="field-input">
                        <input type="text" name="items[0][unit]" placeholder="Satuan" class="field-input">
                        <input type="number" name="items[0][unit_price]" placeholder="Harga/Unit" class="field-input" required>
                    </div>
                </div>
                <button type="button" class="btn-outline mt-3 text-sm" onclick="addItem()">+ Tambah Item</button>
            </div>

            <div>
                <label class="field-label">PPN (%)</label>
                <input type="number" name="ppn_rate" class="field-input" placeholder="Contoh: 11. Isi 0 jika tanpa PPN">
            </div>

            <button type="submit" class="btn-primary w-full">Generate PDF</button>
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
    </div>
</section>

<section class="container-app py-16 sm:py-20">
    <article class="reveal prose prose-slate mx-auto max-w-3xl prose-headings:font-display prose-headings:font-medium prose-headings:text-ink-900 prose-a:text-brand-700 prose-strong:text-ink-900">
        <h2>Apa Itu Quotation atau Penawaran Harga?</h2>
        <p>Quotation atau penawaran harga adalah dokumen resmi yang dibuat oleh perusahaan atau penyedia jasa untuk memberikan estimasi biaya kepada calon pelanggan. Dokumen ini biasanya mencakup detail produk atau jasa, jumlah, harga satuan, total harga, serta syarat dan ketentuan.</p>

        <h3>Mengapa Quotation Penting untuk Bisnis?</h3>
        <ul>
            <li><strong>Transparansi:</strong> Menunjukkan rincian biaya secara jelas kepada calon pelanggan.</li>
            <li><strong>Profesional:</strong> Memberikan citra perusahaan yang lebih terpercaya di mata klien.</li>
            <li><strong>Efisiensi:</strong> Mempercepat proses negosiasi karena sudah ada dasar harga yang tertulis.</li>
            <li><strong>Legalitas:</strong> Dapat dijadikan dasar kesepakatan sebelum pembuatan kontrak.</li>
        </ul>

        <h3>Ciri-Ciri Quotation yang Baik</h3>
        <ol>
            <li>Mencantumkan identitas perusahaan dengan jelas (nama, alamat, dan logo bila ada).</li>
            <li>Memuat detail item barang/jasa yang ditawarkan, termasuk deskripsi, kuantitas, dan harga.</li>
            <li>Memberikan informasi tambahan seperti pajak (PPN), diskon, dan total harga akhir.</li>
            <li>Mudah dipahami oleh klien tanpa istilah yang membingungkan.</li>
            <li>Menggunakan format profesional agar terlihat rapi dan resmi.</li>
        </ol>

        <h3>Layanan Terkait untuk Mendukung Bisnis Anda</h3>
        <p>Selain menggunakan Quotation Generator, Anda juga bisa mengoptimalkan bisnis dengan layanan digital dari Azolatekno:</p>
        <ul>
            <li><a href="{{ url('/layanan/paket-web-hosting-seo') }}">Paket Web Hosting + SEO</a> untuk website cepat, aman, dan mudah ditemukan di Google.</li>
            <li><a href="{{ url('/layanan/jasa-pembuatan-website') }}">Jasa Pembuatan Website</a> profesional untuk UMKM, startup, maupun perusahaan besar.</li>
            <li><a href="{{ url('/layanan/jasa-seo-google-ai') }}">Jasa SEO Google &amp; AI</a> agar website Anda tampil di halaman pertama pencarian.</li>
            <li><a href="{{ url('/layanan/layanan-integrasi-ai') }}">Layanan Integrasi AI</a> agar bisnis Anda semakin efisien dengan otomatisasi modern.</li>
        </ul>
    </article>

    <div class="reveal mt-8 text-center">
        <a href="{{ url('/contact-us') }}" class="btn-primary">Konsultasi Gratis dengan Tim Azolatekno</a>
    </div>
</section>

@endsection

@push('scripts-bottom')
<script>
document.querySelectorAll(".faq-question").forEach(btn=>{
  btn.addEventListener("click",()=>{
    btn.classList.toggle("active");
    let answer=btn.nextElementSibling;
    answer.style.display=answer.style.display==="block"?"none":"block";
  });
});

let itemIndex = 1;
function addItem() {
    const wrapper = document.getElementById('items-wrapper');
    const row = document.createElement('div');
    row.className = 'grid grid-cols-2 gap-3 sm:grid-cols-4';
    row.innerHTML = `
        <input type="text" name="items[${itemIndex}][desc]" placeholder="Deskripsi" class="field-input col-span-2 sm:col-span-1" required>
        <input type="number" name="items[${itemIndex}][qty]" placeholder="Qty" class="field-input">
        <input type="text" name="items[${itemIndex}][unit]" placeholder="Satuan" class="field-input">
        <input type="number" name="items[${itemIndex}][unit_price]" placeholder="Harga/Unit" class="field-input" required>
    `;
    wrapper.appendChild(row);
    itemIndex++;
}
</script>
@endpush
