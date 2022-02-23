<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Legumes</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{URL::to('landing/assets/img/favicon.png')}}" rel="icon">
  <link href="{{URL::to('landing/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{URL::to('landing/assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{URL::to('landing/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{URL::to('landing/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{URL::to('landing/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{URL::to('landing/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{URL::to('landing/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{URL::to('landing/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{URL::to('landing/assets/css/style.css')}}" rel="stylesheet">
  <link href="{{URL::to('landing/assets/css/cart_btn.css')}}" rel="stylesheet">

</head>


<style>
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
        border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>

<body x-data="getData">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  @include('front.header')

    <main id="main">
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Legumes</h2>
          <ol>
            <li><a href="/">Home</a></li>
            
          </ol>
        </div>

      </div>
    </section>
  
    <section class="inner-page">
      <div class="container">
        

<section id="menu" class="menu section-bg">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Legumes</h2>
      <p>Check Our Tasty Legumes</p>
    </div>

   {{--  <div class="row" data-aos="fade-up" data-aos-delay="100">
      <div class="col-lg-12 d-flex justify-content-center">
        <ul id="menu-flters">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-starters">Starters</li>
          <li data-filter=".filter-salads">Salads</li>
          <li data-filter=".filter-specialty">Specialty</li>
        </ul>
      </div>
    </div> --}}

    <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">

      @foreach($legumes as $legume)
      @if($legume->visible)
      <div class="col-lg-6 menu-item filter-specialty">
        <img src="{{route('legumeImage', ['imageName' => $legume->image_path ])}}" class="menu-img" alt="">
        <div class="menu-content">
          <a href="#" class="item-name" >{{$legume->name}}</a><span class="item-price">€{{$legume->price}}</span>
        </div>
        <div class="menu-ingredients">
          @foreach(explode('/',$legume->ingredients) as $ingredient)
          {{$ingredient}} @if(!$loop->last) - @endif
          @endforeach
        </div>
        @auth("web")
        <button class="add-to-cart-button" @click="addToCart({{$legume->id}},'legume')">
          <svg class="add-to-cart-box box-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="24" height="24" rx="2" fill="#ffffff"/></svg>
          <svg class="add-to-cart-box box-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="24" height="24" rx="2" fill="#ffffff"/></svg>
          <svg class="cart-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
          <svg class="tick" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path fill="#ffffff" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM9.29 16.29L5.7 12.7c-.39-.39-.39-1.02 0-1.41.39-.39 1.02-.39 1.41 0L10 14.17l6.88-6.88c.39-.39 1.02-.39 1.41 0 .39.39.39 1.02 0 1.41l-7.59 7.59c-.38.39-1.02.39-1.41 0z"/></svg>
          <span class="add-to-cart"></span>
          <span class="added-to-cart"></span>
        </button>
        @endif
      </div>
      @endif
      @endforeach
      

    </div>

  </div>
  
</section><!-- End Menu Section -->

      </div>
    </section>

  </main><!-- End #main -->

  @include('front.footer')
  <!-- Vendor JS Files -->
  <script src="{{URL::to('landing/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{URL::to('landing/assets/js/main.js')}}"></script>
  <script src="{{URL::to('landing/assets/js/cart_btn.js')}}"></script>
  <script  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script defer src="https://unpkg.com/alpinejs@3.9.0/dist/cdn.min.js"></script>
 
  
  @yield('script')

</body>

<script type="text/javascript">
  var token = '{{Session::token()}}' ;
  var exist = '{{Session::has('msg')}}';
  if (exist){
    alert('{{Session::get('msg')}}');
  }
</script>
<script type="text/javascript">
   function getData(){
    return {
      cart: {!!json_encode(\Cart::content())!!},
      total: "{!! \Cart::total() !!}",
      count :"{!! \Cart::count()  !!}",
      tax : "{!! \Cart::tax()  !!}",
      init (){


      },
      addToCart(id,type){
          // console.log(this.total);
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            type:"post",
            url:"/cart/add",
            data:{
              id : id,
              type:type,
            },
            success: (response) => {
              this.cart = response.cart;
              this.total = response.total;
              this.count = response.count;
              console.log(this.cart);
            }
          });
        },
        updateCart(rowid,qty){
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            type:"post",
            url: "/cart/update",
            data:{
              rowid : rowid,
              qty : qty
            },
            success: (response) => {
              this.cart = response.cart;
              this.total = response.total;
              this.count = response.count;
              console.log(this.total);

            }
          });
        },

        removeItem(rowid){
              
            

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            type:"post",
            url: "/cart/remove",
            data:{
              rowid : rowid,
            },
            success: (response) => {
              var product = '#'+rowid;
              $(product).slideUp(300,function(){ 
                $(product).remove();
              });
              setTimeout(()=>{
                this.cart = response.cart;
                this.total = response.total;
                this.count = response.count;
              }, 300)
              
              // console.log(this.total);

            }
          });
        },
        checkout(){
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            type: "get",
            url: "/cart/checkout"

          });
        }
      }
    }
  </script>
</html>