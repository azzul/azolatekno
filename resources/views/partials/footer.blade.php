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
                <source media="(max-width: 768px)" srcset="{{ asset('img/azolatekno-width-small.webp') }}">
                <!-- Logo default (desktop) -->
                <source media="(min-width: 769px)" srcset="{{ asset('img/azolatekno-width-small.webp') }}">
                <!-- Fallback -->
                <img src="{{ asset('img/azolatekno-width-small.webp') }}" alt="Logo Azolatekno Web SEO AI" width="400"
  height="120"
  style="max-width: 200px; height: auto; aspect-ratio: 400/120; display: block;"
  loading="lazy" 
  >
            </picture>
            <div class="footer-contact">
            <p>Dalon, RT 03 RW 04 Sroyo, Kec. Jaten, Kab. Karanganyar, Jawa tengah 57731<br>
              <strong>Telepon :</strong> 087733930143<br>
              <strong>Whatsapp :</strong> 087733930143<br>
            </p>
            

            </div>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Tentang Azolatekno</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="{{ url('/') }}">Beranda</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="{{ url('/about-us') }}">Tentang Kami</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="{{ url('/layanan') }}">Layanan Kami</a></li>
              
            </ul>
          </div>


          <div class="col-lg-3 col-md-6 footer-links">
    <h4>Layanan Kami</h4>
    <ul>
    @foreach($footerCategory as $categoryFooter)
        <li>
            <i class="fa fa-angle-right"></i>

            <a href="{{ url('/layanan/' . $categoryFooter->slug_produk )}}">
                {{$categoryFooter->nama_produk}}
            </a>
        </li>
    @endforeach
    @foreach($customHead as $headCustom)
        <li>
            <i class="fa fa-angle-right"></i>
            <a href="{{ url('/' .$headCustom->slug_content) }}">
                            {{ capitalizeWordsFromUppercase($headCustom->page_name)}}
            </a>
        </li>
    @endforeach
</ul>
</div>
          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Informasi</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="https://wa.me/6287733930143?text=Halo%20Admin%20Azolatekno%20Saya%20mau%20tanya%20cara%20psan%20layanan%20digital%20yang%20ada%20di%20website.%20Saya%20dapat%20info%20dari%20https:/azolatekno.com" target="_blank" rel="nofollow noopener noreferrer">Cara Pesan</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="{{ url('/privacy-policy') }}">Kebijakan Privasi & cookie</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="{{ url('/terms-conditions') }}">Syarat Dan Ketentuan</a></li>
                <li><i class="fa fa-angle-right"></i> <a href="{{ url('/license-info') }}">Informasi Lisensi</a></li>
             <li><i class="fa fa-angle-right"></i> <a href="{{ url('/tools') }}">Tools Online Gratis</a></li>
             <li><i class="fa fa-angle-right"></i> <a href="{{ url('/tools/invoice-generator-online-gratis-pdf') }}">Buat Invoice Online Gratis</a></li>
             <li><i class="fa fa-angle-right"></i> <a href="{{ url('/tools/hpp-calculator-online') }}">Hitung HPP Online Gratis</a></li>
             <li><i class="fa fa-angle-right"></i> <a href="{{ url('/tools/quotation-penawaran-harga-online-gratis') }}">Buat Penawaran Online Gratis</a></li>
             <li><i class="fa fa-angle-right"></i> <a href="{{ url('/tools/struk-online-generator') }}">Struk Online Generator</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

    
      <div class="copyright">
        &copy; Copyright <strong>Azolatekno</strong>. All Rights Reserved
      </div>
      <div class="credits">Designed by <a href="https://azolatekno.com"><strong>azolatekno.com</strong></a>
      </div>
<!-- <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a> -->
<a href="#" class="whatsapp-icon" id="whatsappIcon">
    <i class="fab fa-whatsapp"></i>
</a>

  </footer><!-- #footer -->


  <div class="bottom-navbar">
  <a href="{{ url('/') }}" >
    <i class="fa-solid fa-home"></i>
    Beranda
  </a>
  <div class="divider"></div>
  <a href="{{ url('/testimonial') }}">
    <i class="fas fa-star"></i>
    Testimoni
  </a>
  <div class="divider"></div>
  <a href="{{ url('/layanan') }}">
    <i class="fas fa-computer"></i>
    Layanan
  </a>
  <div class="divider"></div>
  <a href="#" class="bottom-navbar-whatsapp" id="whatsappBottom">
    <i class="fa-brands fa-whatsapp"></i>
    Whatsapp
  </a>


  