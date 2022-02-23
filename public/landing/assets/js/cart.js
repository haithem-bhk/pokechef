 function getData(){
      return {
        cart: {!!json_encode(\Cart::content())!!},
        total: "{!! \Cart::total() !!}",
        count :"{!! \Cart::count()  !!}",
        addToCart(id,name,price){
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
              name : name,
              quantity : 1,
              price : price,
              id : id,
            },
            success: (response) => {
              this.cart = response.cart;
              this.total = response.total;
              this.count = response.count;
              console.log(this.count);
              
            }
          });
        }
      }
    }