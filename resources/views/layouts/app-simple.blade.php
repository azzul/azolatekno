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
    <meta property="og:site_name" content="Sakura Sandang - Toko Bahan Kaos Terlengkap Dengan Harga Terjangkau">
    <meta property="og:url" content="{{ url()->current() }}"> <!-- Dynamic current URL -->
    <meta name="twitter:card" content="summary_large_image"> <!-- Card type -->
    <meta name="twitter:title" content="{{ $meta->og_title }}"> <!-- Matches og:title -->
    <meta name="twitter:description" content="{{ $meta->og_description ?? '' }}"> <!-- Matches og:description -->
    <meta name="twitter:image" content="{{ asset($meta->og_image ?? 'img/default-og-image.jpg') }}">
    <meta name="twitter:url" content="{{ url()->current() }}"> <!-- Dynamic current URL -->
    <meta name="twitter:site" content="@altratex_group"> <!-- Replace with your Twitter username -->
    <link rel="icon" href="{{ asset('skr.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('skr.ico') }}" type="image/x-icon">
    <!-- Favicon untuk Android -->
    <link rel="icon" sizes="192x192" href="{{ asset('skr-192x192.png') }}">
    <link rel="icon" sizes="128x128" href="{{ asset('skr-128x128.png') }}">

    <!-- Favicon untuk iOS -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('skr-180x180.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('skr-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('skr-120x120.png') }}">

    <!-- Favicon untuk Windows -->
    <meta name="msapplication-TileImage" content="{{ asset('skr-150x150.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
      
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Font Awesome -->
     <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </noscript>
    
    <!-- Bootstrap CSS File -->
    <link rel="preload" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    </noscript>
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Toko Bahan Kaos Sakura Solo",
  "url": "https://kainsakurasandang.com",
  "logo": "https://kainsakurasandang.com/img/skr-circle.webp",
  "image": "https://kainsakurasandang.com/img/skr-circle.webp",
  "email": "info@kainsakurasandang.com",
  "telephone": "(0271) 664094",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+62-856-0143-0553",
    "contactType": "Customer Support",
    "areaServed": "ID"
  },
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Jl. Yos Sudarso No 304 Rt 04 Rw 01 Serengan",
    "addressLocality": "Surakarta",
    "addressRegion": "Jawa Tengah",
    "postalCode": "57153",
    "addressCountry": "ID"
  },
  "location": {
    "@type": "Place",
    "name": "Depo Kain Kaos Sakura Sandang",
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": -7.5834546,
      "longitude": 110.819653
    }
  },
  "hasPOS": {
    "@context": "https://schema.org",
    "@type": "Place",
    "name": "Depo Kain Kaos Sakura Sandang",
    "image": "https://kainsakurasandang.com/img/skr-circle.webp",
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": -7.5834546,
      "longitude": 110.819653
    },
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Jl. Yos Sudarso No 304 Rt 04 Rw 01 Serengan",
      "addressLocality": "Surakarta",
      "addressRegion": "Jawa Tengah",
      "postalCode": "57153",
      "addressCountry": "ID"
    },
    "hasMap": "https://maps.app.goo.gl/yVRpwkenFBK2vaeh9",
    "openingHoursSpecification": {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": [
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday"
      ],
      "opens": "08:00",
      "closes": "17:00"
    }
  },
  "offers": {
    "@type": "Offer",
    "url": "https://kainsakurasandang.com/shop/cotton-combed-20s-putih-bluish",
    "priceCurrency": "IDR",
    "price": "94000",
    "priceValidUntil": "2025-12-31",
    "itemOffered": {
      "@type": "Product",
      "name": "Cotton Combed 20s - Putih Bluish",
      "description": "Kain kaos berkualitas tinggi, lembut, dan nyaman, cocok untuk pembuatan kaos dengan berbagai pilihan warna.",
      "image": "https://kainsakurasandang.com/img/product/ctn-putih-bluish.jpg",
      "brand": {
        "@type": "Brand",
        "name": "Sakura Sandang"
      },
      "sku": "CM20PTHBLUISH",
      "category": "Kain Kaos",
      "color": "Putih Bluish",
      "material": "Cotton Combed",
      "offers": {
        "@type": "Offer",
        "url": "https://kainsakurasandang.com/shop/cotton-combed-20s-putih-bluish",
        "priceCurrency": "IDR",
        "price": "94000",
        "priceValidUntil": "2025-12-31",
        "availability": "https://schema.org/InStock",
        "seller": {
          "@type": "Organization",
          "name": "Toko Kain Kaos Sakura Sandang Solo"
        }
      }
    }
  }
}
</script>
 
<!-- Area untuk JSON-LD tambahan -->
@stack('json-ld')
    <script type="text/javascript">
    var BASE_URL = {!! json_encode(url('/')) !!};
    </script>
    <!-- Main Stylesheet File -->

    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <!-- Add your CSS files here -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- Google tag (gtag.js) -->

</head>
<body class="">
<!-- Google Tag Manager (noscript) -->

<!-- End Google Tag Manager (noscript) -->
    <!-- Header -->
    @include('partials.header2')

    <!-- Main Content -->

        @yield('content')
    

    <!-- Footer -->
    @include('partials.footer')

    <!-- Add your JS files here -->
     <script src="{{ asset('js/utama.min.js') }}"></script>
</body>
</html>