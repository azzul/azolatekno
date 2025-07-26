<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\CustomContent;
use App\Models\Toko;
use App\Models\EtalaseKategori;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


class SitemapController extends Controller
{
    public function generate()
    {
        // Prepare sitemap data
        $sitemapData = [];

        // **Tambahkan Halaman Statis**
        $sitemapData[] = [
            'url' => route('home'),
            'priority' => 1.0,
            'lastmod' => Carbon::now(),
        ];

        $sitemapData[] = [
            'url' => route('armada'),
            'priority' => 1,
            'lastmod' => Carbon::now(),
        ];

        $sitemapData[] = [
            'url' => route('about'),
            'priority' => 1,
            'lastmod' => Carbon::now(),
        ];

        $sitemapData[] = [
            'url' => route('pricelist'),
            'priority' => 1,
            'lastmod' => Carbon::now(),
        ];

        $sitemapData[] = [
            'url' => route('testimonial'),
            'priority' => 1,
            'lastmod' => Carbon::now(),
        ];

        
        $sitemapData[] = [
            'url' => route('terms'),
            'priority' => 0.8,
            'lastmod' => Carbon::now(),
        ];

        $sitemapData[] = [
            'url' => route('privacy'),
            'priority' => 0.8,
            'lastmod' => Carbon::now(),
        ];


        $sitemapData[] = [
            'url' => route('license-info'),
            'priority' => 0.8,
            'lastmod' => Carbon::now(),
        ];


        // **Tambahkan Detail Produk**
        $products = Produk::all();

        foreach ($products as $product) {
            $sitemapData[] = [
                'url' => route('armada.detail', [
                    'slug_produk' => $product->slug_produk,
                ]),
                'priority' => 1.0,
                'lastmod' => Carbon::parse($product->updated_at)->format(\DateTime::ATOM),
            ];
        }
        $customContents = CustomContent::all();

        foreach ($customContents as $content) {
            $sitemapData[] = [
                'url' => route('custom', [
                    'slug_content' => $content->slug_content,
                ]),
                'priority' => 1.0,
                'lastmod' => Carbon::parse($content->updated_at)->format(\DateTime::ATOM),
            ];
        }
       
        // Pass the data to the Blade view and render it as XML
          $xmlContent = view('sitemap.index', compact('sitemapData'))->render();

        // Save the XML content to the public directory as sitemap.xml
        Storage::disk('public_main')->put('sitemap.xml', $xmlContent);

        return response()->json(['message' => 'Sitemap generated and saved successfully']);
    }
}