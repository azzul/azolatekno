{{-- resources/views/partials/color_options.blade.php --}}
{{-- Menampilkan warna aktif terlebih dahulu --}}
@foreach ($activeColors as $itemwarna)
    <div class="color-option-detail {{ $loop->first ? 'active' : '' }}" data-slug="{{ $itemwarna->slug_produk }}" data-hex="{{ $itemwarna->hex_color }}" data-color="{{ $itemwarna->nama_warna }}">
        <div class="color-option-circle" style="background-color: {{ $itemwarna->hex_color }};" 
            data-name="{{ $itemwarna->nama_warna }}">
            <div class="tooltip-color">{{ $itemwarna->nama_warna }}</div>
        </div>
        <div class="color-desc" @if (!$loop->first) style="display: none !important;" @endif>{{ $itemwarna->nama_warna }}</div>
    </div>
@endforeach
{{-- Menampilkan warna tidak aktif --}}
@foreach ($inactiveColors->take(5) as $itemwarna)
    <div class="color-option-detail" data-slug="{{ $itemwarna->slug_produk }}" data-hex="{{ $itemwarna->hex_color }}" data-color="{{ $itemwarna->nama_warna }}">
        <div class="color-option-circle" style="background-color: {{ $itemwarna->hex_color }};" data-name="{{ $itemwarna->nama_warna }}">
            <div class="tooltip-color">{{ $itemwarna->nama_warna }}</div>
        </div>
        <div class="color-desc " style="display: none !important;">{{ $itemwarna->nama_warna }} </div>
    </div>
@endforeach
