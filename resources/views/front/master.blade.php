<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Poké Chef</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{URL::to('landing/assets/img/favicon.png')}}" rel="icon">
  <link href="{{URL::to('landing/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="{{URL::to('otika/assets/bundles/izitoast/css/iziToast.min.css')}}">
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
<body x-data="getData">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  @include('front.header')
  @include('front.hero')
  @include('front.specials')
  @include('front.menu')
  @include('front.drinks')
  @include('front.dessert')
  @include('front.compose')

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
  <script src="{{URL::to('otika/assets/bundles/izitoast/js/iziToast.min.js')}}"></script>
<script src="{{URL::to('otika/assets/js/page/toastr.js')}}"></script>
  <script defer src="https://unpkg.com/alpinejs@3.9.0/dist/cdn.min.js"></script>
  <script type="text/javascript">
   function getData(){
    return {
      cart: {!!json_encode(\Cart::content())!!},
      total: "{!! \Cart::total() !!}",
      count :"{!! \Cart::count()  !!}",
      tax : "{!! \Cart::tax()  !!}",
      time: '{{\Carbon\Carbon::now()->addMinutes(15)->format('H:i')}}',
      init (){
        console.log(this.time);

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
  <script>
    function warningpopup(){
          iziToast.warning({
              title: 'Oops',
              message: 'Please Select an Ingredient',
              position: 'bottomCenter'
            })
        };
    function bowlcompose() {
      return {
        step: 1, 
        
        base : {!! \App\Models\bowlBase::all() !!},
        topping : {!! \App\Models\bowlTopping::all() !!},
        sauce : {!! \App\Models\bowlSauce::all() !!},
        garnitures : {!! \App\Models\bowlGarnitures::all() !!},
        proteine : {!! \App\Models\bowlProteine::all() !!},
        selected : {
          base: "",
          topping:"",
          garniture:"",
          sauce:"",
          proteine:"",
        },
        selected_supp:[],
        supp:[],
        init(){
         

          Object.entries(this.base).map(item => {
            if ( item[1].supp_price && item[1].supp_price> 0 ){
              this.supp.push({
                name:item[1].name,
                price:item[1].supp_price
              })
            }
          });
          Object.entries(this.topping).map(item => {
            if ( item[1].supp_price && item[1].supp_price> 0 ){
              this.supp.push({
                name:item[1].name,
                price:item[1].supp_price
              })
            }
          });
          
          Object.entries(this.sauce).map(item => {
            if ( item[1].supp_price && item[1].supp_price> 0 ){
              this.supp.push({
                name:item[1].name,
                price:item[1].supp_price
              })
            }
          });
          
          Object.entries(this.garnitures).map(item => {
            if ( item[1].supp_price && item[1].supp_price> 0 ){
              this.supp.push({
                name:item[1].name,
                price:item[1].supp_price
              })
            }
          });
          
          Object.entries(this.proteine).map(item => {
            if ( item[1].supp_price && item[1].supp_price> 0 ){
              this.supp.push({
                name:item[1].name,
                price:item[1].supp_price
              })
            }
          });
          
          console.log(this.supp)
        },
        showSelected(){
          console.log(this.selected);
          console.log(this.selected_supp)
        },
        
        checkSelection(index){
          console.log(index);
          switch(index){
            case 1:
               (this.selected.base === '') ? warningpopup() : this.step++
                break;
            case 2:
               (this.selected.garniture === '') ? warningpopup() : this.step++
                break;
            case 3:
               (this.selected.proteine === '') ? warningpopup() : this.step++
                break;
            case 4:
               (this.selected.topping === '') ? warningpopup() : this.step++
                break;
            case 5:
               (this.selected.sauce === '') ? warningpopup() : this.step++
                break;
            
                                    
              
          }
        },

        addComposeToCart(selected,supp,supp_prices){
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            type:"post",
            url:"/cart/composeadd",
            data:{
              selected: selected,
              supp : supp,
              supp_prices : supp_prices
            },
            success: (response) => {
              this.selected.base = '';
              this.selected.topping = '';
              this.selected.garniture = '';
              this.selected.sauce = '';
              this.selected.proteine = '';
              this.selected_supp = [];
              this.cart = response.cart;
              this.total = response.total;
              this.count = response.count;
              console.log(this.cart);
              console.log(this.tax);
              this.step = 1;
              console.log(this.step);
              iziToast.success({
              title: 'Done',
              message: 'Added To Cart',
              position: 'bottomCenter'
            })
            }
          });
        }
        
      }
    }
  </script>
  
  @yield('script')
</body>

</html>