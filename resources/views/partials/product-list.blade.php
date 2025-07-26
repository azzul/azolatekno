@foreach ($products as $product)
        <!-- Display detailed products as before -->
        <div class="product-card-detail">
            
                @if (!empty($product->total)) 
                <img src="{{ asset('img/etalase/' . $product->img_etalase) }}" alt="{{ $product->nama_kategori }} {{ $product->etalase }}">
            <div class="product-card-content-category">
                            <p class="text-center pleft-0 mbottom-10 main-red w-600">{{ $product->total }} varian produk</p>
                            <h3 class="product-card-title-category mtop-0 pt-0 mleft-0 mright-0 pl-0 pr-0">{{ $product->nama_kategori }} {{ $product->etalase }}</h3>
                 <!-- Menampilkan warna produk -->
                            <div class="product-colors">
                                @php
                                    // Ambil warna dari produk (misalnya $product->colors berisi daftar warna)
                                    $colors = explode(',', $product->hex_color); // Asumsi warna disimpan sebagai string yang dipisah koma
                                @endphp
                                
                                <!-- Tampilkan maksimal 5 warna -->
                                <div class="circle-color-flex">
                                @foreach (array_slice($colors, 0, 5) as $color)
                                    <span class="color-circle" style="background-color: {{ $color }};"></span>
                                @endforeach
                                </div>
                                <!-- Jika ada lebih dari 5 warna, tampilkan tombol untuk warna lain -->
                                @if (count($colors) > 5)
                                    <button class="more-colors-btn">{{ count($colors) - 5 }} warna lainnya  <i class="fas fa-palette"></i></button>
                                @endif

                            </div>

                            <div class="product-price text-center dblock"
                            @if($settingServer->status === 'N') 
                                     style="display:none !important;" 
                                 @else 
                                     style="display:block !important;" 
                                 @endif>
                                           Rp {{ format_rupiah_tanpa_simbol($product->harga_terendah) }} - 
                                            Rp {{ format_rupiah_tanpa_simbol($product->harga_tertinggi) }} /kg (Roll)
                                        </div>
                            <div class="product-buttons">
                                            <a class="btn buy-btn" href="{{ url('/shop/'.$tipe_kategori .'/'.$category->slug_kategori. '/' . $product->etalase) }}">PILIH</a>
                                            <!-- <button class="btn sample-btn">Sample Gratis</button> -->
                                        </div>
                    </div>
                 @else
                  <div class="product-color-info-top">
                                    <span class="color-bullet" style="background-color: {{ $product->hex_color }};"></span>
                                    <span>{{ $product->pantone_color }}</span>
                                </div>
                 <img src="{{ asset('img/product/' . $product->image_produk) }}" alt="{{ $product->nama_produk }}">
            <div class="product-card-content-category">
                <h3 class="product-card-title-category product-card-title mtop-10 pt-0 mleft-0 mright-0 pl-0 pr-0">{{ $product->nama_produk }}</h3>
                               
                <div class="product-price text-center dblock  w-500" 
                @if($settingServer->status === 'N') 
                                     style="display:none !important;" 
                                 @else 
                                     style="display:block !important;" 
                                 @endif>
            
                                Rp {{ format_rupiah_tanpa_simbol($product->harga_terendah) }} - 
                                            Rp {{ format_rupiah_tanpa_simbol($product->harga_tertinggi) }} /kg (Roll)

                            </div>
                <div class="product-buttons">
                                <a class="btn buy-btn" href="{{ url('/shop/'. $product->slug_produk) }}">PILIH</a>
                                <!-- <button class="btn sample-btn">Sample Gratis</button> -->
                            </div>
                            </div>
                @endif
            
        </div>
@endforeach