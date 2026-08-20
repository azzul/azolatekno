<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="robots" content="index,follow">
   <link rel="canonical" href="{{ request()->url() }}">
   <link rel="alternate" href="{{ request()->url() }}" hreflang="id" />
    <title>{{ $meta->title ?? 'Default Title' }}</title>
     <meta name="description" content="{{ $meta->description ?? '' }}">
    <meta name="keywords" content="{{ $meta->keywords ?? '' }}">
    <meta property="og:title" content="{{ $meta->og_title }}">
    <meta property="og:description" content="{{ $meta->og_description ?? '' }}">
    <meta property="og:image" content="{{ asset($meta->og_image ?? 'img/default-og-image.jpg') }}">
    <meta property="og:type" content="website"> <!-- Default: website -->
     <meta property="og:site_name" content="Azolatekno">
    <meta property="og:url" content="{{ url()->current() }}"> <!-- Dynamic current URL -->
    <meta name="twitter:card" content="summary_large_image"> <!-- Card type -->
    <meta name="twitter:title" content="{{ $meta->og_title }}"> <!-- Matches og:title -->
    <meta name="twitter:description" content="{{ $meta->og_description ?? '' }}"> <!-- Matches og:description -->
    <meta name="twitter:image" content="{{ asset($meta->og_image ?? 'img/default-og-image.jpg') }}">
    <meta name="twitter:url" content="{{ url()->current() }}"> <!-- Dynamic current URL -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- Favicon untuk Android -->
    <link rel="icon" sizes="192x192" href="{{ asset('azolatekno-192x192.png') }}">
    <link rel="icon" sizes="128x128" href="{{ asset('azolatekno-128x128.png') }}">

    <!-- Favicon untuk iOS -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('azolatekno-180x180.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('azolatekno-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('azolatekno-120x120.png') }}">
    <link rel="alternate" type="text/plain" href="{{ asset('llms.txt') }}" title="LLM Content Guide">
    
    <!-- Favicon untuk Windows -->
    <meta name="msapplication-TileImage" content="{{ asset('azolatekno-150x150.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
   <!-- Preload font Poppins (400, 600, 700) -->

   <link rel="stylesheet" href="{{ asset('css/style.min.css') }}?v={{ time() }}">
     <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
    <!-- Font Awesome -->
     <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    </noscript>
    
    <!-- Bootstrap CSS File -->
    <link rel="preload" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    </noscript>
    <script data-cfasync="false">
    const head = document.getElementsByTagName('head')[0];
    const isMobile = window.innerWidth <= 768;

    function preloadImage(src) {
      const link = document.createElement('link');
      link.rel = 'preload';
      link.as = 'image';
      link.href = src;
      head.appendChild(link);
    }

    if (isMobile) {
      preloadImage('{{ asset("img/azolatekno-width-white-mobile.webp") }}');
    } else {
      preloadImage('{{ asset("img/azolatekno-width-white.webp") }}');
    }
  </script>
    <!-- Google Tag Manager -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Jasa Pembuatan Web, SEO dan AI Solo - Azolatekno",
  "image": "https://azolatekno.com/img/share.jpg",
  "url": "https://azolatekno.com",
  "logo": "https://azolatekno.com/img/logo-azolatekno.png",
  "email": "info@azolatekno.com",
  "telephone": "+6285129370703",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Dalon, RT 03 RW 04 Sroyo, Kec. Jaten, Kab. Karanganyar, Jawa tengah 57731",
    "addressLocality": "Karanganyar",
    "addressRegion": "Jawa Tengah",
    "postalCode": "57731",
    "addressCountry": "ID"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": -7.5451852,
    "longitude": 110.8748674
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5.0",
    "reviewCount": "6"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+6285129370703",
    "contactType": "Customer Support",
    "areaServed": "ID",
    "availableLanguage": ["Indonesian", "English"]
  },
  "sameAs": [
    "https://maps.app.goo.gl/PLLuAZZwtphEzbkM8"
  ],
  "priceRange": "Rp500.000 - Rp25.000.000",
  "openingHours": [
    "Mo-Su 08:00-22:00"
  ]
}
</script>



<!-- Area untuk JSON-LD tambahan -->
@stack('json-ld')
@stack('preload')
    <script type="text/javascript">
    var BASE_URL = {!! json_encode(url('/')) !!};
    </script>
    <!-- Main Stylesheet File -->

    <!-- Add your CSS files here -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- Google tag (gtag.js) -->
          <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MBG4JWS');</script>
      @stack('scripts')
</head>
<body class="">
<!-- Google Tag Manager (noscript) -->
    <!-- Header -->
    @include('partials.header2')
 
    <!-- Main Content -->

        @yield('content')
    

    <!-- Footer -->
    @include('partials.footer')
     <script>
         document.addEventListener('DOMContentLoaded', function () {
    const waNumber = '6287733930143';
    const marketingMessage = 'Halo admin Azolatekno, saya mau tanya jasa azolatekno. Saya dapat info dari https://azolatekno.com';

    function openWA() {
        window.open(`https://wa.me/${waNumber}?text=${encodeURIComponent(marketingMessage)}`, '_blank');
    }

    const whatsappIcon = document.getElementById('whatsappIcon');
    if (whatsappIcon) whatsappIcon.addEventListener('click', openWA);

    const whatsappBottom = document.getElementById('whatsappBottom');
    if (whatsappBottom) whatsappBottom.addEventListener('click', openWA);
});
     </script>
    <!-- Add your JS files here -->
     <script src="{{ asset('js/utama.min.js') }}"></script>
    <link rel="preload" href="https://unpkg.com/swiper/swiper-bundle.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"></noscript>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js" defer></script>

      <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MBG4JWS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>
</html>