<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Spatie\ResponseCache\Middlewares\DoNotCacheResponse;

class CacheResponse
{
    public function handle($request, Closure $next)
    {
        // Hanya cache untuk GET request
        if (! $request->isMethod('GET')) {
            return $next($request);
        }

        // Halaman dengan form + token CSRF di meta tag (mis. tools/struk-online-generator)
        // tidak boleh di-cache: kalau di-cache, semua pengunjung dapat HTML yang sama
        // persis termasuk token CSRF milik sesi pengunjung PERTAMA — pengunjung lain
        // akan gagal submit form (419 Page Expired) karena token tidak cocok dengan
        // sesi mereka sendiri. Route yang butuh ini ditandai middleware DoNotCacheResponse.
        $route = $request->route();
        if ($route && in_array(DoNotCacheResponse::class, $route->gatherMiddleware())) {
            return $next($request);
        }

        $key = 'response|' . $request->fullUrl();

        // Cek apakah ada di cache
        if (Cache::has($key)) {
            return response(Cache::get($key));
        }

        $response = $next($request);

        // Simpan ke cache (misalnya 1 jam)
        Cache::put($key, $response->getContent(), now()->addHour());

        return $response;
    }
}