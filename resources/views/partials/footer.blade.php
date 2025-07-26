<div id="cookie-popup" class="cookie-popup hidden">
    <p class="cookie-text">
        Situs ini menggunakan cookie untuk meningkatkan pengalaman Anda. Dengan melanjutkan menggunakan situs, Anda menyetujui penggunaan cookie. 
        <a href="{{url('/privacy-policy')}}" class="cookie-link">Baca Kebijakan Privasi kami</a>.
    </p>
    <button id="accept-cookie" class="cookie-btn">Terima</button>
</div>

<footer id="footer">
  <div class="width_100 bg_image1" >
    <div class="footer-top">
    
      <div class="custom-container" style="padding-top: 0 !important;">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
           <picture>
                <!-- Logo khusus mobile -->
                <source media="(max-width: 768px)" srcset="{{ asset('img/hafes-width-small.webp') }}">
                <!-- Logo default (desktop) -->
                <source media="(min-width: 769px)" srcset="{{ asset('img/hafes-width-small.webp') }}">
                <!-- Fallback -->
                <img src="{{ asset('img/hafes-width-small.webp') }}" alt="Logo Hafes Rental" loading="lazy">
            </picture>
            <div class="footer-contact">
            <p>Ruko NEO Fierra, Jl. AMD No.33 No C-07, Pd. Kacang Bar., Kec. Pd. Aren, Kota Tangerang Selatan, Banten 15226 <br>
              <strong>Telepon :</strong> 0811-9162-842<br>
              <strong>Whatsapp :</strong> 0821-2542-3807<br>
            </p>
            

            </div>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Tentang Hafes Rent Car</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="{{ url('/') }}">Beranda</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="{{ url('/about-us') }}">Tentang Kami</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="{{ url('/armada') }}">Armada Kami</a></li>
              
            </ul>
          </div>


          <div class="col-lg-3 col-md-6 footer-links">
    <h4>Paket Rental Mobil</h4>
    <ul>
    @foreach($footerCategory as $categoryFooter)
        <li>
            <i class="fa fa-angle-right"></i>

            <a href="{{ url('/armada/' . $categoryFooter->slug_produk )}}">
                {{$categoryFooter->nama_produk}}
            </a>
        </li>
    @endforeach
</ul>
</div>
          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Informasi</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="https://wa.me/6282125423807?text=Halo%20Admin%20Hafes%20Rent%20Saya%20mau%20tanya%20cara%20sewa%20mobil%20yang%20ada%20di%20website.%20Saya%20dapat%20info%20dari%20https:/Hafesrentcar.id" target="_blank" rel="nofollow noopener noreferrer">Cara Pesan</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="{{ url('/privacy-policy') }}">Kebijakan Privasi & cookie</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="{{ url('/terms-conditions') }}">Syarat Dan Ketentuan</a></li>
                <li><i class="fa fa-angle-right"></i> <a href="{{ url('/license-info') }}">Informasi Lisensi</a></li>
                <li><i class="fa fa-angle-right"></i> <a href="https://merpati-trans.id">Rekanan</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

    
      <div class="copyright">
        &copy; Copyright <strong>PT Hafes Megah Lestari</strong>. All Rights Reserved
      </div>
      <div class="credits">Designed by Azolatekno For <a href="https://hafesrentcar.id"><strong>hafesrentcar.id</strong></a>
      </div>
<!-- <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a> -->
<a href="#" class="whatsapp-icon" id="whatsappIcon">
    <i class="fab fa-whatsapp"></i>
</a>

<div class="whatsapp-options" style="display: none;">
   <!--  <div class="whatsapp-option"><i class="fab fa-whatsapp"></i><p data-number="6281390095758">Marketing Kain area Jatim & Bali</p></div>
     <div class="whatsapp-option"><i class="fab fa-whatsapp"></i><p data-number="6281328379339">Marketing Kain area Jawa Tengah</p></div>
     <div class="whatsapp-option"><i class="fab fa-whatsapp"></i><p data-number="6281393734535">Marketing Kain area Jabodetabek</p></div>
     <div class="whatsapp-option"><i class="fab fa-whatsapp"></i><p data-number="6281393734535">Marketing Kain area Jabar</p></div> -->
     <div class="whatsapp-option"><i class="fab fa-whatsapp"></i><p data-number="6282125423807">Marketing Kain, Makloon & Printing</p></div>
     <div class="whatsapp-option"><i class="fab fa-whatsapp"></i><p data-number="6282125423807">Marketing Plastik Opp</p></div>
</div>
  </footer><!-- #footer -->


  <div class="bottom-navbar">
  <a href="{{ url('/') }}" >
    <i class="fa-solid fa-home"></i>
    Beranda
  </a>
  <div class="divider"></div>
  <a href="{{ url('/artikel') }}">
    <i class="fas fa-book"></i>
    Artikel
  </a>
  <div class="divider"></div>
  <a href="{{ url('/armada') }}">
    <i class="fas fa-car"></i>
    Armada
  </a>
  <div class="divider"></div>
  <a href="#" class="bottom-navbar-whatsapp" id="whatsappBottom">
    <i class="fa-brands fa-whatsapp"></i>
    Whatsapp
  </a>


  