

<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
  <div class="container d-flex justify-content-center justify-content-md-between">

    <div class="contact-info d-flex align-items-center">
      <i class="bi bi-phone d-flex align-items-center"><span>+1 5589 55488 55</span></i>
      <i class="bi bi-clock d-flex align-items-center ms-4"><span> Mon-Sat: 11AM - 23PM</span></i>
    </div>

    <div class="languages d-none d-md-flex align-items-center">
      <ul>
        <li>En</li>
        <li><a href="#">De</a></li>
      </ul>
    </div>
  </div>
</div>

<div id="preloader"></div>
<a   class="cart back-to-top d-flex align-items-center justify-content-center"><i class="fa fa-shopping-cart"></i></a> 


<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-cente">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">

    <h1 class="logo me-auto me-lg-0"><a href="/">Poké Chef</a></h1>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
    
    <nav id="navbar" class="navbar order-last order-lg-0">
      <a class="cart" ><i class="fa fa-shopping-cart"></i></a>
      <ul>
        <li><a class="nav-link scrollto active" href="/">Home</a></li>
        <li><a class="nav-link scrollto" href="#plates">Plates</a></li>
        <li><a class="nav-link scrollto" href="#specials">Specials</a></li>
        <li><a class="nav-link scrollto" href="#drinks">Drinks</a></li>
        <li><a class="nav-link scrollto" href="#dessert">Dessert</a></li>
        <li><a class="nav-link scrollto" href="/composé">Composé</a></li>
        @if($visibility)
        <li><a class="nav-link scrollto" href="/legumes">Legumes</a></li>

        @endif
        @auth

        <li><a class="nav-link scrollto" href="/client/history">History</a></li>
        <li><a class="nav-link scrollto" href="/client/logout">Logout</a></li>

        @endif
        @guest 
        <li><a class="nav-link scrollto" href="/client/register">Register</a></li>

        <a href="/client/login" class="book-a-table-btn scrollto d-none d-lg-flex">Login</a>

        @endif
        </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->
    
    {{-- <a href="#book-a-table" class="book-a-table-btn scrollto d-none d-lg-flex">Book a table</a> --}}

  </div>
@include("front.cart")
</header><!-- End Header -->
