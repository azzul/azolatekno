
<header id="header">
    <div class="header-container-home" >
      <div id="logo" class="pull-left">
        <a href="{{ route('home') }}" class="scrollto" title="Logo Azolatekno Web SEO AI">
            <picture>
                <!-- Logo khusus mobile -->
                <source media="(max-width: 768px)" srcset="{{ asset('img/azolatekno-width-white-mobile.webp') }}">
                <!-- Logo default (desktop) -->
                <source media="(min-width: 769px)" srcset="{{ asset('img/azolatekno-width-white.webp') }}">
                <!-- Fallback -->
                <img src="{{ asset('img/azolatekno-width.webp') }}" alt="Logo Azolatekno Web SEO AI" loading="lazy">
            </picture>
        </a>
    </div>


    <nav id="nav-menu-container">
            <ul class="nav-menu">
              <li class="menu-active"><a href="{{ url('/') }}">BERANDA</a></li>
              <li><a href="{{ url('/layanan') }}">LAYANAN KAMI</a></li>
              <li><a href="{{ url('/about-us') }}">
                           TENTANG KAMI
                        </a></li>
             <li><a href="{{ url('/testimonial') }}">TESTIMONIAL</a></li>
             <li><a href="{{ url('/artikel/') }}/">ARTIKEL</a></li>
            <li class="dropdown">
                <a href="#" class="dropbtn" onclick="return false;" aria-label="dropdown opsi informasi">
                    INFORMASI <i class="fa fa-chevron-down"></i>
                </a>
                <ul class="dropdown-content">
                    <li><a href="{{ url('/contact-us') }}">KONTAK KAMI</a></li>
                    <li><a href="{{ url('/tools') }}">TOOLS ONLINE GRATIS</a></li>
                    <li><a href="{{ url('/tools/invoice-generator-online-gratis-pdf') }}">INVOICE GENERATOR ONLINE GRATIS</a></li>
                    <li><a href="{{ url('/tools/hpp-calculator-online') }}">HPP KALKULATOR ONLINE GRATIS</a></li>
                    <li><a href="{{ url('/tools/quotation-penawaran-harga-online-gratis') }}">BUAT PENAWARAN ONLINE</a></li>
                    <li><a href="{{ url('/tools/struk-online-generator') }}">BUAT STRUK ONLINE</a></li>
                </ul>
            </li>
            </ul>
          </nav>

    </div>


  </header><!-- #header -->
