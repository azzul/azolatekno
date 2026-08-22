@extends('layouts.app')

@push('json-ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}" },
    { "@type": "ListItem", "position": 2, "name": "Daftar Harga", "item": "{{ url('/pricelist') }}" }
  ]
}
</script>
@endpush

@section('content')

<section class="relative overflow-hidden bg-ink-950 pb-24 pt-36 sm:pb-28 sm:pt-44">
    <div class="pointer-events-none absolute inset-0 bg-brand-gradient opacity-[0.85]"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.07]" style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:26px 26px;"></div>

    <div class="container-app relative">
        <nav class="text-sm text-white/70">
            <a href="{{ url('/') }}" class="hover:text-white">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-white">Daftar Harga</span>
        </nav>

        <div class="mx-auto mt-6 max-w-2xl text-center">
            <span class="eyebrow bg-white/10 text-white ring-1 ring-white/25">Daftar Harga</span>
            <h1 class="mt-5 text-4xl font-semibold text-white sm:text-5xl">{{ $meta->title ?? 'Daftar Harga Layanan' }}</h1>
            @if (!empty($meta->description))
                <p class="mx-auto mt-5 max-w-xl text-white/80">{{ $meta->description }}</p>
            @endif
            <a href="{{ route('pricelist.pdf') }}" target="_blank" class="btn-ghost-light mt-8">
                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none"><path d="M10 3v10m0 0l-4-4m4 4l4-4M4 16h12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Download Pricelist PDF
            </a>
        </div>
    </div>
</section>

<section class="container-app py-20 sm:py-24">
    <div class="reveal overflow-hidden rounded-3xl border border-ink-100 shadow-soft">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-ink-50">
                    <tr class="text-xs font-semibold uppercase tracking-wider text-ink-500">
                        <th class="px-6 py-4">Layanan</th>
                        <th class="px-6 py-4">Harga</th>
                        <th class="px-6 py-4">Keterangan</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-100">
                    @foreach ($prices as $price)
                        <tr class="hover:bg-ink-50/60">
                            <td class="flex items-center gap-3 px-6 py-4">
                                @if ($price->produk)
                                    <div class="h-12 w-12 shrink-0 overflow-hidden rounded-xl">
                                        <x-product-image :product="$price->produk" class="h-full w-full object-cover" />
                                    </div>
                                @endif
                                <span class="font-medium text-ink-900">{{ $price->produk->nama_produk ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-brand-700">Rp {{ number_format($price->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-ink-500">{{ $price->produk->short_desc ?? '-' }}</td>
                            <td class="px-6 py-4 text-right">
                                @if ($price->produk)
                                    <a href="{{ url('/layanan/' . $price->produk->slug_produk) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-brand-700 hover:text-brand-800">
                                        Detail
                                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="none"><path d="M5 10h10M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <p class="reveal mt-4 text-center text-xs text-ink-400">* Klik tombol download di atas untuk mengunduh pricelist dalam format PDF.</p>
</section>

@endsection
