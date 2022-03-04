  <script src="{{URL::to('landing/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{URL::to('landing/assets/js/cart_btn.js')}}"></script>
  <script  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script src="{{URL::to('otika/assets/bundles/izitoast/js/iziToast.min.js')}}"></script>
<script src="{{URL::to('otika/assets/js/page/toastr.js')}}"></script>
<script src="{{URL::to('otika/assets/bundles/sweetalert/sweetalert.min.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{URL::to('otika/assets/js/page/sweetalert.js')}}"></script>
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
          console.log("mesg");
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
    function warningpopup(msg){
          iziToast.warning({
              title: 'Oops',
              message: msg,
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
          topping:[],
          garniture:[],
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
          console.log(this.selected.garniture.length);
          switch(index){
            case 1:
               (this.selected.base === '') ? warningpopup('Please Select an Ingredient') : this.step++
                break;
            case 2:
               (this.selected.garniture.length == 0) ? warningpopup('Please Select an Ingredient') : (this.selected.garniture.length>5) ? warningpopup("Please Select Only 5 Garnitures") : this.step++
                break;
            case 3:
               (this.selected.proteine === '') ? warningpopup('Please Select an Ingredient') : this.step++
                break;
            case 4:
               (this.selected.topping.length == 0) ? warningpopup('Please Select an Ingredient') : (this.selected.topping.length>3) ? warningpopup("Please Select Only 3 Toppings") : this.step++
                break;
            case 5:
               (this.selected.sauce === '') ? warningpopup('Please Select an Ingredient') : this.step++
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
  <script src="{{URL::to('landing/assets/js/main.js')}}"></script>

  <script type="text/javascript">
    
    var token = '{{Session::token()}}' ;
    var exist = '{{Session::has('order')}}';
    if (exist){
      swal('Order Done', 'Your Order Number Is ' + {{Session::get('order')}}, 'success');
    }
  </script>
  <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
  <script type="text/javascript">
    $grid= $('.grid').isotope({
      itemSelector : '.grid-element',
      layoutMode : 'fitRows'
    });
    $grid.isotope({filter: '.Jus'})
    $grid.isotope({ filter: '*' });
    $('#menu-flters').on( 'click', 'li', function() {
  var filterValue = $(this).attr('data-filter');
  $grid.isotope({ filter: filterValue });
});
  </script>

