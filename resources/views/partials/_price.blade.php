
<div class="product-price-detail"
@if($settingServer->status === 'N') 
                                     style="display:none !important;" 
                                 @else 
                                     style="display:block !important;" 
                                 @endif>
    <h5 class="harga-roll" data-roll="{{$harga_roll}}">Rp {{ format_rupiah_tanpa_simbol($harga_roll) }}<span class="unit"> /kg (Bruto)</span>
    <p class="pl-0 w-500 mbottom-0">*Min. Order 1 roll ( &plusmn; 25 kg)</p>
</div>

<div class="price-cards"
@if($settingServer->status === 'N') 
                                     style="display:none !important;" 
                                 @else 
                                     style="display:flex !important;" 
                                 @endif>
     <div class="price-card" style="display: none;">
        <p class="harga-grosir" data-grosir="{{$harga_grosir}}"><strong>Rp {{ format_rupiah_tanpa_simbol($harga_grosir) }}</strong></p>
        <p>Harga > 5kg</p>
    </div> 
    <div class="price-card">
        <p class="harga-ecer" data-ecer="{{$harga_ecer}}"><strong>Rp {{ format_rupiah_tanpa_simbol($harga_ecer) }}</strong></p>
        <p>Harga Ecer / Kg</p>
    </div>
</div>
<div id="harga_roll_ref" data-roll-ref="{{$harga_roll_ref}}" style="display: none;"></div>
<div id="harga_grosir_ref" data-grosir-ref="{{$harga_grosir_ref}}" style="display:none;"></div>
<div id="harga_ecer_ref" data-ecer-ref="{{$harga_ecer_ref}}" style="display:none;"></div>