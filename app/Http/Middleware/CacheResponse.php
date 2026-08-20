<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class CacheResponse
{
    public function handle($request, Closure $next)
    {
        // Hanya cache untuk GET request
        if (! $request->isMethod('GET')) {
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