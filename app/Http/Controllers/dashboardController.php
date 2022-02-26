<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\plates;
use App\Models\specials;
use App\Models\orders;
use App\Models\drinks;
use App\Models\legumes;
use App\Models\desserts;
use App\Models\settings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class dashboardController extends Controller
{
    // orders
    function getOrders() {
        $orders = orders::all();
    	return view('admin.orders',['orders'=>$orders]);
    }

    // plates 
    function getNewPost(){
    	return view('admin.post');
    }
    function getEditPosts($id){
        $plate = plates::find($id);
    	return view('admin.edit_post',['plate'=>$plate]);
    }
    function getPostsList(){
        $plates = plates::all();
        return view('admin.posts_list',['plates'=>$plates]);
    }
    //bowl composé
    function getBowl(){
        return view('admin.bowl');
    }

    //specials
    function getNewSpecial(){
        return view('admin.special');
    }
    function getSpecialsList(){
        $specials = specials::all();
        return view('admin.special_list',['specials'=>$specials]);
    }
    function getEditSpecial($id){
        $special = specials::find($id);
        return view('admin.edit_special',['special'=>$special]);
    }

    // drinks
    function getNewDrink(){
        return view('admin.drink');
    }
    function getDrinksList(){
        $drinks = drinks::all();
        return view('admin.drink_list',['drinks'=>$drinks]);
    }
    function getEditDrink($id){
        $drink = drinks::find($id);
        return view('admin.edit_drink',['drink'=>$drink]);
    }

    //legumes
    function getNewLegume(){
        return view('admin.legume');
    }
    function getLegumesList(){
        $legumes = legumes::all();
        return view('admin.legume_list',['legumes'=>$legumes]);
    }
    function getEditLegume($id){
        $legume = legumes::find($id);
        return view('admin.edit_legume',['legume'=>$legume]);
    }

    //specials
    function getNewDessert(){
        return view('admin.dessert');
    }
    function getDessertsList(){
        $desserts = desserts::all();
        return view('admin.dessert_list',['desserts'=>$desserts]);
    }
    function getEditDessert($id){
        $dessert = desserts::find($id);
        return view('admin.edit_dessert',['dessert'=>$dessert]);
    }

    //other

    function getEmployeeList(){
        return view('admin.employees');
    }
    function getEmployeeProfile(){
        return view('admin.emp_profile');
    }
    function getShifts(){
        return view('admin.shifts');
    }
    function getArchive(){
        return view('admin.orders');
    }

    function getLive(){
        $plates = plates::all();
        $specials = specials::all();
        $drinks = drinks::all();
        $desserts = desserts::all();
        $legumes = legumes::all();
        $legume_vis = settings::where('settings_key','legume_visible')->first()->settings_value;
       return view('admin.live',['plates'=>$plates,'specials'=>$specials,'drinks'=>$drinks,'desserts'=>$desserts,"legumes"=>$legumes,"visibility"=>$legume_vis]);
    }

    function postLiveOrder() {
        $order = new orders();
        $order->user_id = auth()->user()->id;
        $order->cart_content = json_encode(Cart::content());
        $order->total =Cart::total();
        $order->pickup_time = Carbon::now();
        $order->status = "At Restaurent";
        $order->save();
        Cart::destroy();
        return redirect()->back()->with('order_id',$order->id);
    }

    function getSettingsPage(){
        $video = settings::where('settings_key','header_video')->first()->settings_value;
        return view('admin.settings',['video'=>$video]);
    }

    function postSettings(Request $request){
        $video = settings::where('settings_key','header_video')->update(['settings_value'=>$request['video']]);
        return redirect()->back();
    }

}
