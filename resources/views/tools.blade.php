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
      "name": "Tools Bisnis Gratis",
      "item": "{{ url('/tools') }}"
    }
  ]
}
</script>
@endpush

@section('content')
    <section id="breadcrumb-section-about" >
        <div class="custom-container">
            <div class="breadcrumb-text">
                 <a href="{{ url('/') }}">Beranda</a> / 
                <span class="W-500">Tools Online Gratis Untuk Bisnis dan UMKM</span>
            </div>
        </div>
    </section>
    
<section id="tools">
    <div class="custom-container">
        <div class="section-header">
            <h1>Kumpulan Tools Online Gratis Untuk Bisnis dan UMKM</h1>
            <p>Nikmati tools gratis untuk bisnis dan UMKM tanpa harus ribet mendaftar, tanpa harus klik iklan. Disini gratis dan tanpa iklan!</p>
        </div>
        <div class="product-grid">
                <div class="card-product">
                    <a href="{{ url('/tools/invoice-generator-online-gratis-pdf') }}">
                        
                        <div class="product-content">
                            <p class="product-content-tittle">Invoice Generator Online Gratis</p>
                            <p>pada halaman ini, anda bisa membuat invoice secara online, gratis dan tanpa harus mendaftar. Anda juga bisa mengupload logo anda dengan header usaha anda tanpa syarat langganan apapun.</p>
                            <p>Selain itu, anda juga bisa mengekspornya dalam bentuk pdf yang bisa anda kirim langsung ke pelanggan anda. Coba Sekarang Juga, gratis!</p>
                        </div>
                    </a>
                </div>
                <div class="card-product">
                  <a href="{{ url('/tools/hpp-calculator-online') }}">
                    <div class="product-content">
                      <p class="product-content-tittle">Kalkulator HPP Online Gratis</p>
                      <p>Pada halaman ini, Anda bisa menghitung <strong>Harga Pokok Produksi (HPP)</strong> secara otomatis untuk berbagai jenis usaha seperti kuliner, jasa, ritel, kerajinan, hingga produsen/pabrik.</p>
                      <p>Cukup masukkan biaya produksi, jumlah unit, dan target margin, maka sistem akan menghitung <em>HPP per unit</em> sekaligus memberikan rekomendasi harga jual. Cocok untuk UMKM dan bisnis yang ingin lebih akurat menentukan harga. Gratis dan mudah digunakan!</p>
                    </div>
                  </a>
                </div>
                <div class="card-product">
                  <a href="{{ url('/tools/quotation-penawaran-harga-online-gratis') }}">
                    <div class="product-content">
                      <p class="product-content-tittle">Quotation / Penawaran Harga Online Gratis</p>
                      <p>Butuh membuat dokumen penawaran harga resmi dengan cepat? Gunakan tool <strong>Quotation Generator</strong> ini untuk membuat dokumen penawaran harga profesional dalam format PDF.</p>
                      <p>Lengkapi data perusahaan Anda, detail pelanggan, serta daftar produk atau layanan yang ditawarkan. Penawaran harga akan tampil rapi dengan header usaha Anda, lengkap dengan logo dan rincian biaya. Siap diunduh dan dikirim ke calon klien secara instan.</p>
                    </div>
                  </a>
                </div>
                <div class="card-product">
                  <a href="{{ url('/tools/struk-online-generator') }}">
                    <div class="product-content">
                      <p class="product-content-tittle">Struk Online Generator Gratis</p>
                      <p>Buat <strong>struk belanja</strong> profesional langsung dari browser Anda tanpa perlu software kasir atau printer khusus.</p>
                      <p>Cukup isi nama toko, alamat, daftar barang, dan harga — sistem akan otomatis menghitung subtotal, PPN (jika ada), serta total akhir.</p>
                      <p>Hasil bisa langsung diunduh dalam bentuk <strong>PDF thermal 58mm atau 80mm</strong>, siap dicetak atau dikirim ke pelanggan Anda.</p>
                    </div>
                  </a>
                </div>
        </div>
    </div>
</section>
   
<section id="why-us">
    <div class="custom-container">
        <div class="section-header">
            <h2>Kenapa Azolatekno Menjadi Pilihan Terbaik untuk Website, Aplikasi, dan Integrasi AI?</h2>
            <p>Azolatekno adalah partner digital terpercaya sejak 2018 yang telah membantu puluhan klien mencapai posisi Top 1 Google. Beberapa website buatan kami bahkan telah direkomendasikan langsung oleh ChatGPT untuk kata kunci tertentu. Di era digital yang semakin bergeser ke AI, muncul sebagai entitas terpercaya di mesin pencari dan platform AI seperti ChatGPT adalah strategi bisnis yang wajib dilakukan.</p>
        </div>
        <div class="why-us-content">

            <div class="why-us-item">
                <img src="{{ asset('img/icon/custom-solution.webp') }}" alt="Pembuatan Website dan Aplikasi Sesuai Kebutuhan" loading="lazy">
                <div class="why-us-info">
                    <h3>Solusi Aplikasi & Website Custom</h3>
                    <p>Setiap proyek dirancang khusus untuk memenuhi kebutuhan bisnis Anda—dari tampilan hingga fungsionalitas.</p>
                </div>
            </div>

            <div class="why-us-item">
                <img src="{{ asset('img/icon/seo-optimized.webp') }}" alt="Website SEO Friendly Top 1 Google" loading="lazy">
                <div class="why-us-info">
                    <h3>Website SEO Friendly – Banyak Masuk Halaman 1 Google</h3>
                    <p>Website yang kami kembangkan telah terbukti menembus peringkat #1 Google di berbagai kata kunci lokal maupun nasional.</p>
                </div>
            </div>

            <div class="why-us-item">
                <img src="{{ asset('img/icon/ai-integration.webp') }}" alt="Integrasi Kecerdasan Buatan AI untuk Bisnis" loading="lazy">
                <div class="why-us-info">
                    <h3>Integrasi AI & Automasi Bisnis</h3>
                    <p>Kami bantu bisnis Anda lebih efisien dengan solusi AI seperti chatbot, workflow otomatis, dan analitik prediktif.</p>
                </div>
            </div>

            <div class="why-us-item">
                <img src="{{ asset('img/icon/recognized.webp') }}" alt="Website Rekomendasi ChatGPT" loading="lazy">
                <div class="why-us-info">
                    <h3>Direkomendasikan oleh ChatGPT</h3>
                    <p>Beberapa website klien Azolatekno telah muncul sebagai rekomendasi terpercaya dari ChatGPT karena struktur dan performanya yang optimal.</p>
                </div>
            </div>

            <div class="why-us-item">
                <img src="{{ asset('img/icon/digital-shift.webp') }}" alt="Era Digital dan AI Marketing" loading="lazy">
                <div class="why-us-info">
                    <h3>Bisnis Harus Hadir di Era AI</h3>
                    <p>Dunia digital telah bergeser: kehadiran Anda tidak cukup hanya di Google. Muncul di rekomendasi platform AI seperti ChatGPT adalah langkah strategis yang kami bantu wujudkan.</p>
                </div>
            </div>

            <div class="why-us-item">
                <img src="{{ asset('img/icon/ai-course.webp') }}" alt="Kursus AI untuk Pemula dan Profesional" loading="lazy">
                <div class="why-us-info">
                    <h3>Kursus AI Praktis & Terarah</h3>
                    <p>Azolatekno juga menyediakan pelatihan AI dengan pendekatan hands-on dan kurikulum yang disusun berdasarkan kebutuhan industri terkini—cocok untuk pemula maupun profesional.</p>
                </div>
            </div>

        </div>
    </div>
</section>


@endsection