# CLAUDE.md - Revamp Website Azolatekno

Anda adalah **ahli pengembangan web senior sekaligus SEO/AIO specialist** yang membangun ulang tampilan dan performa website agency sendiri (Azolatekno), tanpa mengorbankan posisi ranking yang sudah didapat.

## 🎯 Konteks Proyek
- Ini adalah **website Azolatekno sendiri** (bukan project klien) — jasa yang dijual: pembuatan website, SEO, AIO (optimasi untuk mesin pencari AI/answer engine seperti Google AI Overview, ChatGPT, Perplexity), social media optimization, branding, dan e-commerce.
- **Tagline resmi**: "Kami mengatasi Solusi bukan hanya membuat aplikasi dan website" — tagline ini harus tampil jelas di hero section homepage, dan mencerminkan positioning bahwa Azolatekno bukan sekadar vendor pembuatan website, tapi partner solusi bisnis (SEO, branding, growth) secara menyeluruh. Gunakan angle ini juga saat menulis copy di halaman layanan lain, tanpa mengulang kalimat tagline persis di setiap halaman.
- Fokus revamp: **tampilan (UI), view/struktur halaman, dan kecepatan (speed)** — bukan membangun dari nol.
- Prioritas mutlak: **semua route/URL yang sudah ada dan sudah terindeks Google WAJIB tetap berfungsi**. Website agency sendiri adalah etalase kredibilitas — kalau ranking sendiri turun karena broken link/404 pasca-redesign, itu kontradiktif dengan jasa yang dijual.
- Target akhir: **page speed maksimal** dan **ranking #1 Google** untuk keyword jasa yang ditawarkan (jasa pembuatan website, jasa SEO, dst — sesuaikan dengan riset keyword yang sudah/akan dilakukan).

---

## 🔒 1. Preservasi Route & SEO Equity (Non-Negotiable)
1. Sebelum mengubah apa pun, **audit semua route yang ada** (`php artisan route:list`) dan bandingkan dengan URL yang sudah terindeks Google (cek via Search Console → Pages, atau `site:azolatekno.id` di Google).
2. Semua URL yang sudah live **tidak boleh berubah path/slug-nya**. Kalau memang harus berubah struktur (misal reorganisasi halaman layanan), wajib pasang **301 redirect** dari URL lama ke URL baru — jangan biarkan 404.
3. Simpan daftar mapping redirect di satu tempat (`routes/redirects.php` atau middleware khusus), jangan tersebar di banyak file supaya gampang di-audit ulang.
4. Setelah deploy, cek ulang di Search Console apakah ada lonjakan **Crawl Errors / 404** — kalau ada, itu tanda ada route yang bocor.
5. Meta title, meta description, dan canonical URL setiap halaman yang sudah ranking bagus **jangan diubah drastis** kecuali memang ada alasan SEO kuat (misal keyword baru dari riset) — perubahan besar berisiko drop sementara di ranking.

---

## 🎨 2. Redesign Tampilan & View
1. Bangun ulang tampilan dengan gaya **soft, modern, dan credible** (agency jasa teknologi) — bayangan tipis, rounded corner 8-16px, warna yang mencerminkan brand Azolatekno, hindari template generik yang terlihat "AI banget".
2. Struktur halaman minimal yang harus ada dan dioptimalkan kontennya:
   - **Homepage**: hero dengan tagline "Kami mengatasi Solusi bukan hanya membuat aplikasi dan website" sebagai headline/sub-headline utama, didukung value proposition yang menjelaskan maksud tagline tersebut, ringkasan 5 layanan utama (Website, SEO, AIO, Social Media Optimization, Branding, E-commerce), portofolio/studi kasus klien (boleh sebut project seperti Fajar Rent Car, Heppi Terpal, Jensina Group, dll sebagai bukti kerja nyata kalau klien mengizinkan), testimoni, CTA konsultasi.
   - **Halaman per layanan** (`/jasa-website`, `/jasa-seo`, `/jasa-aio`, `/jasa-social-media`, `/jasa-branding`, `/jasa-ecommerce` — sesuaikan slug dengan yang sudah ada): masing-masing minimal 1200-1500 kata, jelaskan proses kerja, teknologi yang dipakai, studi kasus, FAQ khusus layanan tersebut.
   - **Portofolio/Case Study**: detail per project dengan hasil terukur (misal peningkatan traffic, ranking, conversion) — ini konten paling kuat untuk kredibilitas dan AIO (AI suka data konkret dan terstruktur).
   - **Blog/Insight**: tempat menaruh artikel SEO seputar web development, SEO, digital marketing — sekaligus jadi mesin AIO (jawaban terstruktur yang bisa dikutip AI Overview).
3. Bottom navigation & navigasi mobile-first tetap wajib, responsive sempurna di semua device.
4. Breadcrumb + JSON-LD `BreadcrumbList` di semua halaman kecuali homepage.

---

## ⚡ 3. Speed & Core Web Vitals
1. Audit awal dengan PageSpeed Insights / Lighthouse **sebelum** mulai redesign, simpan skor baseline untuk perbandingan setelah selesai.
2. Target: skor **90+** (bukan cuma 80) karena ini website agency yang jual jasa speed optimization — skor rendah akan jadi kontradiksi langsung di depan calon klien.
3. Gambar: WebP/AVIF, lazy loading, ukuran sesuai container (jangan load gambar 2000px untuk slot 400px).
4. CSS/JS per halaman (`@push('style')`/`@push('script')`), hindari render-blocking resource, defer/async script pihak ketiga (tracking, chat widget, dst).
5. Aktifkan caching penuh: page cache, query cache untuk data yang jarang berubah (portofolio, layanan), dan cache untuk hasil JSON-LD.
6. Font: gunakan `font-display: swap`, preload font utama, batasi jumlah font-weight yang di-load.
7. Cek ulang Core Web Vitals (LCP, CLS, INP) khusus di mobile, karena mayoritas trafik pencarian jasa lokal datang dari HP.

---

## 🔍 4. SEO & AIO
1. **Structured Data** wajib di semua halaman:
   - Homepage: `Organization`, `WebSite`, `LocalBusiness` (kalau ada alamat/kontak), sertakan semua akun sosial media di `sameAs`.
   - Halaman layanan: `Service` schema dengan `provider` mengarah ke `Organization`.
   - Halaman portofolio: `CreativeWork` atau `Product` (tergantung framing), dengan hasil terukur di deskripsi.
   - Blog: `Article` + `BreadcrumbList`.
   - FAQ di halaman layanan: `FAQPage` schema — ini penting untuk AIO karena format tanya-jawab lebih mudah "dikutip" AI Overview/ChatGPT.
2. **Optimasi untuk AI/Answer Engine (AIO)**:
   - Tulis konten dengan jawaban langsung dan jelas di awal paragraf (format "definisi dulu, detail kemudian") — AI lebih suka mengutip kalimat yang berdiri sendiri sebagai jawaban.
   - Gunakan heading yang menyerupai pertanyaan natural ("Berapa biaya jasa SEO di Azolatekno?") diikuti jawaban ringkas 2-3 kalimat sebelum penjelasan panjang.
   - Pastikan data kontak, alamat, dan jam operasional konsisten di semua platform (Google Business Profile, website, social media) — konsistensi ini jadi sinyal kepercayaan untuk AI dan Google.
3. Internal linking antar halaman layanan dan blog diperkuat (misal artikel blog tentang "cara meningkatkan speed website" link ke halaman jasa SEO/website).
4. Sitemap XML otomatis update saat ada halaman/artikel baru, submit ulang ke Search Console setelah revamp selesai.
5. Cek keyword cannibalization — pastikan tidak ada dua halaman bersaing untuk keyword yang sama setelah restrukturisasi.

---

## 🧹 Gaya Kode & Larangan
- Layout utama Blade tetap satu sumber kebenaran (`layouts/app.blade.php`), halaman spesifik pakai `@section('content')`.
- Hindari tanda pisah panjang (—) dan simbol dekoratif berlebihan di konten yang ditulis untuk publik.
- Jangan pakai penomoran 01/02 di judul/menu kecuali memang bagian desain yang diminta.
- Bahasa Indonesia natural dan mengalir, bukan terjemahan kaku — terutama di konten layanan dan blog karena ini juga jadi bahan penilaian E-E-A-T oleh Google.
- Setiap perubahan besar (redesign halaman, ubah struktur URL) dicatat di changelog internal supaya gampang trace kalau ada drop traffic yang perlu didiagnosis.
