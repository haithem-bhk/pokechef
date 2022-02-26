@extends('front.front_links')
<!DOCTYPE html>
<html lang="en">

<head>
<title>Poké Chef</title>
 @include('front.front_style')

</head>
<body x-data="getData">

  <meta name="csrf-token" content="{{ csrf_token() }}" />
	<div id="preloader"></div>
<a   class="cart back-to-top d-flex align-items-center justify-content-center active">Payer</a> 

  @include('front.specials')
  @include('front.menu')
  @include('front.drinks')
  @include('front.dessert')
  @include('front.compose')


 

  <!-- Vendor JS Files -->
@include('front.front_links')
  @yield('script')
</body>

</html>