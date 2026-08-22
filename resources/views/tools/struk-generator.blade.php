@extends('layouts.app')

@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}" },
    { "@type": "ListItem", "position": 2, "name": "Alat Online", "item": "{{ url('/tools') }}" },
    { "@type": "ListItem", "position": 3, "name": "Struk Online Generator", "item": "{{ url()->current() }}" }
  ]
}
</script>
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
  "publisher": { "@type": "Organization", "name": "Azolatekno", "url": "https://azolatekno.com" }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    { "@type": "Question", "name": "Apa itu Struk Online Generator?", "acceptedAnswer": { "@type": "Answer", "text": "Struk Online Generator adalah tool gratis dari Azolatekno untuk membuat dan mencetak struk penjualan secara online dalam ukuran 58mm atau 80mm tanpa perlu software tambahan." } },
    { "@type": "Question", "name": "Apakah saya bisa mencetak langsung ke printer Bluetooth?", "acceptedAnswer": { "@type": "Answer", "text": "Ya. Jika printer Bluetooth Anda sudah dipasangkan ke perangkat, Anda dapat langsung mencetak struk dari browser menggunakan fitur print di web." } },
    { "@type": "Question", "name": "Apakah bisa memilih ukuran kertas?", "acceptedAnswer": { "@type": "Answer", "text": "Tentu. Tool ini mendukung dua ukuran populer untuk printer thermal yaitu 58mm dan 80mm, dan Anda bisa memilih sesuai kebutuhan saat mencetak atau mengunduh PDF." } },
    { "@type": "Question", "name": "Apakah perlu login untuk menggunakan tool ini?", "acceptedAnswer": { "@type": "Answer", "text": "Tidak perlu. Anda bisa langsung membuat dan mencetak struk tanpa login atau registrasi, sepenuhnya gratis." } },
    { "@type": "Question", "name": "Apakah hasil struk bisa diunduh dalam format PDF?", "acceptedAnswer": { "@type": "Answer", "text": "Ya, setiap struk yang Anda buat bisa diunduh dalam format PDF untuk disimpan atau dikirim ke pelanggan Anda." } }
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
            <span class="text-white">Struk Online Generator</span>
        </nav>
        <div class="mx-auto mt-6 max-w-2xl text-center">
            <span class="eyebrow bg-white/10 text-white ring-1 ring-white/25">Gratis, Tanpa Login</span>
            <h1 class="mt-5 text-3xl font-semibold text-white sm:text-4xl">Struk Online Generator</h1>
            <p class="mx-auto mt-4 max-w-xl text-white/80">Buat dan cetak struk transaksi 58mm atau 80mm secara online. Cocok untuk kasir toko, UMKM, atau bisnis rumahan.</p>
        </div>
    </div>
</section>

<section class="container-app py-16 sm:py-20">
    <div class="reveal card mx-auto max-w-2xl p-8 sm:p-10">
        <form id="strukForm" action="{{ route('struk.pdf') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="field-label">Nama Toko</label>
                <input type="text" name="store_name" class="field-input" required>
            </div>

            <div>
                <label class="field-label">Alamat Toko</label>
                <textarea name="store_address" class="field-input" rows="2" required></textarea>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-ink-900">Daftar Item</h3>
                <div id="items-wrapper" class="mt-3 space-y-3">
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                        <div>
                            <label class="field-label text-xs">Nama Barang</label>
                            <input type="text" name="items[0][name]" class="field-input" placeholder="Nama Barang" required>
                        </div>
                        <div>
                            <label class="field-label text-xs">Qty</label>
                            <input type="number" name="items[0][qty]" class="field-input" placeholder="Qty" required>
                        </div>
                        <div>
                            <label class="field-label text-xs">Harga</label>
                            <input type="number" name="items[0][price]" class="field-input" placeholder="Harga" required>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-outline mt-3 text-sm" onclick="addItem()">+ Tambah Item</button>
            </div>

            <div>
                <label class="flex items-center gap-2 text-sm font-medium text-ink-700">
                    <input type="checkbox" id="use_ppn_checkbox" class="rounded border-ink-300 text-brand-600 focus:ring-brand-500"> Tambahkan PPN
                </label>
                <input type="hidden" name="use_ppn" id="use_ppn_hidden" value="0">
            </div>

            <div id="ppn_field" class="hidden">
                <label class="field-label" for="ppn_value">Persentase PPN (%)</label>
                <input type="number" id="ppn_value" name="ppn_value" class="field-input" value="11" min="0" step="0.1">
            </div>

            <div>
                <label class="field-label">Ukuran Kertas</label>
                <select name="paper_size" class="field-input">
                    <option value="58">58mm (Printer kecil)</option>
                    <option value="80">80mm (Printer besar)</option>
                </select>
            </div>

            <div class="flex gap-3">
                <button type="button" class="btn-primary flex-1" onclick="downloadPDF(event)">Download PDF</button>
                <button type="button" class="btn-outline flex-1" onclick="printRawbt(event)">Print via Bluetooth</button>
            </div>
        </form>

        <p class="mt-6 text-center text-xs text-ink-400">
            Coba tools bisnis gratis lain: <a href="{{ url('/tools/invoice-generator-online-gratis-pdf') }}" class="font-medium text-brand-700">Invoice Generator</a>,
            <a href="{{ url('/tools/quotation-penawaran-harga-online-gratis') }}" class="font-medium text-brand-700">Generator Penawaran Harga</a>, dan
            <a href="{{ url('/tools/hpp-calculator-online') }}" class="font-medium text-brand-700">Kalkulator HPP</a>.
        </p>
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
                <button class="faq-question">Apa itu Struk Online Generator?</button>
                <div class="faq-answer"><p>Struk Online Generator adalah tool gratis dari Azolatekno untuk membuat dan mencetak struk penjualan secara online dalam ukuran 58mm atau 80mm tanpa perlu software tambahan.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Apakah saya bisa mencetak langsung ke printer Bluetooth?</button>
                <div class="faq-answer"><p>Ya. Jika printer Bluetooth Anda sudah dipasangkan ke perangkat, Anda dapat langsung mencetak struk dari browser menggunakan fitur print di web.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Apakah bisa memilih ukuran kertas?</button>
                <div class="faq-answer"><p>Tentu. Tool ini mendukung dua ukuran populer untuk printer thermal yaitu 58mm dan 80mm, dan Anda bisa memilih sesuai kebutuhan saat mencetak atau mengunduh PDF.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Apakah perlu login untuk menggunakan tool ini?</button>
                <div class="faq-answer"><p>Tidak perlu. Anda bisa langsung membuat dan mencetak struk tanpa login atau registrasi, sepenuhnya gratis.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Apakah hasil struk bisa diunduh dalam format PDF?</button>
                <div class="faq-answer"><p>Ya, setiap struk yang Anda buat bisa diunduh dalam format PDF untuk disimpan atau dikirim ke pelanggan Anda.</p></div>
            </div>
        </div>
    </div>
</section>

<section class="container-app py-16 sm:py-20">
    <div class="reveal mx-auto max-w-2xl text-center">
        <span class="eyebrow">Layanan Kami</span>
        <h2 class="mt-4 text-3xl">Butuh Sistem Kasir atau Website Bisnis?</h2>
        <p class="mt-4 text-ink-500">Struk online ini cocok untuk kebutuhan instan. Untuk sistem kasir terintegrasi atau website bisnis, Azolatekno siap membantu.</p>
    </div>
    <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($products as $product)
            <a href="{{ url('/layanan/' . $product->slug_produk) }}" class="reveal card group flex flex-col overflow-hidden">
                <div class="aspect-[16/10] w-full overflow-hidden bg-ink-100">
                    <x-product-image :product="$product" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                </div>
                <div class="p-6">
                    <h3 class="text-lg">{{ $product->nama_produk }}</h3>
                    <p class="mt-2 line-clamp-2 text-sm text-ink-500">{{ trim(preg_replace('/\s+/', ' ', strip_tags($product->spesifikasi))) }}</p>
                    @php $hargaMin = $product->harga->min('harga'); @endphp
                    @if ($hargaMin)
                        <p class="mt-3 text-sm font-semibold text-brand-700">Mulai Rp{{ number_format($hargaMin, 0, ',', '.') }}</p>
                    @endif
                </div>
            </a>
        @endforeach
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

document.addEventListener("DOMContentLoaded", function() {
  const checkbox = document.getElementById('use_ppn_checkbox');
  const hiddenInput = document.getElementById('use_ppn_hidden');
  const ppnField = document.getElementById('ppn_field');

  checkbox.addEventListener('change', function() {
    const checked = this.checked;
    hiddenInput.value = checked ? 1 : 0;
    ppnField.classList.toggle('hidden', !checked);
  });
});

function addItem() {
  const wrapper = document.getElementById('items-wrapper');
  const index = wrapper.children.length;
  const row = document.createElement('div');
  row.className = 'grid grid-cols-1 gap-3 sm:grid-cols-3';
  row.innerHTML = `
    <input type="text" name="items[${index}][name]" class="field-input" placeholder="Nama Barang" required>
    <input type="number" name="items[${index}][qty]" class="field-input" placeholder="Qty" required>
    <input type="number" name="items[${index}][price]" class="field-input" placeholder="Harga" required>
  `;
  wrapper.appendChild(row);
}

function downloadPDF(event) {
  event.preventDefault();
  const form = document.getElementById('strukForm');
  form.removeAttribute('target');
  form.action = "{{ route('struk.pdf') }}";
  form.submit();
}

function printRawbt() {
  const form = document.getElementById('strukForm');
  form.action = "{{ route('struk.print') }}";
  form.target = "_self";
  form.submit();
}
</script>
@endpush
