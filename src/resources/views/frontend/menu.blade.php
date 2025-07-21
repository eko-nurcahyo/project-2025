<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="">
  <title>Feane</title>
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" />
  <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" />
</head>
<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="{{ asset('assets/images/hero-bg.jpg') }}" alt="">
    </div>
    <!-- header section starts -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="{{ url('/') }}">
            <span>Feane</span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class=""> </span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto ">
              <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
              <li class="nav-item active"><a class="nav-link" href="{{ url('/menu') }}">Menu <span class="sr-only">(current)</span></a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/book') }}">Book Table</a></li>
            </ul>
            <div class="user_option">
              <a href="#" class="user_link"><i class="fa fa-user" aria-hidden="true"></i></a>
              <a class="cart_link" href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart"></i></a>
              <form class="form-inline">
                <button class="btn my-2 my-sm-0 nav_search-btn" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </form>
              <div class="dropdown d-inline-block">
                <a class="btn order_online dropdown-toggle" href="#" id="orderOnlineDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Order Online
                </a>
                <div class="dropdown-menu" aria-labelledby="orderOnlineDropdown">
                  <a class="dropdown-item" href="https://gofood.co.id/jakarta/restaurant/kebab-ngajubi-citraraya-d5d4dd73-7146-4e5b-b149-9b403e313ced" target="_blank">Pesan via GoFood</a>
                  <a class="dropdown-item" href="https://food.grab.com/id/en/restaurant/kebab-ngajubi-citraraya-delivery/6-C3YVHN4WJTR3N6" target="_blank">Pesan via GrabFood</a>
                  <a class="dropdown-item" href="https://shopee.co.id/universal-link/now-food/shop/6705332?deep_and_deferred=1" target="_blank">Pesan via ShopeeFood</a>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- food section -->
  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>Our Menu</h2>
      </div>
      {{-- Filter Menu Static, opsional --}}
      <ul class="filters_menu">
        <li class="active" data-filter="*">All</li>
        <li data-filter=".burger">Burger</li>
        <li data-filter=".pizza">Pizza</li>
        <li data-filter=".pasta">Pasta</li>
        <li data-filter=".fries">Fries</li>
      </ul>
      <div class="filters-content">
        <div class="row grid">
          {{-- Tampilkan menu dinamis dari database --}}
          @foreach ($menus as $menu)
          <div class="col-sm-6 col-lg-4 all {{ strtolower(str_replace(' ', '-', $menu->name)) }}">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="{{ asset('assets/images/' . ($menu->image ?? 'no-image.png')) }}" alt="{{ $menu->name }}">
                </div>
                <div class="detail-box">
                  <h5>{{ $menu->name }}</h5>
                  <p>{{ $menu->description }}</p>
                  <div class="options d-flex justify-content-between align-items-center">
                    <h6>Rp{{ number_format($menu->price, 0, ',', '.') }}</h6>
                    <form action="{{ route('cart.add') }}" method="POST" style="display:inline;">
                      @csrf
                      <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                      <button type="submit" class="btn btn-sm btn-warning" title="Tambah ke Keranjang">
                        <i class="fa fa-shopping-cart"></i>
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="btn-box">
        <a href="#">View More</a>
      </div>
    </div>
  </section>
  <!-- end food section -->

  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-col">
          <div class="footer_contact">
            <h4>Contact Us</h4>
            <div class="contact_link_box">
              <a href="#"><i class="fa fa-map-marker"></i><span>Location</span></a>
              <a href="#"><i class="fa fa-phone"></i><span>Call +01 1234567890</span></a>
              <a href="#"><i class="fa fa-envelope"></i><span>demo@gmail.com</span></a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <div class="footer_detail">
            <a href="#" class="footer-logo">Feane</a>
            <p>Necessary, making this the first true generator on the Internet...</p>
            <div class="footer_social">
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-linkedin"></i></a>
              <a href="#"><i class="fa fa-instagram"></i></a>
              <a href="#"><i class="fa fa-pinterest"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <h4>Opening Hours</h4>
          <p>Everyday</p>
          <p>10.00 Am - 10.00 Pm</p>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Free Html Templates</a><br><br>
          &copy; <span id="displayYear"></span> Distributed By
          <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
        </p>
      </div>
    </div>
  </footer>
  <!-- footer section -->

  <!-- JS -->
  <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
