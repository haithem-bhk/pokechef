<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\plates;
use App\Models\specials;
use App\Models\orders;
use App\Models\drinks;
use App\Models\legumes;
use App\Models\desserts;
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

}
