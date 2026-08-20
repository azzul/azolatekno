@extends('layouts.app-custom')
@push('preload')
<script>
if (isMobile) {
      preloadImage('{{ asset('img/content/' . $konten->img_small) }}');
    } else {
      preloadImage('{{ asset('img/content/' . $konten->img_content) }}');
      preloadImage('{{ asset('img/azolatekno-square.webp') }}');
    }
    </script>
@endpush
@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "{{ $konten->judul }}",
  "url": "{{ url()->current() }}",
  "description": "{{ Str::limit(strip_tags($konten->short_desc), 160, '...') }}",
  "image": "{{ asset('img/content/' . (!empty($konten->img_small) ? $konten->img_small : $konten->img_content)) }}",
  "publisher": {
    "@type": "Organization",
    "name": "Azolatekno",
    "url": "https://azolatekno.com",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('img/azolatekno-square.webp') }}"
    }
  }
}
</script>
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
      "name": "{{ $konten->page_name }}"
    }
  ]
}
</script>
@endpush
@section('content')

<section id="breadcrumb-section-about pt-90" >
        <div class="custom-container">
            <div class="breadcrumb-text">
                 <a href="{{ url('/') }}">Beranda</a> / 
                <span class="W-500">{{$konten->page_name}}</span>
            </div>
        </div>
    </section>

<section id="konten" class="mtop-0">
    <div class="custom-container">
        <div class="section-header-left ">
                    <h1>{{$konten->judul}}</h1> 
                </div>
        <div class="flex-content">
            <div class="custom-content-image">
                <div class="image-wrapper" onclick="openWhatsApp()"> 
                <picture>
                  <source srcset="{{ asset('img/content/' . $konten->img_small) }}" media="(max-width: 480px)" type="image/webp">
                  <img 
                    src="{{ asset('img/content/' . $konten->img_content) }}"
                    alt="{{ $konten->judul }}"
                    fetchpriority="high"
                    decoding="async"
                    width="720"
                    height="380"
                    loading="eager">
                </picture>
                </div>
            </div>
            <div class="sidebar pt-0">
                <div class="card-sidebar">
                    <div class="card-sidebar-img">
                       <img src="{{ asset('img/azolatekno-square.webp') }}" 
                     alt="Logo Azolatekno" 
                     width="250" 
                     height="250"
                     fetchpriority="high" 
                  decoding="async" 
                  loading="eager" >
                    </div>
                    <div class="card-content">
                        <h2 class="card-content-tittle">Azolatekno</h2>
                        <div class="flex-icon-text">
                            <div class="btn-social"><i class="fab fa-whatsapp"></i></div>
                            @php
                                $phone = '6285129370703';
                                $message = "Halo admin Azolatekno, saya mau tanya Layanan Digitalnya. Saya dapat info dari " . url()->current();
                                $whatsappLink = "https://wa.me/" . preg_replace('/[^0-9]/', '', $phone) . "?text=" . urlencode($message);
                            @endphp
                            <a href="{{ $whatsappLink }}" target="_blank" rel="nofollow noopener noreferrer">085129370703</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="custom-content-detail">
            <div id="tableOfContents" class="toc-container"></div>
            <div class="content-detail-wrapper">
                {!!$konten->isi!!}
            </div>
        </div>
        
    </div>
</section>

<section id="layanan">
    <div class="custom-container">
        <div class="section-header">
            <h2>Layanan Lainnya dari Azolatekno</h2>
        </div>
        <div class="product-grid">
            @foreach($products as $product)
                <div class="card-product">
                    <a href="{{ url('/layanan/' . $product->slug_produk) }}">
                        <div class="product-image-wrapper">
                            <img 
                              src="{{ asset('img/product/' . $product->image_produk) }}" 
                              alt="{{ $product->nama_produk }}" 
                              loading="lazy" 
                              width="700" 
                              height="500" 
                              style="max-width:100%;height:auto;">
                            <!-- @foreach ($product->harga as $harga)
                            @if($harga->diskon > 0)
                                <div class="badge-diskon">Diskon {{ $harga->diskon }}%</div>
                            @endif
                             @endforeach -->
                        </div>
                        <div class="product-content">
                            <p class="product-content-tittle">{{$product->nama_produk}}</p>

                           {!!$product->spesifikasi!!}
                           <div class="description">Mulai</div>
                           @foreach ($product->harga as $h)
                                <p class="product-content-price">Rp{{ number_format($h->harga, 0, ',', '.') }}</p>
                            @endforeach
                           
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    function openWhatsApp() {
        let phone = '6285129370703';
        let message = "Halo admin Azolatekno, saya mau tanya buat web dan SEO nya. Saya dapat info dari " + window.location.href;
        let whatsappLink = "https://wa.me/" + phone + "?text=" + encodeURIComponent(message);
        
        window.open(whatsappLink, "_blank");
    }
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const content = document.getElementById("contentWrapper");
    const toc = document.getElementById("tableOfContents");

    if (!content || !toc) return;

    const headings = content.querySelectorAll("h2, h3");
    if (headings.length === 0) return;

    let tocHTML = '<div class="toc-title">Daftar Isi</div><ul class="toc-list">';

    headings.forEach((heading, index) => {
        const text = heading.innerText.trim();

        // Buat slug id unik
        const slug = text
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, "-")
            .replace(/(^-|-$)/g, "") + "-" + index;

        // Pasang ID ke heading
        heading.setAttribute("id", slug);

        // Tambahkan ke TOC
        if (heading.tagName === "H2") {
            tocHTML += `<li class="toc-item toc-h2"><a href="#${slug}">${text}</a></li>`;
        } else if (heading.tagName === "H3") {
            tocHTML += `<li class="toc-item toc-h3"><a href="#${slug}">${text}</a></li>`;
        }
    });

    tocHTML += "</ul>";
    toc.innerHTML = tocHTML;
});
</script>

@endsection