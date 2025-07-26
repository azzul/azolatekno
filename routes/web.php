<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SitemapController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/armada', [HomeController::class, 'model'])->name('armada');
Route::get('/armada/{slug_produk}', [HomeController::class, 'modelDetail'])->name('armada.detail');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact');
Route::get('/pricelist', [HomeController::class, 'pricelist'])->name('pricelist');
Route::get('/testimonial', [HomeController::class, 'testimonial'])->name('testimonial');
Route::get('/terms-conditions', [HomeController::class, 'terms'])->name('terms');
Route::get('/privacy-policy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/license-info', [HomeController::class, 'license'])->name('license-info');
//SITEMAP
Route::get('/sitemap', [SitemapController::class, 'generate']);

Route::get('/{slug_content}', [HomeController::class, 'customPage'])
    ->where('slug_content', '^(?!armada|about-us|contact-us|pricelist|testimonial|terms-conditions|privacy-policy|return-policy|license-info|sitemap).*$')
    ->name('custom');