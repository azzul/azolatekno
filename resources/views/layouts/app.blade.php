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
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Azolatekno">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $meta->og_title }}">
    <meta name="twitter:description" content="{{ $meta->og_description ?? '' }}">
    <meta name="twitter:image" content="{{ asset($meta->og_image ?? 'img/default-og-image.jpg') }}">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" sizes="192x192" href="{{ asset('azolatekno-192x192.png') }}">
    <link rel="icon" sizes="128x128" href="{{ asset('azolatekno-128x128.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('azolatekno-180x180.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('azolatekno-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('azolatekno-120x120.png') }}">
    <link rel="alternate" type="text/plain" href="{{ asset('llms.txt') }}" title="LLM Content Guide">
    <meta name="msapplication-TileImage" content="{{ asset('azolatekno-150x150.png') }}">
    <meta name="msapplication-TileColor" content="#129a57">
    <meta name="theme-color" content="#129a57">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap"></noscript>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
    @stack('json-ld')
    @stack('preload')
    <script>
        var BASE_URL = {!! json_encode(url('/')) !!};
    </script>

    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MBG4JWS');</script>

    @stack('scripts')
</head>
<body class="bg-white text-ink-800">
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MBG4JWS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

@include('partials.site-header')

<main>
    @yield('content')
</main>

@include('partials.site-footer')

@stack('scripts-bottom')
</body>
</html>
