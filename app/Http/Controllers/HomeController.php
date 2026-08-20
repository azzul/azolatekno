<?php

namespace App\Http\Controllers;

use App\Models\MetaTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Produk;
use App\Models\Toko;
use App\Models\Harga;
use App\Models\KategoriTipe;
use App\Models\Kategori;
use App\Models\KategoriUtama;
use App\Models\EtalaseKategori;
use App\Models\KontenKategori;
use App\Models\Setting;
use App\Models\Konten;
use App\Models\CustomContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    //

    public function search(Request $request)
{
    $query = $request->input('query', '');

    if (empty($query)) {
        return response()->json([]);
    }

    // Cari produk berdasarkan nama produk atau warna
    $results = DB::table('produk')
        ->where('nama_produk', 'LIKE', '%' . $query . '%')
        ->orWhere('nama_warna', 'LIKE', '%' . $query . '%')
        ->select('etalase', 'slug_produk', 'id_kategori', 'image_produk', 'nama_produk')
        ->limit(90) // Batasi hasil pencarian
        ->get();

    return response()->json($results);
}
    public function index(Request $request)
    {
        
        $meta = Cache::remember('meta_index', 30 * 60, function () {
            return MetaTag::where('page', 'index')->first();
        });

        $products = Produk::select('kode_produk', 'slug_produk', 'image_produk', 'nama_produk', 'spesifikasi')
            ->with(['harga:id_harga,kode_produk,harga,diskon'])
            ->get();
        //dd($products);
        
     $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
     $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
        return view('index', compact('meta', 'footerCategory', 'products', 'customHead'));
    }

    public function model()
    {
        
        $meta = MetaTag::where('page', 'layanan')->first();

        $products = Cache::remember("produk_list", 30 * 60, function () {
                return  Produk::select('kode_produk', 'slug_produk', 'image_produk', 'nama_produk', 'spesifikasi')
            ->with(['harga:id_harga,kode_produk,harga,diskon'])
            ->get();
        });
        
     $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
    $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
    
      
        return view('model', compact('meta',  'footerCategory', 'products', 'customHead'));
    }

    public function modelDetail(Request $request, $slug_produk)
    {
          $product = Cache::remember("produk-detail_{$slug_produk}", 30 * 60, function () use ($slug_produk) {
                return Produk::select('kode_produk', 'slug_produk', 'image_produk', 'nama_produk', 'spesifikasi', 'judul_meta', 'desc_meta', 'keyword', 'long_desc')
                    ->with(['harga:id_harga,kode_produk,harga,diskon'])
                    ->where('slug_produk', $slug_produk)
                    ->firstOrFail();
            });
        
        $meta = Cache::remember("meta2_{$slug_produk}", 300, function () use ($product) {
            return new MetaTag([
                'title' => $product->judul_meta,
                'description' => $product->desc_meta,
                'keywords' => "$product->keyword",
                'og_title' => $product->keyword,
                'og_image' => "img/product/" . $product->image_produk,
                'og_description' => $product->desc_meta,
            ]);
        });
        
        $recomendations = Cache::remember("recomendations_{$slug_produk}", 30 * 60, function () {
            return Produk::select('kode_produk', 'slug_produk', 'image_produk', 'nama_produk', 'spesifikasi')
                ->with(['harga:id_harga,kode_produk,harga,diskon'])
                ->get();
        });
     $agent = new Agent();
    $isMobile = $agent->isMobile();
     $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
     $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
    // dd($latestProducts);
        return view('model-detail', compact('meta',  'footerCategory', 'product', 'recomendations', 'customHead', 'isMobile'));
    }

    public function pricelist()
    {
        
        $meta = MetaTag::where('page', 'pricelist')->first();

        
        $prices = Harga::with(['produk', 'jenisHarga'])->get();
     $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
     $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
    // dd($latestProducts);
        return view('pricelist', compact('meta',  'footerCategory', 'prices', 'customHead'));
    }
    
public function pricelistPdf()
{
    $meta = MetaTag::where('page', 'pricelist')->first();
    $prices = Harga::with(['produk', 'jenisHarga'])->get();
    $pdf = Pdf::loadView('pricelist-pdf', compact('meta', 'prices'));
    $output = $pdf->output();
    return response()->streamDownload(
        function () use ($output) {
            echo $output;
        },
        'pricelist_azolatekno.pdf',
        [
            'Content-Type' => 'application/pdf',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]
    );
}

    public function testimonial()
    {
        
        $meta = MetaTag::where('page', 'testimonial')->first();
        $products = Produk::with(['harga' => function ($query) {
            $query->where('kode_jharga', '12JAMSPR');
        }])->with('harga.jenisHarga')->get();
     $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
     $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
    // dd($latestProducts);
        return view('testimoni', compact('meta',  'footerCategory', 'products', 'customHead'));
    }

    public function filterCategories(Request $request)
{
    $selectedCategory = $request->query('category'); // Mendapatkan id kategori utama yang dipilih
    $query = Kategori::with(['etalaseKategori', 'kategoriTipe'])
    ->where('is_active', 'Y')
    ->orderBy('no_urut', 'asc');
    

    if ($selectedCategory && $selectedCategory !== 'all') {
        // Filter berdasarkan kategori utama yang dipilih
        $query->where('id_ukategori', $selectedCategory); // Sesuaikan dengan nama kolom yang tepat
    }

    $filteredCategories = $query->get()->map(function ($kategori) {
        return [
            'id_kategori' => $kategori->id_kategori,
            'nama_kategori' => $kategori->nama_kategori,
            'img_kategori' => $kategori->img_kategori,
            'slug_kategori' => $kategori->slug_kategori,
            'deskripsi_kategori' => $kategori->deskripsi_kategori,
            'tipe_kategori' => $kategori->kategoriTipe->tipe_kategori ?? null,
            'etalase' => $kategori->etalaseKategori->pluck('etalase')->sort()->implode(', '),
        ];
    });
    //dd($filteredCategories );

    // Mengubah tebal menjadi array
    

    return response()->json($filteredCategories);
}

public function productCategory(Request $request, $tipe_kategori, $categoryName)
    {
   
        // Fetch category by name
        $category = Kategori::where('slug_kategori', $categoryName)->firstOrFail();
        
        $konten = KontenKategori::where('id_kategori', $category->id_kategori)->firstOrFail();
        
        if (!$konten) {
            return redirect()->route('konten-kategori.index')->with('error', 'Konten tidak ditemukan.');
        }

        // Tambahkan class "expandable-text" pada setiap <p>
        $konten->long_desc = str_replace('<p>', '<p class="expandable-text">', $konten->long_desc);
        $konten->penggunaan = str_replace('<p>', '<p class="expandable-text">', $konten->penggunaan);
        $konten->perawatan = str_replace('<p>', '<p class="expandable-text">', $konten->perawatan);
         $konten->long_desc = preg_replace('/<ul([^>]*)>/', '<ul$1 class="expandable-text">', $konten->long_desc);
        $konten->penggunaan = preg_replace('/<ul([^>]*)>/', '<ul$1 class="expandable-text">', $konten->penggunaan);
        $konten->perawatan = preg_replace('/<ul([^>]*)>/', '<ul$1 class="expandable-text">', $konten->perawatan);
    // Jika meta tag tidak ditemukan, bisa dibuat meta tag default atau fallback
        
        // Fetch products by category
   $products = DB::table('produk')
    ->join('warna as w', 'produk.kode_warna', '=', 'w.kode_warna')
    ->join('kategori', 'produk.id_kategori', '=', 'kategori.id_kategori')
    ->join('etalase_kategori', 'produk.id_etalase', '=', 'etalase_kategori.id_etalase')
    ->join('harga', function ($join) {
        $join->on('produk.id_kategori', '=', 'harga.id_kategori')
            ->on('produk.id_etalase', '=', 'harga.id_etalase');
    })
    ->select(
        'kategori.nama_kategori',
        'etalase_kategori.etalase',
        'etalase_kategori.img_etalase',
        DB::raw('MIN(harga.harga_roll) as harga_terendah'),
        DB::raw('MAX(harga.harga_roll) as harga_tertinggi'),
        DB::raw('GROUP_CONCAT(DISTINCT w.hex_color) as hex_colors'),
        DB::raw('COUNT(DISTINCT produk.id_produk) as total')
    )
    ->groupBy(
        'kategori.nama_kategori',
        'etalase_kategori.etalase',
        'etalase_kategori.img_etalase'
    )
    ->where('produk.id_kategori', $category->id_kategori)
    ->get();

    

    $meta = MetaTag::where('page', 'category')
        ->where('page', $category->nama_kategori) // Sesuaikan query jika ingin lebih spesifik
        ->first();
    $etalaseOptions = EtalaseKategori::where('id_kategori', $category->id_kategori)
                                        ->withCount('produk')
                                        ->get();
    // Ambil semua nama etalase
    $etalaseNames = $etalaseOptions->pluck('etalase')->toArray(); // Ganti 'nama_etalase' dengan nama kolom yang sesuai
    $etalaseList = implode(', ', array_map(function($etalase) use ($category) {
        return strtolower($category->nama_kategori . ' ' . $etalase); // Gabungkan kategori dan etalase dengan format yang diinginkan
    }, $etalaseNames));

    if (!$meta) {
        $meta = new MetaTag([
            'title' => "Bahan Kaos " . $category->nama_kategori . " - Kualitas Terbaik dari Altratex Group",
            'description' => "Temukan bahan kaos " . $category->nama_kategori . " berkualitas tinggi dari Altratex Group. Kami menyediakan " . $etalaseList . " untuk Anda.",
            'keywords' => "bahan kaos " . $category->nama_kategori . ", " . $etalaseList . " dengan koleksi warna terlengkap yaitu 100+ warna yang diproses dengan teknologi canggih sehingga menghasilkan kain dengan kualitas terbaik dengan harga menarik.",
            'og_title' => "Bahan Kaos " . $category->nama_kategori . " - " . $etalaseList . " - Kualitas Terbaik",
            'og_image' => 'img/category/' . $category->img_kategori,
            'og_description' => "Altratex Group menyediakan bahan kaos " . $category->nama_kategori . " terbaik, termasuk " . $etalaseList . "."
        ]);
    }


    // Check if there's a filter applied
    if ($request->has('filter') && $request->filter == 'ketebalan') {
        // Fetch products grouped by ketebalan
        $products = Product::where('id_kategori', $category->id_kategori)
                            ->groupBy('id_etalase')
                            ->get();
    }
    $settingServer = Setting::where('setting_name', 'is_price')->first();
    $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
        return view('category-detail', compact('products', 'category', 'meta', 'settingServer', 'tipe_kategori', 'konten', 'footerCategory'));
    }

    // UNTUK HANDLE KLIK DARI DAFTAR KETEGORI
public function etalase($tipe_kategori, $categoryName, $etalase, $page = 1, $productsPerPage = 20)
{

    $category = Kategori::where('slug_kategori', $categoryName)->firstOrFail();
    
    $etalaseProduk = EtalaseKategori::where('id_kategori', $category->id_kategori)
                    ->where('etalase', $etalase)
                    ->firstOrFail();
                   
    $aboutEtalase = KontenEtalaseKategori::where('id_etalase', $etalaseProduk->id_etalase)
                    ->where('jenis_konten', 'pengertian')
                    ->first();
    
    $spesifikasi = KontenEtalaseKategori::where('id_etalase', $etalaseProduk->id_etalase)
                    ->where('jenis_konten', 'spesifikasi')
                    ->get();

    $meta = new MetaTag([
        'title' => "{$category->nama_kategori} {$etalase} - Kualitas Terbaik dari Altratex Group",
        'description' => "Dapatkan bahan kaos {$category->nama_kategori} {$etalase} berkualitas tinggi dari Altratex Group...",
        'keywords' => "Bahan Kaos {$category->nama_kategori} {$etalase}, Toko Bahan Kaos Sakura",
        'og_title' => "{$category->nama_kategori} {$etalase} - Kualitas Terbaik",
        'og_image' => "img/etalase/{$etalaseProduk->img_etalase}",
        'og_description' => "Bahan Kaos {$category->nama_kategori} {$etalase}, Toko Bahan Kaos..."
    ]);

   $allProducts = DB::table('produk as pd')
    ->join('warna as w', 'pd.kode_warna', '=', 'w.kode_warna')
    ->join('harga as h', function ($join) {
        $join->on('pd.id_kategori', '=', 'h.id_kategori')
            ->on('pd.id_etalase', '=', 'h.id_etalase')
            ->on('pd.id_ktgwarna', '=', 'h.id_ktgwarna');
    })
    ->select(
        'pd.id_produk',
        'pd.nama_produk',
        'pd.image_produk',
        'pd.slug_produk',
        'pd.id_kategori',
        'pd.id_etalase',
        'h.harga_roll as harga_terendah',
        'h.harga_ecer as harga_tertinggi', // Ambil harga roll individual
        'h.id_ktgwarna', // Pastikan harga sesuai dengan id_ktgwarna
        DB::raw('GROUP_CONCAT(DISTINCT w.nama_warna) as nama_warna'),
        DB::raw('GROUP_CONCAT(DISTINCT w.hex_color) as hex_colors')
    )
    ->where('pd.id_kategori', $category->id_kategori)
    ->where('pd.etalase', $etalase)
    ->groupBy(
        'pd.id_produk',
        'pd.nama_produk',
        'pd.image_produk',
        'pd.slug_produk',
        'pd.id_kategori',
        'pd.id_etalase',
        'h.harga_roll', // Tambahkan harga roll ke group by
        'h.harga_ecer',
        'h.id_ktgwarna' // Tambahkan id_ktgwarna ke group by
    )
    ->get();
    
    // Perhitungan jumlah halaman sesuai produk per halaman
    $totalProducts = $allProducts->count();
    $totalPages = ceil($totalProducts / $productsPerPage);

    // Ambil produk sesuai halaman
    $products = $allProducts->slice(($page - 1) * $productsPerPage, $productsPerPage);

    // Navigasi halaman
    $prevPage = $page > 1 ? $page - 1 : null;
    $nextPage = $page < $totalPages ? $page + 1 : null;

    // Setting server dan informasi keranjang
    $settingServer = Setting::where('setting_name', 'is_price')->first();
    $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
    // Return view dengan data
    return view('etalase', compact(
        'products', 'category', 'etalase', 'prevPage', 'nextPage', 'totalPages', 'page', 'allProducts', 
        'totalProducts', 'tipe_kategori', 'meta', 'settingServer', 'aboutEtalase', 'spesifikasi', 'footerCategory'));
}

public function productDetail($slug_produk)
{
        $product = DB::table('produk as pd')
    ->join('warna as w', 'pd.kode_warna', '=', 'w.kode_warna')
    ->join('harga as h', function ($join) {
        $join->on('pd.id_kategori', '=', 'h.id_kategori')
            ->on('pd.id_etalase', '=', 'h.id_etalase')
            ->on('pd.id_ktgwarna', '=', 'h.id_ktgwarna');
    })
    ->select(
        'pd.id_produk',
        'pd.kode_produk',
        'pd.etalase',
        'pd.nama_produk',
        'pd.image_produk',
        'pd.slug_produk',
        'pd.id_kategori',
        'pd.id_etalase',
        'pd.jenis_kain',
        'pd.spesifikasi',
        'h.harga_roll',
        'h.harga_ecer', // Ambil harga roll individual
        'h.id_ktgwarna', // Pastikan harga sesuai dengan id_ktgwarna
        DB::raw('GROUP_CONCAT(DISTINCT w.nama_warna) as nama_warna'),
        DB::raw('GROUP_CONCAT(DISTINCT w.hex_color) as hex_color'),
        DB::raw('GROUP_CONCAT(DISTINCT w.pantone_color) as pantone_color'),
        DB::raw('GROUP_CONCAT(DISTINCT w.kategori_warna) as kategori_warna')
    )
    ->where('slug_produk', $slug_produk)
    ->groupBy(
        'pd.id_produk',
        'pd.kode_produk',
        'pd.etalase',
        'pd.nama_produk',
        'pd.image_produk',
        'pd.slug_produk',
        'pd.id_kategori',
        'pd.id_etalase',
        'pd.jenis_kain',
        'pd.spesifikasi',
        'h.harga_roll', // Tambahkan harga roll ke group by
        'h.harga_ecer',
        'h.id_ktgwarna' // Tambahkan id_ktgwarna ke group by
    )
    ->firstOrFail();
    
            
        $category = Kategori::where('id_kategori', $product->id_kategori)->firstOrFail();
        
        // Fetch product details
        $images = DB::table('galeri_produk')
            ->where('kode_produk', $product->kode_produk)
            ->where('is_utama', 'Y')
            ->get();
        
         $etalaseProduk = EtalaseKategori::where('id_kategori', $category->id_kategori)
                    ->where('etalase', $product->etalase)
                    ->firstOrFail();
        
        $aboutEtalase = KontenEtalaseKategori::where('id_etalase', $etalaseProduk->id_etalase)
                    ->where('jenis_konten', 'pengertian')
                    ->first();
        
        $warna = DB::table('produk as pd')
            ->join('warna as wk', 'pd.kode_warna', '=', 'wk.kode_warna')
            ->select(
                'pd.*',
                'wk.nama_warna as color_fabric',
                'wk.hex_color',
                'wk.pantone_color'
            )
            ->where('etalase', $product->etalase)
            ->where('jenis_kain', $product->jenis_kain)
            ->where('id_kategori', $category->id_kategori)
            ->get();
        
        $ktgwarna = DB::table('produk as pd')
            ->join('kategori_warna as kw', 'pd.id_ktgwarna', '=', 'kw.id_ktgwarna')
            ->select(
                'kw.kategori_warna', // Hanya kategori warna
                'kw.id_ktgwarna'     // ID kategori warna
            )
            ->where('pd.etalase', $product->etalase)
            ->where('pd.id_kategori', $category->id_kategori)
            ->groupBy('kw.kategori_warna', 'kw.id_ktgwarna') // Group hanya berdasarkan kategori warna
            ->get();

        
        $recomendations = DB::table('produk as pd')
            ->join('warna as w', 'pd.kode_warna', '=', 'w.kode_warna')
            ->join('harga as h', function ($join) {
                $join->on('pd.id_kategori', '=', 'h.id_kategori')
                    ->on('pd.id_etalase', '=', 'h.id_etalase')
                    ->on('pd.id_ktgwarna', '=', 'h.id_ktgwarna');
            })
            ->select(
                'pd.id_produk',
                'pd.nama_produk',
                'pd.image_produk',
                'pd.slug_produk',
                'pd.id_kategori',
                'pd.id_etalase',
                'pd.etalase',
                'h.harga_roll as harga_terendah',
                'h.harga_ecer as harga_tertinggi', // Ambil harga roll individual
                'h.id_ktgwarna', // Pastikan harga sesuai dengan id_ktgwarna
                DB::raw('GROUP_CONCAT(DISTINCT w.nama_warna) as nama_warna'),
                DB::raw('GROUP_CONCAT(DISTINCT w.hex_color) as hex_color'),
                DB::raw('GROUP_CONCAT(DISTINCT w.pantone_color) as pantone_color')
            )
            ->where('pd.id_kategori', 1)
            ->groupBy(
                'pd.id_produk',
                'pd.nama_produk',
                'pd.image_produk',
                'pd.slug_produk',
                'pd.id_kategori',
                'pd.id_etalase',
                'pd.etalase',
                'h.harga_roll', // Tambahkan harga roll ke group by
                'h.harga_ecer',
                'h.id_ktgwarna' // Tambahkan id_ktgwarna ke group by
            )
            ->inRandomOrder()
            ->take(5)
            ->get();
        // dd($product);
        // Jika kategori yang dipilih bukan SEMUA
        $selectedColorCategory = request()->input('id_ktgwarna', null); 

        //opsi ketebalan kain yang tersedian dg warna yang sama dan ketegori yang sama
        $opsi_etalase = DB::table('produk as pd')
        ->join('warna as wk', 'pd.kode_warna', '=', 'wk.kode_warna')
            ->where('pd.id_kategori', $product->id_kategori)
            ->where('wk.hex_color', $product->hex_color)
            ->pluck('pd.etalase') // Get the thicknesses
            ->unique() // Ensure uniqueness
            ->values(); // Reset keys
        
        // Filter active and inactive colors
        $activeColors = $warna->filter(function ($itemwarna) use ($product) {
            return $itemwarna->hex_color === $product->hex_color;
        });

        $inactiveColors = $warna->filter(function ($itemwarna) use ($product) {
            return $itemwarna->hex_color !== $product->hex_color;
        });

       $keywords = "Bahan kaos " . $category->nama_kategori . " " . $product->etalase;
        $warnaList = [];

        foreach ($recomendations as $w) {
            if (isset($w->nama_warna)) {
                $warnaList[] = "Bahan kaos " . $category->nama_kategori . " " . $product->etalase . " " . $w->nama_warna; // Tambahkan nama warna ke dalam array
            }
        }


        // Gabungkan nama-nama warna dengan koma (atau karakter pemisah lain yang Anda inginkan)
        $warnaString = implode(', ', $warnaList);

        // Gabungkan semua elemen ke dalam keywords
        $finalKeywords = $keywords . " " . $warnaString;


        $otherColor = [];
        foreach ($recomendations as $rec) {
            if (isset($rec->nama_warna)) {
                $otherColor[] = "Kain kaos " . $category->nama_kategori . " " . $rec->etalase . " " . $rec->nama_warna; // Tambahkan nama warna ke dalam array
            }
        }
        $recColor = implode(', ', $otherColor);
        $group_etalase= DB::table('produk as pd')
        ->join('warna as wk', 'pd.kode_warna', '=', 'wk.kode_warna')
            ->where('pd.id_kategori', $product->id_kategori)
            ->where('wk.hex_color', $product->hex_color)
            ->pluck('pd.etalase') // Get the thicknesses
            ->unique() // Ensure uniqueness
            ->values(); // Reset keys
        
        $settingServer = Setting::where('setting_name', 'is_price')->first();
        $isCheckout = Setting::where('setting_name', 'is_checkout')->first();
        $totalItems = 0;
        $meta = new MetaTag([
            'title' => "Jual" . $category->nama_kategori  . " " . $product->etalase . " " . $product->nama_warna . " - Sakura Sandang",
            'description' => "Toko Bahan Kaos Sakura Sandang menawarkan bahan kaos " . $category->nama_kategori  . " " . $product->etalase . " " . $product->nama_warna . " dengan kualitas premium. Cocok untuk pembuatan kaos berkualitas tinggi. Pesan sekarang.",
            'keywords' => $finalKeywords,
            'og_title' => "Jual " . $category->nama_kategori . " " . $product->etalase . " " . $product->nama_warna . " ( " . $product->pantone_color . " ) - Altratex Group",
            'og_image' => isset($images[0]) ? "img/product/" . $images[0]->src_image : "img/share-azolatekno.jpg",
            'og_description' => "Toko Bahan Kaos Sakura Sandang menyediakan Bahan Kaos " . $category->nama_kategori . " " . $product->etalase . " " . $product->nama_warna . " terbaik dan juga produk lainnya seperti " . $recColor
        ]);
        
        $etalase = $product->etalase;
        $tipe_kategori = $category->tipe_kategori;
        $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
        return view('product-detail', compact('product', 'category', 'etalase',  'activeColors', 'inactiveColors', 'opsi_etalase', 'warna', 'ktgwarna', 'recomendations', 'tipe_kategori', 'meta', 'settingServer', 'isCheckout', 'images', 'aboutEtalase', 'group_etalase', 'footerCategory'));
    
}

public function shop()
{
   $kategoriUtama = DB::table('kategori as k')
        ->join('kategori_utama as ku', 'k.id_ukategori', '=', 'ku.id_ukategori')
        ->join('kategori_tipe as kt', 'k.kode_ktgtipe', '=', 'kt.kode_ktgtipe')
        ->select('ku.kategori_utama', 'k.nama_kategori', 'k.img_kategori', 'k.deskripsi_kategori', 'kt.tipe_kategori', 'k.slug_kategori')
        ->where('k.is_active', 'Y')
        ->orderBy('ku.no_urut', 'asc')  // Urutkan berdasarkan id_ukategori
        ->orderBy('k.id_kategori', 'asc')    // Tambahkan urutan berdasarkan id_kategori
        ->get();
    
    $meta = MetaTag::where('page', 'shop')->first();
   $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
    $settingServer = Setting::where('setting_name', 'is_price')->first();
    $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
    return view('shop', compact('kategoriUtama', 'meta', 'settingServer', 'footerCategory', 'customHead'));
}
public function contactUs()
{
    $meta = new MetaTag([
    'title' => "Azolatekno | Jasa Web Design, SEO Google & AI",
    'description' => "Azolatekno adalah penyedia jasa web design modern, SEO berbasis Google & AI, serta optimasi digital untuk meningkatkan ranking website bisnis Anda.",
    'keywords' => "Azolatekno, jasa web design, SEO Google, SEO AI, optimasi website, digital marketing, jasa SEO, web development",
    'og_title' => "Azolatekno | Web Design & SEO untuk Google & AI Ranking",
    'og_image' => 'img/share-azolatekno.jpg',
    'og_description' => "Layanan Web Design, SEO Google & AI dari Azolatekno untuk membantu website bisnis Anda tampil optimal dan mendapatkan ranking terbaik."
]);
    $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
    $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
    return view('contact-us', compact('meta',  'footerCategory', 'customHead'));
}
public function aboutUs()
{
    $meta = MetaTag::where('page', 'about-us')->first();
    $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
    $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
    return view('about-us', compact('meta', 'footerCategory', 'customHead'));
}

public function clients()
{
    $meta = MetaTag::where('page', 'klien-kami')->first() ?? new MetaTag([
        'title' => 'Klien Kami - Bisnis yang Sudah Dibantu Azolatekno',
        'description' => 'Lihat daftar klien yang sudah dibantu Azolatekno mewujudkan solusi digital, mulai dari website company profile hingga sistem informasi produk.',
        'keywords' => 'klien azolatekno, portofolio azolatekno, klien jasa website, studi kasus website',
        'og_title' => 'Klien Kami - Azolatekno',
        'og_description' => 'Bisnis dari berbagai sektor yang sudah dibantu Azolatekno mewujudkan solusi digitalnya.',
        'og_image' => 'img/default-og-image.jpg',
    ]);

    $clients = config('clients.list');

    $footerCategory = Cache::remember('footerCategory', 30 * 60, function () {
        return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
    });
    $customHead = Cache::remember('customHead', 30 * 60, function () {
        return CustomContent::select('page_name', 'slug_content')->get();
    });

    return view('klien-kami', compact('meta', 'clients', 'footerCategory', 'customHead'));
}

public function pricelist2()
{
    $pricelists = Harga::with(['etalaseKategori', 'kategori', 'kategoriWarna'])
    ->get()
    ->groupBy(function($price) {
        return $price->kategori->nama_kategori; // Mengelompokkan berdasarkan nama kategori
    });
    $category = Kategori::where('is_active', 'Y')->get();
    // dd($category);
    $meta = new MetaTag([
    'title' => "Pricelist Kain Kaos | Sakura Sandang Solo",
    'description' => "Lihat daftar harga terbaru kain kaos berkualitas yang tersedia di Toko Kain Kaos Sakura Sandang Solo.",
    'keywords' => "pricelist kain kaos,daftar harga, harga kain kaos, pricelist, Sakura Sandang, Sakura Sandang Solo",
    'og_title' => "Pricelist Kain Kaos | Sakura Sandang Solo",
    'og_image' => 'img/share-azolatekno.jpg',
    'og_description' => "Dapatkan informasi daftar harga terkini untuk kain kaos berkualitas dari Toko Kain Kaos Sakura Sandang."
]);

    $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
    $settingServer = Setting::where('setting_name', 'is_price')->first();
    $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
    return view('pricelist', compact('meta', 'category', 'pricelists', 'footerCategory', 'settingServer', 'customHead'));
}
public function katalog()
{
    $meta = new MetaTag([
    'title' => "Katalog Kain Kaos - Combed, PE, dan Banyak Lagi  | Sakura Sandang Solo",
    'description' => "Katalog lengkap kain kaos berkualitas seperti Cotton Combed 24s, Cotton Combed 30s, Cotton Carded, PE , dan TC Combed di Toko Kain Kaos Sakura Sandang Solo.",
    'keywords' => "katalog produk, kain kaos, katalog kain, Sakura Sandang, Sakura Sandang Solo",
    'og_title' => "Katalog Produk | Sakura Sandang Solo",
    'og_image' => 'img/share-azolatekno.jpg',
    'og_description' => "Katalog lengkap kain kaos berkualitas seperti Cotton Combed 24s, Cotton Combed 30s, Cotton Carded, PE, dan TC Combed di Toko Kain Kaos Sakura Sandang Solo.",
]);

  $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
  $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
    return view('catalog', compact( 'meta','footerCategory', 'customHead'));
}

public function privacy()
{
    $meta = MetaTag::where('page', 'privacy-policy')->first();
   $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
   $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
    return view('privacy-policy', compact( 'meta', 'footerCategory', 'customHead'));
}
public function terms()
{
    $meta = MetaTag::where('page', 'terms-conditions')->first();
   $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
   $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
    return view('terms-conditions', compact( 'meta', 'footerCategory', 'customHead'));
}
public function returnpolicy()
{
    $meta = new MetaTag([
     'title' => "Kebijakan Pengembalian Barang | Sakura Sandang Solo",
    'description' => "Pelajari kebijakan pengembalian barang kami untuk memastikan pengalaman belanja Anda nyaman di Toko Kain Kaos Sakura Sandang.",
    'keywords' => "kebijakan pengembalian, pengembalian barang, retur barang, jaminan belanja, Sakura Sandang",
    'og_title' => "Kebijakan Pengembalian Barang | Sakura Sandang Solo",
    'og_image' => 'img/share-azolatekno.jpg',
    'og_description' => "Informasi lengkap tentang kebijakan pengembalian barang kami untuk memastikan kepuasan pelanggan di Toko Kain Kaos Sakura Sandang."
]);
   $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
            });
$customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
    return view('return-policy', compact( 'meta', 'footerCategory', 'customHead'));
}
public function license()
{
    $meta = MetaTag::where('page', 'license-info')->first();
   $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
   $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
    return view('license-info', compact( 'meta', 'footerCategory', 'customHead'));
}

public function stores()
{
    $meta = new MetaTag([
    'title' => "Toko Bahan Kaos di Solo, Jogja, Semarang, Jakarta, Cirebon, dan Bali | Toko Kain Sakura",
    'description' => "Cari bahan kaos terbaik? Sakura Sandang hadir di Solo, Jogja, Semarang, Jakarta, Cirebon, dan Bali. Temukan kain berkualitas tinggi untuk kebutuhan Anda.",
    'keywords' => "toko bahan kaos Solo, toko bahan kaos Jogja, toko bahan kaos Semarang, toko bahan kaos Jakarta, toko bahan kaos Cirebon, toko bahan kaos Bali",
    'og_title' => "Toko Bahan Kaos di Solo, Jogja, Semarang, Jakarta, Cirebon, dan Bali | Sakura Sandang",
    'og_image' => 'img/share-azolatekno.jpg',
    'og_description' => "Sakura Sandang menyediakan bahan kaos berkualitas di 6 lokasi strategis: Solo, Jogja, Semarang, Jakarta, Cirebon, dan Bali. Kunjungi toko kami untuk berbagai pilihan kain.",
]);
   $stores = Toko::all();
   $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
   $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
    return view('store', compact( 'meta', 'stores', 'footerCategory', 'customHead'));
}

    public function customPage($slug_content)
    {
        // Ambil data konten berdasarkan slug
        $konten = Cache::remember("konten2_{$slug_content}", 30 * 60, function () use ($slug_content) {
            return CustomContent::select('id_content', 'judul', 'img_small', 'img_content', 'short_desc', 'keyword', 'isi', 'slug_content', 'updated_at', 'page_name')
                ->where('slug_content', $slug_content)
                ->first();
        });
        
        if (!$konten) {
            abort(404);
        }
        
        $meta = Cache::remember("meta_{$slug_content}", 30 * 60, function () use ($konten) {
            return new MetaTag([
                'title' => $konten->judul,
                'description' => $konten->short_desc,
                'keywords' => $konten->keyword,
                'og_title' => $konten->judul,
                'og_image' => 'img/content/' . $konten->img_content,
                'og_description' => $konten->short_desc,
            ]);
        });
        
        $products = Cache::remember("produk_index", 30 * 60, function () {
            return Produk::select('kode_produk','slug_produk','image_produk','nama_produk','spesifikasi','updated_at')
                ->with(['harga:id_harga,kode_produk,harga,diskon'])
                ->get();
        });

        // Cache kategori produk di footer selama 30 menit
        $footerCategory = Cache::remember('footerCategory', 30 * 60, function () {
            return Produk::select('nama_produk', 'slug_produk')
                ->where('is_available', 'Y')
                ->get();
        });

        // Cek apakah kategori konten mengandung kata "promo"
        if (str_contains(strtolower($konten->kategori_konten), 'promo')) {
            return view('promo', compact('meta', 'footerCategory', 'konten', 'products'));
        }
        $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
        // Jika bukan promo, tetap tampilkan di custom-content.blade.php
        return view('custom-content', compact('meta', 'footerCategory', 'konten', 'products', 'customHead'));
    }
    
     public function indexRanking()
    {
        // Cache kategori produk di footer selama 30 menit
        $footerCategory = Cache::remember('footerCategory', 30 * 60, function () {
            return Produk::select('nama_produk', 'slug_produk')
                ->where('is_available', 'Y')
                ->get();
        });
        $meta = new MetaTag([
            'title' => "Google Ranking Checker dan Cek Kompetitor Ranking Gratis",
            'description' => "Gunakan Google Ranking Checker untuk memantau posisi website Anda dan kompetitor di hasil pencarian Google. Masukkan keyword dan domain, lalu lihat ranking secara real-time.",
            'keywords' => "google ranking checker, cek ranking website, cek posisi google, seo tools indonesia, monitoring kompetitor",
            'og_title' => "Google Ranking Checker â€“ Pantau Posisi Website di Google",
            'og_image' => asset('img/tools/google-ranking-checker.png'),
            'og_description' => "Tool gratis untuk cek posisi website dan kompetitor di hasil pencarian Google. Mudah digunakan, cepat, dan akurat.",
        ]);
        $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
        return view('ranking-checker', compact('meta', 'footerCategory', 'customHead'));
    }

 public function checkRanking(Request $request)
    {
        $request->validate([
            'keywords' => 'required|string',
            'domains'  => 'required|string',
        ]);

        $keywords = array_filter(array_map('trim', explode("\n", $request->keywords)));
        $domains  = array_filter(array_map('trim', explode("\n", $request->domains)));

        // API key & CX dari Google Programmable Search (buat di https://programmablesearchengine.google.com/)
        $apiKey = env('GOOGLE_API_KEY');
        $cx     = env('GOOGLE_CX_ID');

        $results = [];

        foreach ($keywords as $keyword) {
            foreach ($domains as $domain) {
                $rank = null;
                $foundUrl = null;
        
                // Cek 10 halaman (max 100 result)
                for ($start = 1; $start <= 91; $start += 10) {
                    $response = Http::get("https://www.googleapis.com/customsearch/v1", [
                        'key'    => $apiKey,
                        'cx'     => $cx,
                        'q'      => $keyword,
                        'start'  => $start,
                        'gl'     => 'id',   // ðŸ”¹ target Indonesia
                        'hl'     => 'id',   // ðŸ”¹ bahasa Indonesia
                    ]);
        
                    if ($response->failed()) {
                        continue;
                    }
        
                    $items = $response->json('items', []);
                    foreach ($items as $index => $item) {
                        if (strpos($item['link'], $domain) !== false) {
                            $rank = $start + $index;
                            $foundUrl = $item['link'];
                            break 2;
                        }
                    }
                }
        
                $results[] = [
                    'keyword' => $keyword,
                    'domain'  => $domain,
                    'rank'    => $rank,
                    'url'     => $foundUrl,
                ];
            }
        }
                $meta = new MetaTag([
            'title' => "Google Ranking Checker dan Cek Kompetitor Ranking Gratis",
            'description' => "Gunakan Google Ranking Checker untuk memantau posisi website Anda dan kompetitor di hasil pencarian Google. Masukkan keyword dan domain, lalu lihat ranking secara real-time.",
            'keywords' => "google ranking checker, cek ranking website, cek posisi google, seo tools indonesia, monitoring kompetitor",
            'og_title' => "Google Ranking Checker â€“ Pantau Posisi Website di Google",
            'og_image' => asset('img/tools/google-ranking-checker.png'),
            'og_description' => "Tool gratis untuk cek posisi website dan kompetitor di hasil pencarian Google. Mudah digunakan, cepat, dan akurat.",
        ]);
        // Cache kategori produk di footer selama 30 menit
        $footerCategory = Cache::remember('footerCategory', 30 * 60, function () {
            return Produk::select('nama_produk', 'slug_produk')
                ->where('is_available', 'Y')
                ->get();
        });

        $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });

        return view('ranking-checker', compact('results', 'keywords', 'domains', 'meta', 'footerCategory', 'customHead'));
    }
    public function checkRanking_OLD_API_GOOGLE(Request $request)
    {
        $request->validate([
            'keywords' => 'required|string',
            'domains'  => 'required|string',
        ]);

        $keywords = array_filter(array_map('trim', explode("\n", $request->keywords)));
        $domains  = array_filter(array_map('trim', explode("\n", $request->domains)));

        // API key & CX dari Google Programmable Search (buat di https://programmablesearchengine.google.com/)
        $apiKey = env('GOOGLE_API_KEY');
        $cx     = env('GOOGLE_CX_ID');

        $results = [];

        foreach ($keywords as $keyword) {
            foreach ($domains as $domain) {
                $rank = null;
                $foundUrl = null;
        
                // ambil 100 hasil langsung
                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Linux; Android 10; Pixel 3 XL) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Mobile Safari/537.36'
                ])->get("https://www.google.com/search", [
                    'q'   => $keyword,
                    'gl'  => 'id',   // lokasi Indonesia
                    'hl'  => 'id',   // bahasa Indonesia
                    'num' => 100,    // ambil 100 result
                    'pws' => 0,      // disable personalisasi
                ]);
        
                if ($response->failed()) {
                    continue;
                }
        
                $html = $response->body();
        
                // regex sederhana ambil semua hasil link
                preg_match_all('/<a href="\/url\?q=(.*?)&amp;/', $html, $matches);
                $links = $matches[1] ?? [];
        
                foreach ($links as $index => $link) {
                    if (strpos($link, $domain) !== false) {
                        $rank = $index + 1; // posisi real di SERP
                        $foundUrl = $link;
                        break;
                    }
                }
        
                $results[] = [
                    'keyword' => $keyword,
                    'domain'  => $domain,
                    'rank'    => $rank,
                    'url'     => $foundUrl,
                ];
            }
        }
                $meta = new MetaTag([
            'title' => "Google Ranking Checker dan Cek Kompetitor Ranking Gratis",
            'description' => "Gunakan Google Ranking Checker untuk memantau posisi website Anda dan kompetitor di hasil pencarian Google. Masukkan keyword dan domain, lalu lihat ranking secara real-time.",
            'keywords' => "google ranking checker, cek ranking website, cek posisi google, seo tools indonesia, monitoring kompetitor",
            'og_title' => "Google Ranking Checker â€“ Pantau Posisi Website di Google",
            'og_image' => asset('img/tools/google-ranking-checker.png'),
            'og_description' => "Tool gratis untuk cek posisi website dan kompetitor di hasil pencarian Google. Mudah digunakan, cepat, dan akurat.",
        ]);
        // Cache kategori produk di footer selama 30 menit
        $footerCategory = Cache::remember('footerCategory', 30 * 60, function () {
            return Produk::select('nama_produk', 'slug_produk')
                ->where('is_available', 'Y')
                ->get();
        });

        $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });

        return view('ranking-checker', compact('results', 'keywords', 'domains', 'meta', 'footerCategory', 'customHead'));
    }
    
    public function indexInvoice()
    {
        $meta = new MetaTag([
            'title' => 'Invoice Generator Online Gratis – Buat Invoice PDF Tanpa Daftar | AzolaTekno',
            'description' => 'Invoice generator online gratis dari AzolaTekno. Buat invoice profesional langsung download PDF, tanpa registrasi. Cocok untuk UMKM, freelancer, dan bisnis di Indonesia.',
            'keywords' => 'invoice generator online gratis, buat invoice online, invoice pdf generator, invoice maker indonesia, azolatekno',
            'og_title' => "Invoice Generator Online Gratis – Buat Invoice PDF Tanpa Daftar | AzolaTekno",
            'og_image' => 'img/share-azolatekno.jpg',
            'og_description' => "Buat invoice profesional secara online dengan Invoice Generator AzolaTekno. Gratis, mudah digunakan, dan cocok untuk UMKM, freelancer, hingga bisnis besar.",
        ]);
        // Cache kategori produk di footer selama 30 menit
        $footerCategory = Cache::remember('footerCategory', 30 * 60, function () {
            return Produk::select('nama_produk', 'slug_produk')
                ->where('is_available', 'Y')
                ->get();
        });
    
        $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
        // $products = Produk::with(['harga'])->get();
        return view('invoice-generator', compact('meta', 'footerCategory',  'customHead'));
    }

    public function generateInvoice(Request $request)
{
    try {
        Log::info('📥 Invoice request masuk', $request->all());

        $data = $request->validate([
            'from'               => 'required|string',
            'to'                 => 'required|string',
            'invoice_no'         => 'required|string',
            'date'               => 'required|date',
            'due_date'           => 'nullable|date',
            'items'              => 'required|array',
            'items.*.desc'       => 'required|string',
            'items.*.qty'        => 'required|integer|min:1',
            'items.*.unit'       => 'required|string',
            'items.*.unit_price' => 'required|numeric|min:0',
            'ppn'                => 'nullable|numeric|min:0',
            'no_ppn'             => 'nullable|boolean',
            'dp'                 => 'nullable|numeric|min:0',
            'logo'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'rekening'           => 'required|string',
        ]);

        if ($request->hasFile('logo')) {
            $filename = time() . '-' . preg_replace(
                '/[^A-Za-z0-9._-]/',
                '_',
                $request->file('logo')->getClientOriginalName()
            );

            Storage::disk('public_invoice')->putFileAs('', $request->file('logo'), $filename);

            $data['logo_path'] = Storage::disk('public_invoice')->path($filename);
            $data['logo_url'] = Storage::disk('public_invoice')->url($filename);
            
            Log::info("✅ Logo tersimpan: {$data['logo_path']}");
        } else {
            $data['logo_path'] = null;
            $data['logo_url'] = null;
        }

        $subtotal = collect($data['items'])->sum(fn($i) => $i['qty'] * $i['unit_price']);
        $ppnRate  = $request->no_ppn ? 0 : ($request->ppn ?? 11);
        $ppnValue = ($subtotal * $ppnRate) / 100;
        $total    = $subtotal + $ppnValue;
        $dp       = (float)($request->dp ?? 0);
        $sisa     = $total - $dp;

        if ($sisa < 0) {
            $sisa = 0;
        }

        Log::info("💰 Subtotal: {$subtotal}, PPN: {$ppnValue}, Total: {$total}, DP: {$dp}, Sisa: {$sisa}");

        if ($request->has('preview')) {
            Log::info('👀 Preview mode aktif');
            return view('invoice-preview', compact('data', 'subtotal', 'ppnRate', 'ppnValue', 'total', 'dp', 'sisa'));
        }

        $invoiceSafe = preg_replace('/[^A-Za-z0-9_\-]/', '_', $data['invoice_no']);

        Log::info("📄 Generate PDF untuk invoice: {$invoiceSafe}");

        try {
            // ✅ Generate PDF dengan error handling
            $pdf = \PDF::loadView('invoice-pdf', compact('data', 'subtotal', 'ppnRate', 'ppnValue', 'total', 'dp', 'sisa'));
            $pdf->setOptions([
                'isRemoteEnabled' => true,
                'isPhpEnabled' => true,
                'defaultFont' => 'Helvetica',
            ]);

            Log::info("✅ PDF generated successfully");

            return $pdf->download("Invoice-{$invoiceSafe}.pdf");

        } catch (\Exception $pdfError) {
            Log::error("❌ Dompdf Error: " . $pdfError->getMessage());
            Log::error("Dompdf Trace: " . $pdfError->getTraceAsString());
            return back()->with('error', 'Gagal generate PDF: ' . $pdfError->getMessage());
        }

    } catch (\Exception $e) {
        Log::error("❌ Error generate invoice: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        return back()->with('error', 'Gagal membuat invoice: ' . $e->getMessage());
    }
}
    public function tools()
    {
        $meta = new MetaTag([
            'title' => "Kumpulan Tools Online Gratis untuk Bisnis dan UMKM – AzolaTekno",
            'description' => "Nikmati kumpulan tools online gratis dari AzolaTekno untuk mendukung bisnis dan UMKM. Tanpa daftar, tanpa iklan, langsung bisa digunakan dengan mudah.",
            'keywords' => "tools online gratis, tools bisnis UMKM, aplikasi gratis online, tools produktivitas, azolatekno, alat online UMKM",
            'og_title' => "Kumpulan Tools Online Gratis untuk Bisnis dan UMKM",
            'og_image' => 'img/share-azolatekno.jpg',
            'og_description' => "Koleksi tools online gratis dari AzolaTekno untuk bisnis dan UMKM. Praktis, tanpa harus daftar, tanpa iklan, langsung pakai!",
        ]);
        // Cache kategori produk di footer selama 30 menit
        $footerCategory = Cache::remember('footerCategory', 30 * 60, function () {
            return Produk::select('nama_produk', 'slug_produk')
                ->where('is_available', 'Y')
                ->get();
        });
    
        $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
        // $products = Produk::with(['harga'])->get();
        return view('tools', compact('meta', 'footerCategory',  'customHead'));
    }
    
    public function indexHpp()
    {
        $meta = new MetaTag([
            'title' => "Kalkulator HPP Online Gratis AzolaTekno - Hitung Harga Pokok Mudah",
            'description' => "Gunakan Kalkulator HPP online gratis dari AzolaTekno untuk hitung harga pokok penjualan/produksi berbagai jenis usaha.",
            'keywords' => "kalkulator HPP, hitung HPP online, harga pokok penjualan, harga pokok produksi, HPP dagang, HPP jasa, HPP pabrik, HPP UMKM, azolatekno",
            'og_title' => "Kalkulator HPP Online Gratis AzolaTekno",
            'og_image' => 'img/share-azolatekno.jpg',
            'og_description' => "Hitung harga pokok penjualan/produksi secara instan dengan Kalkulator HPP AzolaTekno. Cocok untuk usaha dagang, jasa, hingga produsen/pabrik. Gratis dan mudah digunakan.",
        ]);
        // Cache kategori produk di footer selama 30 menit
        $footerCategory = Cache::remember('footerCategory', 30 * 60, function () {
            return Produk::select('nama_produk', 'slug_produk')
                ->where('is_available', 'Y')
                ->get();
        });
    
        $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
        // $products = Produk::with(['harga'])->get();
        return view('kalkulator-hpp', compact('meta', 'footerCategory',  'customHead'));
    }
    
    public function calculateHpp(Request $request)
    {
        // Validasi dasar
        $validated = $request->validate([
            'business_type' => 'required|string',
            'costs.*.desc'  => 'required|string',
            'costs.*.amount'=> 'required|numeric|min:0',
            'total_units'   => 'required|numeric|min:1',
            'margin'        => 'required|numeric|min:0',
        ]);

        // Biaya umum dari input dinamis
        $costs = collect($request->costs)->map(function ($item) {
            return [
                'desc'   => $item['desc'],
                'amount' => (float) $item['amount'],
            ];
        });

        $totalBiayaUmum = $costs->sum('amount');

        // Biaya tambahan pabrik (jika dipilih)
        $extraPabrik = collect();
        if ($request->business_type === 'pabrik') {
            $extraPabrik->push([
                'desc'   => 'Biaya Penyusutan Mesin',
                'amount' => (float) ($request->machine_depreciation ?? 0),
            ]);
            $extraPabrik->push([
                'desc'   => 'Biaya Maintenance Mesin',
                'amount' => (float) ($request->machine_maintenance ?? 0),
            ]);
            $extraPabrik->push([
                'desc'   => 'Biaya Energi (Listrik/Gas/Solar)',
                'amount' => (float) ($request->energy_cost ?? 0),
            ]);
        }

        $totalExtraPabrik = $extraPabrik->sum('amount');

        // Total semua biaya
        $totalProduksi = $totalBiayaUmum + $totalExtraPabrik;

        // Hitung HPP
        $hppPerUnit = $totalProduksi / $validated['total_units'];

        // Hitung harga jual dengan margin
        $hargaJual = $hppPerUnit + ($hppPerUnit * $validated['margin'] / 100);

        // Simpan hasil breakdown
        $breakdown = $costs->merge($extraPabrik);

        return back()->with('hasil', [
            'business_type'  => $validated['business_type'],
            'breakdown'      => $breakdown,
            'total_produksi' => $totalProduksi,
            'hpp_per_unit'   => $hppPerUnit,
            'harga_jual'     => $hargaJual,
            'total_units'    => $validated['total_units'],
            'margin'         => $validated['margin'],
        ]);
    }
    
    public function indexPenawaran()
    {
        $meta = new MetaTag([
            'title' => "Quotation & Penawaran Harga Online Gratis PDF – AzolaTekno",
            'description' => "Buat penawaran harga (quotation) profesional secara online dan gratis di AzolaTekno. Praktis, bisa langsung unduh PDF, cocok untuk UMKM, startup, dan bisnis modern.",
            'keywords' => "penawaran harga online, buat penawaran online, penawaran online gratis, quotation generator, buat quotation pdf, quotation gratis, generator penawaran harga, buat penawaran bisnis, azolatekno",
            'og_title' => "Quotation & Penawaran Harga Online Gratis – AzolaTekno",
            'og_image' => 'img/share-azolatekno.jpg',
            'og_description' => "Buat penawaran harga (quotation) online gratis dengan format PDF profesional. Mudah dipakai, tanpa daftar, cocok untuk UMKM & bisnis.",
        ]);
        $footerCategory = Cache::remember('footerCategory', 30 * 60, function () {
            return Produk::select('nama_produk', 'slug_produk')
                ->where('is_available', 'Y')
                ->get();
        });
    
        $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
           
            
        return view('tools.quotation-form', compact('meta', 'footerCategory',  'customHead'));
    }

    public function generatePenawaran(Request $request)
{
    $data = $request->validate([
        'from' => 'required|string',
        'to' => 'required|string',
        'quotation_no' => 'required|string',
        'date' => 'required|date',
        'items' => 'required|array',
        'items.*.desc' => 'required|string',
        'items.*.qty' => 'required|numeric',
        'items.*.unit' => 'nullable|string',
        'items.*.unit_price' => 'required|numeric',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // Hitung subtotal
    $subtotal = collect($data['items'])->sum(function ($item) {
        return $item['qty'] * $item['unit_price'];
    });

    $ppnRate = $request->input('ppn_rate', 0);
    $ppnValue = $ppnRate > 0 ? ($subtotal * $ppnRate / 100) : 0;
    $total = $subtotal + $ppnValue;

    // Convert logo ke base64 agar bisa dibaca DomPDF tanpa simpan file permanen
    $logoBase64 = null;
    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $mime = $file->getMimeType();
        $logoBase64 = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
    }

    $pdf = Pdf::loadView('tools.quotation-pdf', [
        'data' => $data,
        'subtotal' => $subtotal,
        'ppnRate' => $ppnRate,
        'ppnValue' => $ppnValue,
        'total' => $total,
        'logoBase64' => $logoBase64,
    ]);

    // Bersihkan quotation_no agar aman untuk nama file
    $safeQuotationNo = preg_replace('/[\/\\\\]/', '-', $data['quotation_no']);

    return $pdf->download("Quotation-{$safeQuotationNo}.pdf");
}
    
    public function indexStruk()
    {
        $meta = new MetaTag([
            'title' => "Struk Online Generator Gratis – Cetak Struk Instan | AzolaTekno",
            'description' => "Buat dan cetak struk online gratis langsung dari browser Anda. Pilih ukuran 58mm atau 80mm. Praktis untuk UMKM, toko, dan kasir online.",
            'keywords' => "struk online, buat struk gratis, generator struk, struk pdf, print struk bluetooth, cetak struk 58mm, cetak struk 80mm, struk toko online, kasir online, azolatekno",
            'og_title' => "Struk Online Generator Gratis – AzolaTekno",
            'og_image' => 'img/share-azolatekno.jpg',
            'og_description' => "Buat struk penjualan profesional secara online, gratis, dan siap cetak via Bluetooth printer. Cocok untuk UMKM dan bisnis retail modern.",
        ]);
        $footerCategory = Cache::remember('footerCategory', 30 * 60, function () {
            return Produk::select('nama_produk', 'slug_produk')
                ->where('is_available', 'Y')
                ->get();
        });
        $products = Cache::remember("produk_index", 30 * 60, function () {
            return Produk::select('kode_produk','slug_produk','image_produk','nama_produk','spesifikasi','updated_at')
                ->with(['harga:id_harga,kode_produk,harga,diskon'])
                ->get();
        });
        $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
           
        return view('tools.struk-generator', compact('meta', 'footerCategory',  'customHead', 'products'));
    }

    public function generatePdfStruk(Request $request)
    {
        
        $data = $request->validate([
            'store_name'     => 'required|string|max:255',
            'store_address'  => 'required|string',
            'items'          => 'required|array|min:1',
            'items.*.name'   => 'required|string',
            'items.*.qty'    => 'required|numeric|min:1',
            'items.*.price'  => 'required|numeric|min:0',
            'use_ppn'        => 'nullable|boolean', // apakah PPN digunakan
            'ppn_value'      => 'nullable|numeric|min:0|max:100', // persentase PPN
            'paper_size'     => 'nullable|string|in:58,80',
        ]);
            \Log::info('=== Debug Struk Generator Request ===', [
            'validated_data' => $data,
            'use_ppn_checkbox' => $request->boolean('use_ppn'),
            'raw_request' => $request->all(),
        ]);
        // Hitung subtotal
        $subtotal = collect($data['items'])->sum(fn($i) => $i['qty'] * $i['price']);
    
        // Cek apakah PPN digunakan
        $usePpn = $request->boolean('use_ppn');
        $ppnValue = $usePpn ? ($data['ppn_value'] ?? 10) : 0;
        $ppnAmount = $usePpn ? $subtotal * ($ppnValue / 100) : 0;
    
        // Total keseluruhan
        $total = $subtotal + $ppnAmount;
    
        // Render PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('tools.struk-pdf', [
            'data'       => $data,
            'subtotal'   => $subtotal,
            'use_ppn'    => $usePpn,
            'ppn_value'  => $ppnValue,
            'ppn_amount' => $ppnAmount,
            'total'      => $total,
        ]);
    
        // Tentukan ukuran kertas thermal (1 mm ≈ 2.83465 pt)
        $width = ($data['paper_size'] ?? '58') == '80' ? 80 : 58;
        $height = 500 + count($data['items']) * 25; // tinggi menyesuaikan jumlah item
    
        $pdf->setPaper([0, 0, $width * 2.83465, $height], 'portrait');
    
        // Nama file rapi
        $filename = 'Struk-' . str_replace(' ', '_', $data['store_name']) . '.pdf';
    
        return $pdf->download($filename);
    }

    public function printRawbt(Request $request)
    {
        $text = "=== {$request->store_name} ===\n";
        $text .= "{$request->store_address}\n\n";
        foreach ($request->items as $item) {
            $lineTotal = $item['qty'] * $item['price'];
            $text .= "{$item['name']} x{$item['qty']}  Rp" . number_format($lineTotal, 0, ',', '.') . "\n";
        }
        $text .= "---------------------------\n";
        $text .= "TOTAL: Rp" . number_format(array_sum(array_map(fn($i) => $i['qty'] * $i['price'], $request->items)), 0, ',', '.') . "\n";
        $text .= "Terima kasih!\n";

        $encoded = urlencode($text);
        return redirect("intent://print/?text={$encoded}#Intent;scheme=rawbt;package=ru.a402d.rawbtprinter;end");
    }

}