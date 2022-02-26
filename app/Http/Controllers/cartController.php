<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\plates;
use App\Models\specials;
use App\Models\orders;
use App\Models\drinks;
use App\Models\legumes;
use App\Models\settings;
class cartController extends Controller
{
    //
    function addToCart(Request $request){
      
      if ($request['type'] == "special") {
      $plate = specials::find($request['id']);

      } else if ($request['type'] == "plate") {
      $plate = plates::find($request['id']);

      } else if ($request['type'] == "drink") {
      $plate = drinks::find($request['id']);

      }
     else if ($request['type'] == "legume") {
      $plate = legumes::find($request['id']);

      }
    	Cart::add([
    		"id"=>$plate->id,
    		"name"=>$plate->name,
    		"qty"=>1,
    		"price"=>$plate->price,
        "options" => ['type' => $request['type']]
    	]);
    	// dd(gettype(Cart::total()));
    	return response()->json(["cart"=>Cart::content(), "total"=>Cart::total(), "count"=>Cart::count(),"tax"=>Cart::tax()]);
    	    }

     function composeAddToCart(Request $request){
      
      $base_price = settings::where('settings_key','compose_price')->first()->settings_value;
      $supp_price = 0;
      foreach ($request['supp'] as $supp ) {
        foreach ($request['supp_prices'] as $prices ) {
          if ($supp == $prices['name']) {
            $supp_price+=$prices['price'];
          }
        }
      }
      
      Cart::add([
        "id"=>"compose420",
        "name"=>"bowl composé",
        "qty"=>1,
        "price"=>$base_price+$supp_price,
        "options"=> ['ingredient' => $request['selected'],'supplement'=>$request['supp']],
        "tax"=>1
      ]);
      return response()->json(["cart"=>Cart::content(), "total"=>Cart::total(), "count"=>Cart::count(),"tax"=>Cart::tax()]);
          }

    

   	function updateCart(Request $request){
   		Cart::update($request['rowid'],$request['qty']);
   		return response()->json(["cart"=>Cart::content(), "total"=>Cart::total(), "count"=>Cart::count(),"tax"=>Cart::tax()]);
   	}

   	function destroyCart(){
   		Cart::destroy();
   	}

   	function deleteCart(Request $request){
   		Cart::remove($request['rowid']);
   		return response()->json(["cart"=>Cart::content(), "total"=>Cart::total(), "count"=>Cart::count(),"tax"=>Cart::tax()]);


   	}

   	function checkout(){
   		

   		
   		return redirect()->route('paymentPage');

   	}

}



