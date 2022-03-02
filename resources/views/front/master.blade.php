<!DOCTYPE html>
<html lang="en">

<head>
<title>Poké Chef</title>
 @include('front.front_style')

</head>
<body x-data="getData">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  @include('front.header')
  @include('front.hero')
  @include('front.specials')
  @include('front.menu')
  @include('front.drinks')
  @include('front.dessert')

  @include('front.footer')
 

  <!-- Vendor JS Files -->
@include('front.front_links')
  @yield('script')
  <script type="text/javascript">
    $('.mobile-nav-toggle').click(function(){
      
      $('#navbar').toggleClass('navbar-mobile')
    $(this).toggleClass('bi-list')
    $(this).toggleClass('bi-x')
    });

  </script>
</body>

</html>