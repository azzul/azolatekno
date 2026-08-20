@extends('layouts.app-tools')
@push('preload')
<link rel="preload" as="image" href="{{ asset('img/tools/hpp-kalkulator.jpg') }}">
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
      "name": "Kalkulator HPP Online Gratis"
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
      "name": "Apa itu HPP Kalkulator Online?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "HPP Kalkulator Online adalah alat gratis untuk menghitung Harga Pokok Produksi secara instan, membantu UMKM dan bisnis dalam menentukan harga jual produk yang tepat."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah HPP Kalkulator Online ini gratis digunakan?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Ya, kalkulator ini bisa digunakan secara gratis tanpa perlu registrasi atau instalasi software tambahan."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah data perhitungan HPP saya tersimpan di server?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Tidak. Semua data hanya digunakan saat perhitungan dan tidak disimpan di server, sehingga keamanan terjamin."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah saya bisa mengunduh hasil perhitungan HPP?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Ya, Anda bisa menyalin atau mencetak hasil perhitungan untuk kebutuhan laporan bisnis."
      }
    }
  ]
}
</script>
@endpush
@section('content')
<section id="tools">
  <div class="custom-container pt-90">
    <div class="section-header">
      <h1>Kalkulator HPP (Harga Pokok Produksi) UMKM</h1>
    </div>
    <img style="width:100%;aspect-ratio: 480 / 280; margin: 25px 0px;" src="{{asset('/img/tools/hpp-kalkulator.jpg')}}" fetchpriority="high" decoding="async"
                    loading="eager" alt="Invoice Generator Online">
      <div class="card-tools">
           <h2 class="title-tools">Hitung HPP Online</h2>
        <form method="POST" action="{{ route('hpp.calculate') }}">
          @csrf

          <div class="form-group">
            <label class="label-tools">Pilih Jenis Usaha</label>
            <select name="business_type" id="business-type" class="input-tools" required>
              <option value="">-- Pilih Jenis Usaha --</option>
              <option value="kuliner">Kuliner (Makanan/Minuman)</option>
              <option value="fashion">Fashion (Pakaian/Aksesoris)</option>
              <option value="jasa">Jasa (Salon, Laundry, Rental, dll)</option>
              <option value="ritel">Ritel/Dagang</option>
              <option value="kerajinan">Kerajinan/Handmade</option>
              <option value="pabrik">Produsen / Pabrik</option>
            </select>
          </div>

          <h3 class="title-tools" style="margin-top:25px; font-size:20px; padding:0;">Biaya Produksi</h3>

          <div id="costs-container">
            <div class="row-tools item-row">
              <input name="costs[0][desc]" placeholder="Nama Biaya (contoh: Bahan Baku)" class="input-tools" required>
              <input name="costs[0][amount]" type="number" step="0.01" placeholder="Nominal (Rp)" class="input-tools" required>
            </div>
          </div>

          <button type="button" id="add-cost" class="btn-tools secondary-tools mt-2">+ Tambah Biaya</button>

          <!-- Tambahan khusus Pabrik -->
          <div id="pabrik-fields" style="display:none; margin-top:25px;">
            <h3 class="title-tools" style="font-size:20px;">Biaya Tambahan Pabrik</h3>
            <div class="form-group">
              <label class="label-tools">Biaya Penyusutan Mesin (Rp)</label>
              <input type="number" name="machine_depreciation" class="input-tools" placeholder="cth: 1000000">
            </div>
            <div class="form-group">
              <label class="label-tools">Biaya Maintenance Mesin (Rp)</label>
              <input type="number" name="machine_maintenance" class="input-tools" placeholder="cth: 500000">
            </div>
            <div class="form-group">
              <label class="label-tools">Biaya Energi (Listrik/Gas/Solar) (Rp)</label>
              <input type="number" name="energy_cost" class="input-tools" placeholder="cth: 750000">
            </div>
          </div>

          <div class="grid-tools cols-2-tools mt-4">
            <div>
              <label class="label-tools">Jumlah Produksi (unit/porsi/jasa)</label>
              <input type="number" name="total_units" class="input-tools" placeholder="cth: 100" required>
            </div>
            <div>
              <label class="label-tools">Target Margin (%)</label>
              <input type="number" name="margin" class="input-tools" placeholder="cth: 30" required>
            </div>
          </div>

          <div class="form-actions mt-6" style="display:flex; gap:12px;">
            <button type="submit" class="btn-tools">Hitung HPP</button>
          </div>
        </form>
       @if(session('hasil'))
          <div class="result-tools mt-6 pt-20">
            <h3 class="title-tools">Hasil Perhitungan</h3>
        
            <table class="tools-table">
              <thead>
                <tr>
                  <th>Komponen Biaya</th>
                  <th>Nominal (Rp)</th>
                </tr>
              </thead>
              <tbody>
                @foreach(session('hasil')['breakdown'] as $row)
                  <tr>
                    <td data-label="Komponen Biaya">{{ $row['desc'] }}</td>
                    <td data-label="Nominal (Rp)">Rp {{ number_format($row['amount'], 0, ',', '.') }}</td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th data-label="Total Biaya Produksi">Total Biaya Produksi</th>
                  <th data-label="Nominal (Rp)">Rp {{ number_format(session('hasil')['total_produksi'], 0, ',', '.') }}</th>
                </tr>
                <tr>
                  <th data-label="HPP per Unit">HPP per Unit ({{ session('hasil')['total_units'] }} unit)</th>
                  <th data-label="Nominal (Rp)">Rp {{ number_format(session('hasil')['hpp_per_unit'], 0, ',', '.') }}</th>
                </tr>
                <tr>
                  <th data-label="Harga Jual">Harga Jual (Margin {{ session('hasil')['margin'] }}%)</th>
                  <th data-label="Nominal (Rp)">Rp {{ number_format(session('hasil')['harga_jual'], 0, ',', '.') }}</th>
                </tr>
              </tfoot>
            </table>
          </div>
        @endif
      </div>
  </div>
</section>
</section>
<section class="faq">
    <div class="custom-container">
  <h2>Pertanyaan yang Sering Diajukan (FAQ)</h2>
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
</section>
<section id="about-tools">
<div class="education-section mt-8">
  <div class="custom-container">
    <div class="section-header">
      <h2>Mengapa HPP Penting untuk Bisnis?</h2>
    </div>
    <p>HPP adalah total biaya yang dikeluarkan sebuah usaha untuk menghasilkan atau mendapatkan barang/jasa yang kemudian dijual kembali kepada konsumen.</p>
    <p>HPP (Harga Pokok Produksi) bukan sekadar angka biaya. HPP merupakan <strong>fondasi keuangan bisnis</strong> yang menentukan seberapa sehat margin keuntungan Anda. Dengan mengetahui HPP secara akurat, Anda bisa menetapkan harga jual yang tepat, menjaga cash flow, dan bersaing secara sehat di pasar.</p>
    <p>Banyak UMKM dan pelaku usaha sering menentukan harga berdasarkan perkiraan. Padahal tanpa hitungan HPP, risiko kerugian bisa lebih besar. Itulah sebabnya menghitung HPP dengan rapi adalah <em>kunci agar bisnis tetap bertumbuh</em>.</p>
    
    <h3>Perbedaan HPP dan Harga Jual</h3>
    <ul>
      <li><strong>HPP (Harga Pokok Produksi):</strong> Total biaya yang dikeluarkan untuk memproduksi barang/jasa, meliputi bahan baku, tenaga kerja, biaya overhead, hingga distribusi.</li>
      <li><strong>Harga Jual:</strong> Harga yang dibayarkan konsumen, dihitung dari HPP ditambah margin keuntungan sesuai target bisnis.</li>
    </ul>

    <h3>Cara Menggunakan Kalkulator HPP AzolaTekno</h3>
    <ul>
      <li>Pilih jenis usaha: kuliner, fashion, jasa, ritel, kerajinan, atau pabrik/produsen</li>
      <li>Masukkan seluruh komponen biaya produksi (bahan baku, tenaga kerja, listrik, sewa, dll.)</li>
      <li>Isi jumlah produksi agar HPP bisa dihitung per unit</li>
      <li>Tentukan target margin (%) untuk mendapatkan rekomendasi harga jual</li>
      <li>Klik <strong>Hitung HPP</strong> untuk melihat hasil perhitungan secara otomatis</li>
    </ul>

    <h3>Manfaat Menggunakan Kalkulator HPP</h3>
    <p>Dengan tool gratis ini, Anda bisa:</p>
    <ul>
      <li>Menentukan harga jual produk/jasa dengan tepat</li>
      <li>Menghindari kerugian karena salah perhitungan biaya</li>
      <li>Membuat laporan biaya produksi yang lebih transparan</li>
      <li>Membantu mengatur strategi bisnis berbasis data</li>
    </ul>

    <h3>Butuh Sistem HPP Otomatis?</h3>
    <p>Kalkulator ini cocok untuk kebutuhan sederhana. Namun, jika bisnis Anda semakin berkembang, tentu akan lebih efisien bila menggunakan <strong>sistem manajemen produksi & keuangan otomatis</strong>. AzolaTekno dapat membantu UMKM, startup, maupun pabrik untuk membangun <strong>website + sistem perhitungan HPP</strong> yang terintegrasi dengan stok barang, pembelian bahan baku, hingga laporan keuntungan otomatis.</p>
   
    <p>Bayangkan, semua biaya produksi tercatat otomatis, harga jual langsung terhitung, dan laporan keuntungan tersedia kapan saja. Tim Anda bisa lebih fokus pada pengembangan bisnis, sementara administrasi berjalan sendiri.</p>
    
    <a href="{{ url('/contact-us') }}" class="btn-tools-secondary">Konsultasi Gratis dengan Tim AzolaTekno</a>
  </div>
</div>

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
document.getElementById('add-cost').addEventListener('click', function() {
  let container = document.getElementById('costs-container');
  let index = container.querySelectorAll('.item-row').length;
  let row = document.createElement('div');
  row.className = 'row-tools item-row';
  row.innerHTML = `
    <input name="costs[${index}][desc]" placeholder="Nama Biaya" class="input-tools" required>
    <input name="costs[${index}][amount]" type="number" step="0.01" placeholder="Nominal (Rp)" class="input-tools" required>
  `;
  container.appendChild(row);
});

// toggle field khusus pabrik
document.getElementById('business-type').addEventListener('change', function() {
  if (this.value === 'pabrik') {
    document.getElementById('pabrik-fields').style.display = 'block';
  } else {
    document.getElementById('pabrik-fields').style.display = 'none';
  }
});
</script>

@endsection
