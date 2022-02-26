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
        $video = settings::where('settings_key','header_video')->first()->settings_value;
    	return view('front.master',['plates'=>$plates,'specials'=>$specials,'drinks'=>$drinks,'desserts'=>$desserts,"visibility"=>$legume_vis,'video'=>$video]);
    }
    public function getLegumePage(){
        $legumes = legumes::all();
        $legume_vis = settings::where('settings_key','legume_visible')->first()->settings_value;
        return view('front.legumes',['legumes'=>$legumes,'visibility'=>$legume_vis]);
    }
    public function loginPage(){
    	return view('auth.login');
    }  

    public function getComposePage(){
        $legume_vis = settings::where('settings_key','legume_visible')->first()->settings_value;
        return view('front.compose_page',['visibility'=>$legume_vis]);
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

        $legume_vis = settings::where('settings_key','legume_visible')->first()->settings_value;
        return view('front.client_history',['visibility'=>$legume_vis]);
    }

    public function init_db(){
        // $settings = new settings();
        // $settings->settings_key = "legume_visible";
        // $settings->settings_value = "1";
        // $settings->save();
        // $admin = new admin();
        // $admin->name = "Admin";
        // $admin->email = "admin@admin.com";
        // $admin->password = bcrypt("12345678");
        // $admin->save();
        $settings = new settings();
        $settings->settings_key = "compose_price";
        $settings->settings_value = "12";
        $settings->save();
        $settings = new settings();
        $settings->settings_key = "header_video";
        $settings->settings_value = "https://www.youtube.com/watch?v=oDoya3J-xjU";
        $settings->save();

    }
}
