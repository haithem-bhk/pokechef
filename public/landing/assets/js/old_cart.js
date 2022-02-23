// remove item from cart
$(document).on("click",".remove-cart-item",function(){
  var product = $(this).parent();
  product.slideUp(300,function(){
    product.remove();
    update_totals();
  });
});

// on quantity change from cart, update that line
$(document).on("change",".quantity",function(){

  update_quantity(this);
});

// update the cart quantity and price total
function update_totals(){
 total_quantity = 0; 
 total_price = 0;
 $(".total-price").each(function(){
  total_price += parseFloat($(this).html());
}); 
 $(".quantity").each(function(){
  total_quantity += parseFloat($(this).val());
});
 $('#item-total-quantity').html(total_quantity);
 $("#total-cart").html(total_price);
}

// update single row + update totals (call)
function update_quantity(input){
  var item_price = parseFloat($(input).parent().prev().prev().prev().html());
  var quantity = parseFloat($(input).val());
  $(input).parent().prev().html(item_price * quantity);
  update_totals();

}
var total_price = 0;
var total_quantity = 0;
    // add to cart 
    $(".add-cart").click(function(){  
      total_quantity++;
      var item_name = $(this).prev().prev().find("a").html();
      var item_price = $(this).prev().prev().find("span").html().replace("€","");
      var id = item_name.replace(/\s/g,"");
      var qid = "q_" + id;
      var name = $('.shopping-cart-items').find('#'+id).html()
        // check if item already exists in cart
        // if it doesn't, append html, otherwise increment quantity
        if (!name) {

          $('#item-total-quantity').html(total_quantity);
          var newItem = `
          <li class="clearfix">
          <span class="item-name" id="${id}">${item_name}</span>
          Unit Price: <span style="color:#cda45e;">€</span>
          <span class="item-price">${item_price}</span>
          Total Price: <span style="color:#cda45e;">€</span>
          <span class="total-price">${item_price}</span>
          <span class="item-quantity">Quantity <input id="${qid}" value="1" min="1" type="number" class="quantity" ></span>
          <a class="remove-cart-item"><i class="fa fa-times close"></i></a>
          </li>
          ` 
          $('.shopping-cart-items').append(newItem);
          // $.ajaxSetup({
          //   headers: {
          //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          //   }
          // });
          // $.ajax({
          //   type:"post",
          //   url:"/cart/add",
          //   data:{
          //     name : item_name,
          //     quantity : 1,
          //     price : item_price,
          //     id : id,
          //   },
            
          // });
          update_totals();
        // if item already exists in cart increment quantity input
      } else {
        var newquantity = parseFloat($('.shopping-cart-items').find('#'+qid).val()) + 1
        $('.shopping-cart-items').find('#'+qid).val(newquantity);
        update_quantity($('.shopping-cart-items').find('#'+qid));
      }


    });



