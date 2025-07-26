
document.addEventListener('DOMContentLoaded', function () {
  // 1. Clone Navigation
  const originalNav = document.querySelector('#nav-menu-container');
  if (originalNav) {
    const mobileNav = originalNav.cloneNode(true);
    mobileNav.id = 'mobile-nav';
    const ul = mobileNav.querySelector('ul');
    if (ul) {
      ul.removeAttribute('class');
      ul.removeAttribute('id');
    }
    document.body.appendChild(mobileNav);

    const toggleButton = document.createElement('button');
    toggleButton.type = 'button';
    toggleButton.id = 'mobile-nav-toggle';
    toggleButton.setAttribute('aria-label', 'Open navigation menu');
    toggleButton.innerHTML = '<i class="fa fa-bars"></i>';
    document.body.prepend(toggleButton);

    const overlay = document.createElement('div');
    overlay.id = 'mobile-body-overly';
    document.body.appendChild(overlay);

    // Tambahkan toggle submenu icon
    const menuParents = document.querySelectorAll('#mobile-nav .menu-has-children');
    menuParents.forEach(parent => {
      const icon = document.createElement('i');
      icon.className = 'fa fa-chevron-down';
      parent.insertBefore(icon, parent.firstChild);
    });
  } else if (document.querySelector("#mobile-nav") || document.querySelector("#mobile-nav-toggle")) {
    const el1 = document.querySelector("#mobile-nav");
    const el2 = document.querySelector("#mobile-nav-toggle");
    if (el1) el1.style.display = "none";
    if (el2) el2.style.display = "none";
  }

  // 2. Toggle Submenu and Mobile Nav
  document.addEventListener('click', function (e) {
    const target = e.target;

    // submenu toggle
    if (target.matches('.menu-has-children i')) {
      const next = target.nextElementSibling;
      if (next) next.classList.toggle('menu-item-active');
      const ul = target.parentElement.querySelector('ul');
      if (ul) ul.style.display = ul.style.display === 'block' ? 'none' : 'block';
      target.classList.toggle('fa-chevron-up');
      target.classList.toggle('fa-chevron-down');
    }
window.addEventListener('scroll', function () {
  // Mengambil posisi scroll secara vertikal
  var scrollPosition = window.scrollY || document.documentElement.scrollTop;

  var header = document.getElementById('header');
  if (!header) return;

  // Tambah/hapus class 'scrolled' berdasarkan posisi scroll
  if (scrollPosition > 50) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
});
    // mobile nav toggle
    if (target.closest('#mobile-nav-toggle')) {
      document.body.classList.toggle('mobile-nav-active');
      const icon = document.querySelector('#mobile-nav-toggle i');
      if (icon) {
        icon.classList.toggle('fa-times');
        icon.classList.toggle('fa-bars');
      }
      const overlay = document.getElementById('mobile-body-overly');
      if (overlay) {
        overlay.style.display = overlay.style.display === 'block' ? 'none' : 'block';
      }
    }

    // click outside mobile nav
    const mobileNav = document.getElementById('mobile-nav');
    const navToggle = document.getElementById('mobile-nav-toggle');
    if (
      mobileNav &&
      navToggle &&
      !mobileNav.contains(target) &&
      !navToggle.contains(target) &&
      document.body.classList.contains('mobile-nav-active')
    ) {
      document.body.classList.remove('mobile-nav-active');
      const icon = document.querySelector('#mobile-nav-toggle i');
      if (icon) {
        icon.classList.toggle('fa-times');
        icon.classList.toggle('fa-bars');
      }
      const overlay = document.getElementById('mobile-body-overly');
      if (overlay) overlay.style.display = 'none';
    }

    // dropdown user profile
    if (!target.closest('.user-dropdown')) {
      const dropdown = document.querySelector('.dropdown-menu-profile');
      if (dropdown) dropdown.style.display = 'none';
    }

    // dropdown bahasa mobile
    if (!target.closest('.icon-language')) {
      const dropdown = document.getElementById('customLanguageDropdown');
      if (dropdown) dropdown.style.display = 'none';
    }

    if (!target.closest('.icon-login')) {
      const dropdown = document.querySelector('.dropdown-menu-profile-mobile');
      if (dropdown) dropdown.style.display = 'none';
    }
  });

  // 3. Menu Aktif LocalStorage
  const activeMenu = localStorage.getItem('activeMenu') || '';
  const navLinks = document.querySelectorAll('.nav-menu li');
  navLinks.forEach(li => li.classList.remove('menu-active'));
  if (activeMenu) {
    const activeLink = document.querySelector('.nav-menu li a[href="' + activeMenu + '"]');
    if (activeLink) activeLink.parentElement.classList.add('menu-active');
  }
  if (window.location.pathname === '/') {
    navLinks.forEach(li => li.classList.remove('menu-active'));
    const homeLink = document.querySelector('.nav-menu li a[href="/"]');
    if (homeLink) {
      homeLink.parentElement.classList.add('menu-active');
      localStorage.setItem('activeMenu', '/');
    }
  }
  document.querySelectorAll('.nav-menu li a').forEach(link => {
    link.addEventListener('click', function () {
      navLinks.forEach(li => li.classList.remove('menu-active'));
      this.parentElement.classList.add('menu-active');
      localStorage.setItem('activeMenu', this.href);
    });
  });

  // 4. Dropdown toggle
  const avatar = document.getElementById('user-avatar');
  if (avatar) {
    avatar.addEventListener('click', function (e) {
      e.preventDefault();
      const dropdown = document.querySelector('.dropdown-menu-profile');
      if (dropdown) dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });
  }
  const languageToggle = document.getElementById('customLanguageDropdownToggle');
  if (languageToggle) {
    languageToggle.addEventListener('click', function (e) {
      e.stopPropagation();
      const dropdown = document.getElementById('customLanguageDropdown');
      if (dropdown) dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });
  }
  document.querySelectorAll('.dropdown-toggle').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      const dropdown = this.nextElementSibling;
      if (dropdown && dropdown.classList.contains('dropdown-language')) {
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
      }
    });
  });
  document.querySelectorAll('.dropdown-toggle-login').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      const dropdown = this.nextElementSibling;
      if (dropdown && dropdown.classList.contains('dropdown-menu-profile-mobile')) {
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
      }
    });
  });

  // 5. Logout Handler
  const logoutLinks = document.querySelectorAll('.logout-link');
  logoutLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const form = document.getElementById('logout-form');
      if (form) form.submit();
    });
  });

  // 6. Disable Right Click on Image
  document.querySelectorAll('img').forEach(img => {
    img.addEventListener('contextmenu', function (e) {
      e.preventDefault();
    });
  });
});
