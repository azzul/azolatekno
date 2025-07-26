@push('scripts')
<script>
    const head = document.getElementsByTagName('head')[0];
    const isMobile = window.innerWidth <= 768;

    const preloadImage = (src) => {
        const link = document.createElement('link');
        link.rel = 'preload';
        link.as = 'image';
        link.href = src;
        head.appendChild(link);
    };

    // Preload sesuai device
    if (isMobile) {
        preloadImage('{{ asset("img/hafes-width-small.webp") }}');
    } else {
        preloadImage('{{ asset("img/hafes-width.webp") }}');
    }
</script>
@endpush
<header id="header2">
    <div class="header-container-home" >
      <div id="logo2" class="pull-left">
        <a href="{{ route('home') }}" class="scrollto" title="Logo Hafes Rental">
            <picture>
                <!-- Logo khusus mobile -->
                <source media="(max-width: 768px)" srcset="{{ asset('img/hafes-width-small.webp') }}">
                <!-- Logo default (desktop) -->
                <source media="(min-width: 769px)" srcset="{{ asset('img/hafes-width.webp') }}">
                <!-- Fallback -->
                <img src="{{ asset('img/Hafes-width-original.webp') }}" alt="Logo Hafes Rental" loading="lazy">
            </picture>
        </a>
    </div>


    <nav id="nav-menu-container">
            <ul class="nav-menu">
              <li class="menu-active"><a href="{{ url('/') }}">BERANDA</a></li>
              <li><a href="{{ url('/armada') }}">ARMADA KAMI</a></li>
               <li><a href="{{ url('/about-us') }}">
                           TENTANG KAMI
                        </a></li>
             <li><a href="{{ url('/testimonial') }}">TESTIMONIAL</a></li>
             <li><a href="{{ url('/artikel') }}">ARTIKEL</a></li>
            <li class="dropdown">
                    <a href="javascript:void(0);" class="dropbtn" aria-label="dropdown opsi informasi">INFORMASI <i class="fa fa-chevron-down"></i></a>
                    <ul class="dropdown-content">
                        
                        <li><a href="{{ url('/contact-us') }}">
                            KONTAK KAMI
                        </a></li>
                         @foreach($customHead as $headCustom)
                           <li><a href="{{ url('/' .$headCustom->slug_content) }}" style="text-transform: uppercase !important;">
                            {{ capitalizeWordsFromUppercase($headCustom->page_name)}}
                            </a></li>
                        @endforeach
                    </ul>
                </li>

            </ul>
          </nav>

    </div>


  </header><!-- #header -->
