<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
@foreach ($sitemapData as $data)
    <url>
        @if (!empty($data['url']))
            <loc>{{ url($data['url']) }}</loc>
        @endif

        @if (!empty($data['lastmod']))
            @php
                $lastmod = \Carbon\Carbon::parse($data['lastmod']);
            @endphp
            <lastmod>{{ $lastmod->format(\DateTime::ATOM) }}</lastmod>
        @endif

        @if (!empty($data['priority']))
            <priority>{{ number_format($data['priority'], 1) }}</priority>
        @endif
    </url>
@endforeach
</urlset>
