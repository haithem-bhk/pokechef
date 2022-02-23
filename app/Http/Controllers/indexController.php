<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\plates;
use App\Models\specials;
use App\Models\drinks;
use App\Models\desserts;
use App\Models\legumes;
use App\Models\settings;
use App\Models\orders;
use App\Models\admin;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    //
    public function index(){
    	$plates = plates::all();
    	$specials = specials::all();
        $drinks = drinks::all();
        $desserts = desserts::all();
        $legume_vis = settings::where('settings_key','legume_visible')->first()->settings_value;

    	return view('front.master',['plates'=>$plates,'specials'=>$specials,'drinks'=>$drinks,'desserts'=>$desserts,"visibility"=>$legume_vis]);
    }
    public function getLegumePage(){
        $legumes = legumes::all();
        $legume_vis = settings::where('settings_key','legume_visible')->first()->settings_value;
        return view('front.legumes',['legumes'=>$legumes,'visibility'=>$legume_vis]);
    }
    public function loginPage(){
    	return view('auth.login');
    }

    public function registerPage(){
    	return view('auth.register');
    }
    public function logout(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function updateVisibility(Request $request){
        $visibility = settings::where('settings_key','legume_visible')->update(['settings_value'=>$request['status']]);
        return response()->json(settings::where('settings_key','legume_visible')->first()->settings_value);
    }

    public function getOrderHistory(){
        $user_id = auth()->user()->id;
        $orders = orders::where('user_id',$user_id)->get();
        $legume_vis = settings::where('settings_key','legume_visible')->first()->settings_value;
        return view('front.client_history',['visibility'=>$legume_vis,'orders'=>$orders]);
    }

    public function init_db(){
        // $settings = new settings();
        // $settings->settings_key = "legume_visible";
        // $settings->settings_value = "1";
        // $settings->save();
        $admin = new admin();
        $admin->name = "Admin";
        $admin->email = "admin@admin.com";
        $admin->password = bcrypt("12345678");
        $admin->save();
    }
}
