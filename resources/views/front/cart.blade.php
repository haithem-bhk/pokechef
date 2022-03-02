<style type="text/css">
@import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css);

  .quantity{
    width: 10%;
    height: 10%;
  }
  .close {
    color: #af0b0b;
  }
  .badge {
    background-color: #6394F8;
    border-radius: 10px;
    color: white;
    display: inline-block;
    font-size: 12px;
    line-height: 1;
    padding: 3px 7px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
  }

  .shopping-cart {
    z-index: 1;
    margin: 20px 0;
    background: rgba(12, 11, 9, 0.9);
    width: 35rem;
    position: absolute;
    left: 0; 
    right: 0; 
    margin-left: auto; 
    margin-right: auto; 
    border-radius: 3px;
    padding: 20px;
    top: 116%;
  }
  .shopping-cart .shopping-cart-header {
    border-bottom: 1px solid #E8E8E8;
    padding-bottom: 15px;
  }
  .shopping-cart .shopping-cart-header .shopping-cart-total {
    float: right;
  }
  .shopping-cart .shopping-cart-items {
    padding-top: 20px;
  }
  .shopping-cart .shopping-cart-items li {
    margin-bottom: 18px;
  }
  .shopping-cart .shopping-cart-items img {
    float: left;
    margin-right: 12px;
  }
  .shopping-cart .shopping-cart-items .item-name {
    display: block;
    padding-top: 10px;
    font-size: 16px;
  }
  .shopping-cart .shopping-cart-items .item-price {
    color: #cda45e;
    margin-right: 8px;
  }
  .shopping-cart .shopping-cart-items .item-quantity {
    color: #ABB0BE;
  }



  .cart-icon {
    color: #515783;
    font-size: 24px;
    margin-right: 7px;
    float: left;
  }

  .button {
    background: #6394F8;
    color: white;
    text-align: center;
    padding: 12px;
    text-decoration: none;
    display: block;
    border-radius: 3px;
    font-size: 16px;
    margin: 25px 0 15px 0;
  }
  .button:hover {
    background: #729ef9;
  }

  .clearfix:after {
    content: "";
    display: table;
    clear: both;
  }
  @media (max-width: 480px) {
    .shopping-cart {
    z-index: 1;
    /*margin: 20px 0;*/
    background: rgba(12, 11, 9, 0.6);
    /*background-color: white;    */
    width: 20rem;
    position: absolute;
    left: 0; 
    right: 0; 
    margin-left: auto; 
    margin-right: auto; 
    border-radius: 3px;
    padding: 20px;
    top: 80%;
    text-align: center;
  }
  }
  @media screen and (min-width: 481px) and (max-width: 1024px) {
    .shopping-cart {
    z-index: 1;
    margin: 20px 0;
    background: rgba(12, 11, 9, 0.6);
    /*background: green;*/
    width: 23rem;
    position: absolute;
    left: 0; 
    right: 0; 
    margin-left: auto; 
    margin-right: auto; 
    border-radius: 3px;
    padding: 20px;
    top: 90%;
    text-align: center;
  }
  }
</style>

<div class="shopping-cart" style="display: none;">
 @if(auth()->guard('admin')->check()|| auth()->guard('web')->check())
      <div class="shopping-cart-header">
        <span class="badge" id="item-total-quantity" x-text="count"></span>
        <div class="shopping-cart-total">
          <span class="lighter-text">Total:</span>
          <span class="main-color-text">€</span><span class="main-color-text" id="total-cart" x-text="total"></span>
        </div>  
      </div> <!--end shopping-cart-header -->

      <ul class="shopping-cart-items">
        <template x-for="(item,index) in cart">
          <li class="clearfix" :id="index">
          <span class="item-name"  x-text="item.name"></span>
          Unit Price: <span style="color:#cda45e;">€</span>
          <span class="item-price" x-text="item.price"></span>
          Total Price: <span style="color:#cda45e;">€</span>
          <span class="total-price" x-text="item.subtotal" ></span>
          <span class="item-quantity">Quantity <input @change="updateCart(index,$event.target.value)" :value="item.qty" min="1" type="number" class="quantity" ></span>
          <a class="remove-cart-item" @click="removeItem(index)"><i class="fa fa-times close"></i></a>
          </li>
        </template>
      </ul>

      <a @if(auth()->guard('admin')->check()) href="{{ route('liveOrder') }}" @else href="{{ route('paymentPage') }}" @endif class="button" >Checkout</a>
      @else
      <a class="book-a-table-btn scrollto d-lg-flex" style="justify-content: center;" href="/client/login">Login</a>
      @endif
    </div> <!--end shopping-cart -->
    
@section('script')
<script type="text/javascript">






  $(".cart").on("click", function() {
    $(".shopping-cart").fadeToggle( "fast");
  });


</script>
@endsection