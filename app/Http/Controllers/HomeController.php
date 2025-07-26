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
        
        $meta = MetaTag::where('page', 'index')->first();

        $mainContent = Konten::where('nama_konten', 'home_main')->first();
        $products = Produk::with(['harga' => function ($query) {
            $query->where('kode_jharga', '12JAMSPR');
        }])->with('harga.jenisHarga')->get();
        //dd($products);
        
     $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
     $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
        return view('index', compact('meta', 'mainContent', 'footerCategory', 'products', 'customHead'));
    }

    public function model()
    {
        
        $meta = MetaTag::where('page', 'model')->first();

        
       $products = Produk::with(['harga' => function ($query) {
            $query->where('kode_jharga', '12JAMSPR');
        }])->with('harga.jenisHarga')->get();
        
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
        $product = Produk::with([
            'harga' => function ($query) {
                $query->where('kode_jharga', '12JAMSPR')
                      ->with('jenisHarga');
            }
        ])->where('slug_produk', $slug_produk)->first(); 

        $meta = new MetaTag([
            'title' => "$product->nama_produk JAKARTA MULAI Rp 500 RIBU - Hafes RENTAL CAR",
            'description' => "Hanya di Hafes Rent Car $product->nama_produk dengan harga rental paling terjangkau, pelayanan ramah, Dan Fleksibel",
            'keywords' => "$product->nama, $product->nama Murah, $product->nama Terdekat ",
            'og_title' => "$product->nama_produk PALING TERJANGKAU- Hafes RENT CAR",
            'og_image' => "img/product/" . $product->image_produk,
            'og_description' => "Hanya di Hafes Rent Car $product->nama_produk dengan harga paling terjangkau, pelayanan ramah, Dan Fleksibel"
        ]);

        
        
        $recomendations = Produk::with([
            'harga' => function ($query) {
                $query->where('kode_jharga', '12JAMSPR')
                      ->with('jenisHarga');
            }
        ])->get(); 
     $footerCategory = Cache::remember('footerCategory', 30 * 60, function() {
            return Produk::select('nama_produk', 'slug_produk')->where('is_available', 'Y')->get();
        });
     $customHead = Cache::remember('customHead', 30 * 60, function() {
            return CustomContent::select('page_name', 'slug_content')->get();
            });
    // dd($latestProducts);
        return view('model-detail', compact('meta',  'footerCategory', 'product', 'recomendations', 'customHead'));
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
            'og_image' => isset($images[0]) ? "img/product/" . $images[0]->src_image : "img/share_sakura.jpg",
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
    'title' => "Kontak Toko Kain Kaos | Sakura Sandang Solo",
    'description' => "Temukan cara untuk menghubungi Toko Kain Kaos Sakura Sandang untuk pertanyaan, dukungan, atau informasi lebih lanjut.",
    'keywords' => "toko kain kaos,kontak toko kain kaos, kontak Sakura Sandang, customer service, bantuan, Sakura Sandang Solo",
    'og_title' => "Kontak Toko Kain Kaos | Sakura Sandang Solo",
    'og_image' => 'img/share_sakura.jpg',
    'og_description' => "Hubungi Toko Kain Kaos Sakura Sandang untuk segala kebutuhan kain kaos dan informasi lainnya."
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
    'og_image' => 'img/share_sakura.jpg',
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
    'og_image' => 'img/share_sakura.jpg',
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
    'og_image' => 'img/share_sakura.jpg',
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
    'og_image' => 'img/share_sakura.jpg',
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
        $konten = CustomContent::where('slug_content', $slug_content)->first();

        // Jika tidak ditemukan, lempar ke halaman 404
        if (!$konten) {
            abort(404);
        }

        // Buat objek MetaTag untuk SEO
        $meta = new MetaTag([
            'title' => $konten->judul,
            'description' => $konten->short_desc,
            'keywords' => $konten->keyword,
            'og_title' => $konten->judul,
            'og_image' => 'img/content/' . $konten->img_content,
            'og_description' => $konten->short_desc,
        ]);

        // Ambil semua produk
        $products = Produk::get();

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
}