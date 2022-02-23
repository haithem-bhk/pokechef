<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\settings;

use Cart;
use App\Models\orders;
class paymentController extends Controller
{
    //
    public function paymentPage(orders $order){
        $legume_vis = settings::where('settings_key','legume_visible')->first()->settings_value;

    	$intent = auth()->user()->createSetupIntent();
        
    	return view('front.payment',['intent'=>$intent,'orderid'=>$order->id,'visibility'=>$legume_vis]);
    }

    public function purchase(Request $request)
{
    $user          = $request->user();
    $paymentMethod = $request->input('payment_method');
    $order = new orders();
        $order->user_id = auth()->user()->id;
        $order->cart_content = json_encode(Cart::content());
        $order->total =Cart::total();
        $order->pickup_time = $request['time'];
       
        
    try {
        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($paymentMethod);
        $user->charge($order->total * 100, $paymentMethod);
        $order->status = "paid";
        $order->save();  
        Cart::destroy();      
    } catch (\Exception $exception) {
        $order->status = "failed";
        $order->save();  

        return back()->with('msg', $exception->getMessage());
    }

    return redirect()->route('index')->with('msg', 'Product purchased successfully!');
}
}
