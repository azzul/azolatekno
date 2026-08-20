<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SitemapController;
use Spatie\ResponseCache\Middlewares\CacheResponse;
use Spatie\ResponseCache\Middlewares\DoNotCacheResponse;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/layanan', [HomeController::class, 'model'])->name('layanan');
Route::get('/layanan/{slug_produk}', [HomeController::class, 'modelDetail'])->name('layanan.detail');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about');
Route::get('/klien-kami', [HomeController::class, 'clients'])->name('clients');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact');
Route::get('/pricelist', [HomeController::class, 'pricelist'])->name('pricelist');
Route::get('/pricelist-pdf', [HomeController::class, 'pricelistPdf'])
    ->name('pricelist.pdf')
    ->middleware(DoNotCacheResponse::class); // <- ini
Route::get('/testimonial', [HomeController::class, 'testimonial'])->name('testimonial');
Route::get('/terms-conditions', [HomeController::class, 'terms'])->name('terms');
Route::get('/privacy-policy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/license-info', [HomeController::class, 'license'])->name('license-info');
Route::get('/tools', [HomeController::class, 'tools'])->name('tools');
//SITEMAP
Route::get('/sitemap', [SitemapController::class, 'generate'])->name('sitemap');

Route::get('/tools/invoice-generator-online-gratis-pdf', [HomeController::class, 'indexInvoice'])->name('invoice.index');

Route::post('/tools/invoice-generator-online-gratis-pdf', [HomeController::class, 'generateInvoice'])->name('invoice.generate');
Route::get('/tools/hpp-calculator-online', [HomeController::class, 'indexHpp'])->name('hpp.index');
Route::post('/tools/hpp-calculator-online', [HomeController::class, 'calculateHpp'])->name('hpp.calculate');


// Route::get('/tools/quotation-penawaran-harga-online-gratis', function () {
//     return 'sukses';
// })->name('quotation.index');
Route::get('/tools/quotation-penawaran-harga-online-gratis', [HomeController::class, 'indexPenawaran'])->name('quotation.index');
Route::post('/tools/quotation-penawaran-harga-online-gratis', [HomeController::class, 'generatePenawaran'])->name('quotation.generate');

Route::get('/tools/struk-online-generator', [HomeController::class, 'indexStruk'])->name('struk.index');
// Generate PDF
Route::post('/tools/struk-online-generator/pdf', [HomeController::class, 'generatePdfStruk'])->name('struk.pdf');
// Print via RawBT (Bluetooth)
Route::post('/tools/struk-online-generator/print', [HomeController::class, 'printRawbt'])->name('struk.print');


Route::get('/{slug_content}', [HomeController::class, 'customPage'])
    ->where('slug_content', '^(?!layanan|about-us|contact-us|testimonial|terms-conditions|privacy-policy|return-policy|license-info|sitemap|tools|klien-kami|sitemap).*$')
    ->name('custom');