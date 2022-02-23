<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>History</title>
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

  <link rel="stylesheet" href="{{URL::to('otika/assets/bundles/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{URL::to('otika/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">

</head>


<style>
  td,th{
    color:white !important;
  }
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
          <h2>History</h2>
          <ol>
            <li><a href="/">Home</a></li>
            
          </ol>
        </div>

      </div>
    </section>
  
    <section class="inner-page">
      <div class="container" x-data="getOrders()">
       <div class="table-responsive">
                      <table class="table table-striped" >
                        <thead>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th colspan="2">Order</th>
                            <th>Pick Up Time</th>
                            <th>Created At</th>
                            
                          </tr>
                          <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Quantity</th>

                          </tr>
                        </thead>
                        <tbody>
                          <template x-for="(item,index) in orders">
                          <tr>
                            <td x-text="index+1">
                              
                            </td>
                            <td>
                              <template x-for="(content,id) in JSON.parse(item.cart_content)">
                                <div x-text="content.name">
                                  
                                </div>
                              </template>
                            </td>
                            <td>
                              <template x-for="(content,id) in JSON.parse(item.cart_content)">
                                <div x-text="content.qty">
                                  
                                </div>
                              </template>
                            </td>
                            <td x-text="item.pickup_time"></td>
                            <td class="align-middle" x-text="item.created_at">
                             
                            </td>
                           
                            
                          </tr>
                          </template>
                         
                        </tbody>
                      </table>
                    </div>

      </div>
    </section>

  </main><!-- End #main -->

  @include('front.footer')
  <!-- Vendor JS Files -->
  <script  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script src="{{URL::to('landing/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{URL::to('landing/assets/js/main.js')}}"></script>
  <script src="{{URL::to('landing/assets/js/cart_btn.js')}}"></script>
  <script src="{{URL::to('otika/assets/bundles/datatables/datatables.min.js')}}"></script>
<script src="{{URL::to('otika/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
 <script src="{{URL::to('otika/assets/js/page/datatables.js')}}"></script>
  
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
  <script type="text/javascript">
    function getOrders(){
      return {
        orders : {!! \App\Models\orders::where('user_id',auth()->user()->id)->get()->sortByDesc('created_at') !!},
        
      }
    }
  </script>
  @yield('script')

</body>

<script type="text/javascript">
  var token = '{{Session::token()}}' ;
  var exist = '{{Session::has('msg')}}';
  if (exist){
    alert('{{Session::get('msg')}}');
  }
</script>

</html>