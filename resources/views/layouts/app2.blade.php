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
     <meta property="og:site_name" content="Hafes Rent Car">
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
    <link rel="icon" sizes="192x192" href="{{ asset('hafes-192x192.png') }}">
    <link rel="icon" sizes="128x128" href="{{ asset('hafes-128x128.png') }}">

    <!-- Favicon untuk iOS -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('hafes-180x180.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('hafes-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('hafes-120x120.png') }}">

    <!-- Favicon untuk Windows -->
    <meta name="msapplication-TileImage" content="{{ asset('hafes-150x150.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
   <!-- Preload font Poppins (400, 600, 700) -->

     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    
    <!-- Google Tag Manager -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Rental Mobil PT Hafes Megah Lestari",
  "image": "https://Hafesrentcar.id/img/share.jpg",
  "url": "https://Hafesrentcar.id",
  "logo": "https://Hafesrentcar.id/img/hafes-192x192.png",
  "email": "info@Hafesrentcar.id",
  "telephone": "+6282125423807",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Ruko NEO Fierra, Jl. AMD No.33 No C-07, Pd. Kacang Bar., Kec. Pd. Aren",
    "addressLocality": "Tangerang Selatan",
    "addressRegion": "Banten",
    "postalCode": "15226",
    "addressCountry": "ID"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": -6.2551527,
    "longitude": 106.6843941
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5.0",
    "reviewCount": "3"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+6282125423807",
    "contactType": "Customer Support",
    "areaServed": "ID",
    "availableLanguage": ["Indonesian", "English"]
  },
  "sameAs": [
    "https://maps.app.goo.gl/QoHV3Uxku2NwGe5LA"
  ],
  "priceRange": "Rp500.000 - Rp2.000.000",
  "openingHours": [
    "Mo-Su 00:00-23:59"
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

    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js" defer></script>
    <!-- Add your CSS files here -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- Google tag (gtag.js) -->
</head>
<body class="">
<!-- Google Tag Manager (noscript) -->
    <!-- Header -->
    @include('partials.header2')
 
    <!-- Main Content -->

        @yield('content')
    

    <!-- Footer -->
    @include('partials.footer')

    <!-- Add your JS files here -->
     <script src="{{ asset('js/utama.js') }}"></script>
     <script src="{{ asset('js/protect.js') }}"></script>
</body>
</html>