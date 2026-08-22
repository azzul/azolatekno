@extends('layouts.app')

@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}" },
    { "@type": "ListItem", "position": 2, "name": "Alat Online", "item": "{{ url('/tools') }}" },
    { "@type": "ListItem", "position": 3, "name": "Kalkulator HPP Online Gratis", "item": "{{ url()->current() }}" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "Kalkulator HPP Online Gratis",
  "url": "{{ url('/tools/hpp-calculator-online') }}",
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
    { "@type": "Question", "name": "Apa itu HPP Kalkulator Online?", "acceptedAnswer": { "@type": "Answer", "text": "HPP Kalkulator Online adalah alat gratis untuk menghitung Harga Pokok Produksi secara instan, membantu UMKM dan bisnis dalam menentukan harga jual produk yang tepat." } },
    { "@type": "Question", "name": "Apakah HPP Kalkulator Online ini gratis digunakan?", "acceptedAnswer": { "@type": "Answer", "text": "Ya, kalkulator ini bisa digunakan secara gratis tanpa perlu registrasi atau instalasi software tambahan." } },
    { "@type": "Question", "name": "Apakah data perhitungan HPP saya tersimpan di server?", "acceptedAnswer": { "@type": "Answer", "text": "Tidak. Semua data hanya digunakan saat perhitungan dan tidak disimpan di server, sehingga keamanan terjamin." } },
    { "@type": "Question", "name": "Apakah saya bisa mengunduh hasil perhitungan HPP?", "acceptedAnswer": { "@type": "Answer", "text": "Ya, Anda bisa menyalin atau mencetak hasil perhitungan untuk kebutuhan laporan bisnis." } }
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
            <span class="text-white">Kalkulator HPP</span>
        </nav>
        <div class="mx-auto mt-6 max-w-2xl text-center">
            <span class="eyebrow bg-white/10 text-white ring-1 ring-white/25">Gratis, Tanpa Login</span>
            <h1 class="mt-5 text-3xl font-semibold text-white sm:text-4xl">Kalkulator HPP (Harga Pokok Produksi) UMKM</h1>
            <p class="mx-auto mt-4 max-w-xl text-white/80">Hitung Harga Pokok Produksi bisnis Anda secara instan, langsung dapat rekomendasi harga jual.</p>
        </div>
    </div>
</section>

<section class="container-app py-16 sm:py-20">
    <div class="reveal card mx-auto max-w-2xl p-8 sm:p-10">
        <h2 class="text-xl">Hitung HPP Online</h2>
        <form method="POST" action="{{ route('hpp.calculate') }}" class="mt-6 space-y-5">
            @csrf

            <div>
                <label class="field-label">Pilih Jenis Usaha</label>
                <select name="business_type" id="business-type" class="field-input" required>
                    <option value="">-- Pilih Jenis Usaha --</option>
                    <option value="kuliner">Kuliner (Makanan/Minuman)</option>
                    <option value="fashion">Fashion (Pakaian/Aksesoris)</option>
                    <option value="jasa">Jasa (Salon, Laundry, Rental, dll)</option>
                    <option value="ritel">Ritel/Dagang</option>
                    <option value="kerajinan">Kerajinan/Handmade</option>
                    <option value="pabrik">Produsen / Pabrik</option>
                </select>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-ink-900">Biaya Produksi</h3>
                <div id="costs-container" class="mt-3 space-y-3">
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 item-row">
                        <input name="costs[0][desc]" placeholder="Nama Biaya (contoh: Bahan Baku)" class="field-input" required>
                        <input name="costs[0][amount]" type="number" step="0.01" placeholder="Nominal (Rp)" class="field-input" required>
                    </div>
                </div>
                <button type="button" id="add-cost" class="btn-outline mt-3 text-sm">+ Tambah Biaya</button>
            </div>

            <div id="pabrik-fields" class="hidden space-y-4 rounded-2xl bg-ink-50 p-5">
                <h3 class="text-sm font-semibold text-ink-900">Biaya Tambahan Pabrik</h3>
                <div>
                    <label class="field-label">Biaya Penyusutan Mesin (Rp)</label>
                    <input type="number" name="machine_depreciation" class="field-input" placeholder="cth: 1000000">
                </div>
                <div>
                    <label class="field-label">Biaya Maintenance Mesin (Rp)</label>
                    <input type="number" name="machine_maintenance" class="field-input" placeholder="cth: 500000">
                </div>
                <div>
                    <label class="field-label">Biaya Energi (Listrik/Gas/Solar) (Rp)</label>
                    <input type="number" name="energy_cost" class="field-input" placeholder="cth: 750000">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="field-label">Jumlah Produksi (unit/porsi/jasa)</label>
                    <input type="number" name="total_units" class="field-input" placeholder="cth: 100" required>
                </div>
                <div>
                    <label class="field-label">Target Margin (%)</label>
                    <input type="number" name="margin" class="field-input" placeholder="cth: 30" required>
                </div>
            </div>

            <button type="submit" class="btn-primary w-full">Hitung HPP</button>
        </form>

        @if (session('hasil'))
            <div class="mt-8 border-t border-ink-100 pt-6">
                <h3 class="text-lg">Hasil Perhitungan</h3>
                <div class="mt-4 overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="text-xs font-semibold uppercase tracking-wider text-ink-400">
                                <th class="py-2">Komponen Biaya</th>
                                <th class="py-2 text-right">Nominal (Rp)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-ink-100">
                            @foreach (session('hasil')['breakdown'] as $row)
                                <tr>
                                    <td class="py-2 text-ink-600">{{ $row['desc'] }}</td>
                                    <td class="py-2 text-right text-ink-600">Rp {{ number_format($row['amount'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="divide-y divide-ink-100 border-t border-ink-200 font-semibold text-ink-900">
                            <tr>
                                <th class="py-2 text-left">Total Biaya Produksi</th>
                                <th class="py-2 text-right">Rp {{ number_format(session('hasil')['total_produksi'], 0, ',', '.') }}</th>
                            </tr>
                            <tr>
                                <th class="py-2 text-left">HPP per Unit ({{ session('hasil')['total_units'] }} unit)</th>
                                <th class="py-2 text-right">Rp {{ number_format(session('hasil')['hpp_per_unit'], 0, ',', '.') }}</th>
                            </tr>
                            <tr>
                                <th class="py-2 text-left text-brand-700">Harga Jual (Margin {{ session('hasil')['margin'] }}%)</th>
                                <th class="py-2 text-right text-brand-700">Rp {{ number_format(session('hasil')['harga_jual'], 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @endif
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
                <button class="faq-question">Apa itu HPP Kalkulator Online?</button>
                <div class="faq-answer"><p>HPP Kalkulator Online adalah alat gratis untuk menghitung Harga Pokok Produksi secara instan, membantu UMKM dan bisnis dalam menentukan harga jual produk yang tepat.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Apakah HPP Kalkulator Online ini gratis digunakan?</button>
                <div class="faq-answer"><p>Ya, kalkulator ini bisa digunakan secara gratis tanpa perlu registrasi atau instalasi software tambahan.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Apakah data perhitungan HPP saya tersimpan di server?</button>
                <div class="faq-answer"><p>Tidak. Semua data hanya digunakan saat perhitungan dan tidak disimpan di server, sehingga keamanan terjamin.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Apakah saya bisa mengunduh hasil perhitungan HPP?</button>
                <div class="faq-answer"><p>Ya, Anda bisa menyalin atau mencetak hasil perhitungan untuk kebutuhan laporan bisnis.</p></div>
            </div>
        </div>
    </div>
</section>

<section class="container-app py-16 sm:py-20">
    <article class="reveal prose prose-slate mx-auto max-w-3xl prose-headings:font-display prose-headings:font-medium prose-headings:text-ink-900 prose-a:text-brand-700 prose-strong:text-ink-900">
        <h2>Mengapa HPP Penting untuk Bisnis?</h2>
        <p>HPP adalah total biaya yang dikeluarkan sebuah usaha untuk menghasilkan atau mendapatkan barang/jasa yang kemudian dijual kembali kepada konsumen.</p>
        <p>HPP (Harga Pokok Produksi) bukan sekadar angka biaya. HPP merupakan <strong>fondasi keuangan bisnis</strong> yang menentukan seberapa sehat margin keuntungan Anda. Dengan mengetahui HPP secara akurat, Anda bisa menetapkan harga jual yang tepat, menjaga cash flow, dan bersaing secara sehat di pasar.</p>
        <p>Banyak UMKM dan pelaku usaha sering menentukan harga berdasarkan perkiraan. Padahal tanpa hitungan HPP, risiko kerugian bisa lebih besar. Itulah sebabnya menghitung HPP dengan rapi adalah <em>kunci agar bisnis tetap bertumbuh</em>.</p>

        <h3>Perbedaan HPP dan Harga Jual</h3>
        <ul>
            <li><strong>HPP (Harga Pokok Produksi):</strong> Total biaya yang dikeluarkan untuk memproduksi barang/jasa, meliputi bahan baku, tenaga kerja, biaya overhead, hingga distribusi.</li>
            <li><strong>Harga Jual:</strong> Harga yang dibayarkan konsumen, dihitung dari HPP ditambah margin keuntungan sesuai target bisnis.</li>
        </ul>

        <h3>Cara Menggunakan Kalkulator HPP Azolatekno</h3>
        <ul>
            <li>Pilih jenis usaha: kuliner, fashion, jasa, ritel, kerajinan, atau pabrik/produsen</li>
            <li>Masukkan seluruh komponen biaya produksi (bahan baku, tenaga kerja, listrik, sewa, dll.)</li>
            <li>Isi jumlah produksi agar HPP bisa dihitung per unit</li>
            <li>Tentukan target margin (%) untuk mendapatkan rekomendasi harga jual</li>
            <li>Klik <strong>Hitung HPP</strong> untuk melihat hasil perhitungan secara otomatis</li>
        </ul>

        <h3>Manfaat Menggunakan Kalkulator HPP</h3>
        <ul>
            <li>Menentukan harga jual produk/jasa dengan tepat</li>
            <li>Menghindari kerugian karena salah perhitungan biaya</li>
            <li>Membuat laporan biaya produksi yang lebih transparan</li>
            <li>Membantu mengatur strategi bisnis berbasis data</li>
        </ul>

        <h3>Butuh Sistem HPP Otomatis?</h3>
        <p>Kalkulator ini cocok untuk kebutuhan sederhana. Namun, jika bisnis Anda semakin berkembang, tentu akan lebih efisien bila menggunakan <strong>sistem manajemen produksi &amp; keuangan otomatis</strong>. Azolatekno dapat membantu UMKM, startup, maupun pabrik untuk membangun <strong>website + sistem perhitungan HPP</strong> yang terintegrasi dengan stok barang, pembelian bahan baku, hingga laporan keuntungan otomatis.</p>
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

document.getElementById('add-cost').addEventListener('click', function() {
  let container = document.getElementById('costs-container');
  let index = container.querySelectorAll('.item-row').length;
  let row = document.createElement('div');
  row.className = 'grid grid-cols-1 gap-3 sm:grid-cols-2 item-row';
  row.innerHTML = `
    <input name="costs[${index}][desc]" placeholder="Nama Biaya" class="field-input" required>
    <input name="costs[${index}][amount]" type="number" step="0.01" placeholder="Nominal (Rp)" class="field-input" required>
  `;
  container.appendChild(row);
});

document.getElementById('business-type').addEventListener('change', function() {
  const pabrikFields = document.getElementById('pabrik-fields');
  pabrikFields.classList.toggle('hidden', this.value !== 'pabrik');
});
</script>
@endpush
