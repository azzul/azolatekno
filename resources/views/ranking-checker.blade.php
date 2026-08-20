@extends('layouts.app2')

@section('content')
<div class="container-tools pt-90">
     <div class="custom-container">
        <div class="section-header">
            <h1>Google Ranking Checker dan Cek Kompetitor Ranking Gratis</h1>
            <p>Cek posisi website Anda di hasil pencarian Google secara real-time.</p>
        </div>
    {{-- Form Input --}}
    <div class="card-tools">
        <form method="POST" action="{{ route('ranking.check') }}">
            @csrf
            <div class="form-group-tools">
                <label for="domains">Domain / Website</label>
                <textarea name="domains" id="domains" class="input-tools" rows="3" placeholder="contoh: azolatekno.com&#10;azolatekno.id"></textarea>
            </div>
            <div class="form-group-tools">
                <label for="keywords">Kata Kunci</label>
                <textarea name="keywords" id="keywords" class="input-tools" rows="3" placeholder="contoh: jasa pembuatan website, jasa seo"></textarea>
            </div>
            <button type="submit" class="btn-tools">Cek Ranking</button>
        </form>
    </div>

    {{-- Hasil --}}
    @isset($results)
    <div class="card-tools mt-6">
        <h2 class="tools-section-title">Hasil Pengecekan</h2>
        <table class="tools-table">
            <thead>
              <tr>
                <th>Kata Kunci</th>
                <th>Domain</th>
                <th>Ranking</th>
                <th>URL Ditemukan</th>
              </tr>
            </thead>
            <tbody>
              @foreach($results as $row)
              <tr>
                  <td data-label="Kata Kunci">{{ $row['keyword'] }}</td>
                  <td data-label="Domain">{{ $row['domain'] }}</td>
                  <td data-label="Ranking">
                    @if($row['rank'])
                      <span class="badge-tools success">#{{ $row['rank'] }}</span>
                    @else
                      <span class="badge-tools danger">Tidak ditemukan</span>
                    @endif
                  </td>
                  <td data-label="URL Ditemukan">
                    @if($row['url'])
                      <a href="{{ $row['url'] }}" target="_blank">{{ $row['url'] }}</a>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
        </table>
        </div>
    </div>
    @endisset

    {{-- Edukasi Ranking Google --}}
    <section class="info-section mt-10">
        <div class="custom-container">
            <div class="section-header">
            <h2 class="tools-section-title">Apa Itu Ranking Google?</h2>
            </div>
        <p>
            Ranking Google adalah posisi sebuah website ketika seseorang mencari dengan kata kunci tertentu di mesin pencari Google. 
            Semakin tinggi peringkat website Anda, semakin besar kemungkinan orang mengunjungi situs tersebut.
        </p>

        <h3 class="tools-section-subtitle">Faktor yang Mempengaruhi Ranking</h3>
        <ul class="list-disc pl-5 space-y-2">
            <li><strong>SEO On-Page:</strong> kualitas konten, struktur heading, meta tag, dan internal linking.</li>
            <li><strong>SEO Off-Page:</strong> backlink dari website lain yang relevan dan berkualitas.</li>
            <li><strong>Kecepatan Website:</strong> loading yang cepat meningkatkan pengalaman pengguna.</li>
            <li><strong>Mobile Friendly:</strong> website yang responsif lebih disukai Google.</li>
            <li><strong>User Experience:</strong> navigasi mudah, bounce rate rendah, dan engagement tinggi.</li>
        </ul>

        <h3 class="tools-section-subtitle">Tingkatkan Ranking Website Anda</h3>
        <p>
            Ingin website Anda muncul di halaman pertama Google? Tim <strong>AzolaTekno</strong> siap membantu dengan 
            layanan <em>SEO profesional</em>, pembuatan website yang cepat dan responsif, hingga optimasi iklan digital. 
            Dengan strategi berbasis data dan AI, kami pastikan bisnis Anda semakin mudah ditemukan di internet.
        </p>
        <a href="/contact-us" class="btn-tools-secondary mt-4">Konsultasi Gratis SEO</a>
    </div>
    </section>
</div>
@endsection