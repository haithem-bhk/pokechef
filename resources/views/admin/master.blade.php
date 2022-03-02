<!DOCTYPE html>
<html lang="en">


<!-- datatables.html  21 Nov 2019 03:55:21 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title')</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{URL::to('otika/assets/css/app.min.css')}}">
  <link rel="stylesheet" href="{{URL::to('otika/assets/bundles/datatables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{URL::to('otika/assets/bundles/izitoast/css/iziToast.min.css')}}">

  <link rel="stylesheet" href="{{URL::to('otika/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{URL::to('otika/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{URL::to('otika/assets/css/components.css')}}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{URL::to('otika/assets/css/custom.css')}}">
  <link rel='shortcut icon' type='image/x-icon' href='{{URL::to('otika/assets/img/favicon.ico')}}' />
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      @yield('content')
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{URL::to('otika/assets/js/app.min.js')}}"></script>
  <!-- JS Libraies -->
  <script src="{{URL::to('otika/assets/bundles/datatables/datatables.min.js')}}"></script>
  <script src="{{URL::to('otika/assets/bundles/izitoast/js/iziToast.min.js')}}"></script>

  <script src="{{URL::to('assets/bundles/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
  <script src="{{URL::to('otika/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{URL::to('otika/assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{URL::to('otika/assets/js/page/datatables.js')}}"></script>
  <script src="{{URL::to('otika/assets/js/page/toastr.js')}}"></script>

  <!-- Template JS File -->
  <script src="{{URL::to('otika/assets/js/scripts.js')}}"></script>
  <!-- Custom JS File -->
  <script src="{{URL::to('otika/assets/js/custom.js')}}"></script>
  <script src="{{URL::to('assets/bundles/sweetalert/sweetalert.min.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{URL::to('assets/js/page/sweetalert.js')}}"></script>

  <script type="text/javascript">
    $(document).ready(function(){
    var maxField = 20; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="row form-group align-items-center"><label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ingredient</label><div class="col-sm-6 col-md-2"><input type="text" class="form-control" name="ingredients[]" value=""/><a href="javascript:void(0);" class="remove_button"></div><div class="col-sm-6 col-md-2"><i class="material-icons">remove_circle_outline</i></a></div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        wrapper = $(this).parent().parent().parent();
        console.log(wrapper);
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
          }
        });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
      e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x--; //Decrement field counter
      });
  });
</script>
<script type="text/javascript">
  var token = '{{Session::token()}}' ;
  var exist = '{{Session::has('msg')}}';
  if (exist){
    alert('{{Session::get('msg')}}');
  }
</script>

@yield('script')
</body>

<script defer src="https://unpkg.com/alpinejs@3.9.0/dist/cdn.min.js"></script>

<script type="text/javascript">
  function legumeVisibility(){
    return{
      legume_visible: {!! \App\Models\settings::where('settings_key','legume_visible')->first()->settings_value !!},
      init(){
        console.log(this.legume_visible);
      },
      updateStatus(status){
         $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
         $.ajax({
          type:"post",
          url:"/admin/legumevisibility",
          data:{
            status:status
          },
          complete: (response) => {
            iziToast.info({
              title: 'Done',
              message: 'Visibility Status Updated',
              position: 'topRight'
            });
            this.legume_visible =  response.legume_visible
          }
         });
      }
    }
  }

  function handler() {
    return {

      base: {!! \App\Models\bowlBase::all() !!},
      garnitures: {!! \App\Models\bowlGarnitures::all() !!},
      proteine: {!! \App\Models\bowlProteine::all() !!},
      sauce: {!! \App\Models\bowlSauce::all() !!},
      topping: {!! \App\Models\bowlTopping::all() !!},
      base_field: [],
      garnitures_field: [],
      proteine_field: [],
      sauce_field: [],
      topping_field: [],
      init(){
       

        Object.entries(this.base).map(item => {
          this.base_field.push({
            name:item[1].name,
            price:item[1].supp_price
          });
        });

        Object.entries(this.garnitures).map(item => {
          this.garnitures_field.push({
            name:item[1].name,
            price:item[1].supp_price
          })
        })

        Object.entries(this.proteine).map(item => {
          this.proteine_field.push({
            name:item[1].name,
            price:item[1].supp_price
          })
        })

        Object.entries(this.topping).map(item => {
          this.topping_field.push({
            name:item[1].name,
            price:item[1].supp_price
          })
        })

        Object.entries(this.sauce).map(item => {
          this.sauce_field.push({
            name:item[1].name,
            price:item[1].supp_price
          })
        })
       
      },

      
      addNewField(type) {
        console.log(type)
        type.push({"name":"","price":""})
        console.log(type)

      },
      removeField(index,typefield,type) {

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type:"post",
          url:"/admin/removecompose",
          data:{
            remove: typefield[index].name,
            type: type
          },
          complete: () => {
            iziToast.info({
              title: 'Done',
              message: 'Ingredient Removed Successfully',
              position: 'topRight'
            });
            typefield.splice(index, 1);
            console.log(typefield);
          }
        });
      },

      addCompose(field, type){
        console.log(type);
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type:"post",
          url: "/admin/addcompose",
          data:{
            content: field,
            type : type 
          }, 
          success: (response) => {
            iziToast.success({
              title: 'Done',
              message: 'Ingredient Added Successfully',
              position: 'topRight'
            });
            console.log(response);
          }
        });
      },
    }
  }

</script>
<script type="text/javascript">
    function getOrders(){
      return {
        orders : {!! \App\Models\orders::orderByDesc('created_at')->get() !!},
       
        updateOrder(id,operation){
          $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
          $.ajax({
            type:"post",
            url:"/admin/orders/update",
            data:{
              id:id,
              operation:operation,
            },
            success: (response) =>{
              iziToast.success({
              title: 'Done',
              message: 'Order Updated',
              position: 'topRight'
            });
              this.orders = response.orders;
            }
          });
        }
      }
    }
  </script>

<!-- datatables.html  21 Nov 2019 03:55:25 GMT -->
</html>  