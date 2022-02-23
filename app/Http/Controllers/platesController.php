<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\plates;
use App\Models\specials;
use App\Models\legumes;
use App\Models\drinks;
use App\Models\desserts;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\bowlBase;
use App\Models\bowlGarnitures;
use App\Models\bowlProteine;
use App\Models\bowlSauce;
use App\Models\bowlTopping;



use Validator;


class platesController extends Controller
{
    // plate functions

    public function newPlate(Request $request){
    
    	$plate = new plates();
    	
    	$image = $request->file('image');

        if($image){
    	$validation = Validator::make($request->all(),[
    		'image'  => 'mimes:png,jpg,jpeg,bmp',
         ]); 
        
        if ($validation->fails()){
           return redirect()->back()->with('msg','Please Check File Extensions');
        }

        } else {
            // change to response
           return redirect()->back()->with('msg','No Image');

        }

    	$imgext = $image->getClientOriginalExtension();
        $imagename =  $request['name'] . ".".$imgext;
        $image->storeAs('public/plates',$imagename);
        $plate->price = $request['price'];
        $plate->name = $request['name'];
        $plate->ingredients = implode('/',$request['ingredients']);
        $plate->description = $request['description'];
        $plate->visible = $request['visible'];
        $plate->image_path = $imagename;

    	$plate->save();
       	
       	return redirect()->back();

    }

    public function getPlateImage($imageName){
    	$path = storage_path('app/public/plates/'.$imageName);
        // dd($path);
        // return Response()->file($path);
        return Response("200");
    }

    public function hidePlate(request $request){
        $plate = plates::find($request['id']);
        $plate->visible = 0;
        $plate->update();
    }
    public function showPlate(request $request){
        $plate = plates::find($request['id']);
        $plate->visible = 1;
        $plate->update();
    }
    public function trashPlate(request $request){
        $plate = plates::find($request['id']);
        Storage::disk('public')->delete('plates/'.$plate->image_path);
        $plate->delete();
    }

    public function editPlate(Request $request,$id) {
        $plate= plates::find($id);
        $image = $request->file('image');

        
        $plate->price = $request['price'];
        $plate->name = $request['name'];
        $plate->ingredients = implode('/',array_filter($request['ingredients']));
        $plate->description = $request['description'];
        $plate->visible = $request['visible'];
        
        if ($image) {
           $validation = Validator::make($request->all(),[
            'image'  => 'mimes:png,jpg,jpeg,bmp',
         ]); 
        
        if ($validation->fails()){
           return redirect()->back()->with('msg','Please Check File Extensions');
           $plate->image_path = $imagename;
        }

        $imgext = $image->getClientOriginalExtension();
        $imagename =  $request['name'] . ".".$imgext;
        $image->storeAs('public/plates',$imagename);
        }

        $plate->update();
        return redirect()->back();
    }

    // special functions
    public function newSpecial(Request $request){
    
        $plate = new specials();
        
        $image = $request->file('image');

        $validation = Validator::make($request->all(),[
            'image'  => 'mimes:png,jpg,jpeg,bmp',
         ]); 
        
        if ($validation->fails()){
           return redirect()->back()->with('msg','Please Check File Extensions');
        }

        $imgext = $image->getClientOriginalExtension();
        $imagename =  $request['name'] . ".".$imgext;
        $image->storeAs('public/specials',$imagename);
        $plate->price = $request['price'];
        $plate->name = $request['name'];
        $plate->ingredients = implode('/',$request['ingredients']);
        $plate->description = $request['description'];
        $plate->visible = $request['visible'];
        $plate->image_path = $imagename;

        $plate->save();
        
        return redirect()->back();

    }

    public function getSpecialImage($imageName){
        $path = storage_path('app/public/specials/'.$imageName);
        // dd($path);
        // return Response()->file($path);
        return Response("200");
    }

    public function editSpecial(Request $request,$id) {
        $plate= specials::find($id);
        $image = $request->file('image');

        
        $plate->price = $request['price'];
        $plate->name = $request['name'];
        $plate->ingredients = implode('/',array_filter($request['ingredients']));
        $plate->description = $request['description'];
        $plate->visible = $request['visible'];
        
        if ($image) {
           $validation = Validator::make($request->all(),[
            'image'  => 'mimes:png,jpg,jpeg,bmp',
         ]); 
        
        if ($validation->fails()){
           return redirect()->back()->with('msg','Please Check File Extensions');
           $plate->image_path = $imagename;
        }

        $imgext = $image->getClientOriginalExtension();
        $imagename =  $request['name'] . ".".$imgext;
        $image->storeAs('public/specials',$imagename);
        }

        $plate->update();
        return redirect()->back();
    }

    public function hideSpecial(request $request){
        $special = specials::find($request['id']);
        $special->visible = 0;
        $special->update();
    }
    public function showSpecial(request $request){
        $special = specials::find($request['id']);
        $special->visible = 1;
        $special->update();
    }
    public function trashSpecial(request $request){
        $special = specials::find($request['id']);
        Storage::disk('public')->delete('specials/'.$special->image_path);
        $special->delete();
    }


    //bowl composé functions
    public function addNewCompose(Request $request){

        
        

        foreach ($request['content'] as $ingredient) {
            if ($request['type'] == "base") {
            if($ingredient['name']){
            $compose = bowlBase::where('name',$ingredient['name'])->first();
            if ($compose) {
                if ($compose->supp_price != $ingredient['price']) {
                   
                   $compose->update([
                    "supp_price"=>$ingredient['price']
                   ]);
                }
            } else {
                $compose = bowlBase::create([
                     'name'=>$ingredient['name'],
                     'supp_price'=>$ingredient['price']
                ]);
            }
        }
        } else if ($request['type'] == "garnitures") {
            if($ingredient['name']){
            $compose = bowlGarnitures::where('name',$ingredient['name'])->first();
            if ($compose) {
                if ($compose->supp_price != $ingredient['price']) {
                   
                   $compose->update([
                    "supp_price"=>$ingredient['price']
                   ]);
                }
            } else {
                $compose = bowlGarnitures::create([
                     'name'=>$ingredient['name'],
                     'supp_price'=>$ingredient['price']
                ]);
            }
        }
        } else if ($request['type'] == "sauce") {
            if($ingredient['name']){
            $compose = bowlSauce::where('name',$ingredient['name'])->first();
            if ($compose) {
                if ($compose->supp_price != $ingredient['price']) {
                   
                   $compose->update([
                    "supp_price"=>$ingredient['price']
                   ]);
                }
            } else {
                $compose = bowlSauce::create([
                     'name'=>$ingredient['name'],
                     'supp_price'=>$ingredient['price']
                ]);
            }
        }
        } else if ($request['type'] == "toppings") {
            if($ingredient['name']){
            $compose = bowlTopping::where('name',$ingredient['name'])->first();
            if ($compose) {
                if ($compose->supp_price != $ingredient['price']) {
                   
                   $compose->update([
                    "supp_price"=>$ingredient['price']
                   ]);
                }
            } else {
                $compose = bowlTopping::create([
                     'name'=>$ingredient['name'],
                     'supp_price'=>$ingredient['price']
                ]);
            }
        }
        } else if ($request['type'] == "proteines") {
            if($ingredient['name']){
            $compose = bowlProteine::where('name',$ingredient['name'])->first();
            if ($compose) {
                if ($compose->supp_price != $ingredient['price']) {
                   
                   $compose->update([
                    "supp_price"=>$ingredient['price']
                   ]);
                }
            } else {
                $compose = bowlProteine::create([
                     'name'=>$ingredient['name'],
                     'supp_price'=>$ingredient['price']
                ]);
            }
        }
        }
           
            
        }

        return response()->json(['base'=>bowlBase::all(),'garnitures'=>bowlGarnitures::all(),'sauce'=>bowlSauce::all(),'toppings'=>bowlTopping::all(),'proteines'=>bowlProteine::all()]);
    }

    public function removeCompose(Request $request){
        if ($request['type'] == "base") {
            // dd('hehe');
            bowlBase::where('name',$request['remove'])->delete();
            
        } else if ($request['type'] == "garnitures") {
            bowlGarnitures::where('name',$request['remove'])->delete();
        } else if ($request['type'] == "sauce") {
            bowlSauce::where('name',$request['remove'])->delete();
        } else if ($request['type'] == "toppings") {
            bowlTopping::where('name',$request['remove'])->delete();
        } else if ($request['type'] == "proteines") {
            bowlProteine::where('name',$request['remove'])->delete();
        }
    }
    // drink functions
    public function newDrink(Request $request){
    
        $drink = new drinks();
        
        $image = $request->file('image');

        if($image){
        $validation = Validator::make($request->all(),[
            'image'  => 'mimes:png,jpg,jpeg,bmp',
         ]); 
        
        if ($validation->fails()){
           return redirect()->back()->with('msg','Please Check File Extensions');
        }

        } else {
            // change to response
           return redirect()->back()->with('msg','No Image');

        }

        $imgext = $image->getClientOriginalExtension();
        $imagename =  $request['name'] . ".".$imgext;
        $image->storeAs('public/drinks',$imagename);
        $drink->price = $request['price'];
        $drink->name = $request['name'];
        $drink->ingredients = implode('/',$request['ingredients']);
        $drink->description = $request['description'];
        $drink->visible = $request['visible'];
        $drink->category = $request['category'];
        $drink->image_path = $imagename;

        $drink->save();
        
        return redirect()->back();

    }

    public function getDrinkImage($imageName){
        $path = storage_path('app/public/drinks/'.$imageName);
        // dd($path);
        // return Response()->file($path);
        return Response("200");
    }



    public function editDrink(Request $request,$id) {
        $drink= drinks::find($id);
        $image = $request->file('image');

        
        $drink->price = $request['price'];
        $drink->name = $request['name'];
        $drink->ingredients = implode('/',array_filter($request['ingredients']));
        $drink->description = $request['description'];
        $drink->visible = $request['visible'];
        
        if ($image) {
           $validation = Validator::make($request->all(),[
            'image'  => 'mimes:png,jpg,jpeg,bmp',
         ]); 
        
        if ($validation->fails()){
           return redirect()->back()->with('msg','Please Check File Extensions');
           $drink->image_path = $imagename;
        }

        $imgext = $image->getClientOriginalExtension();
        $imagename =  $request['name'] . ".".$imgext;
        $image->storeAs('public/drinks',$imagename);
        }

        $drink->update();
        return redirect()->back();
    }

    public function hideDrink(request $request){
        $drink = drinks::find($request['id']);
        $drink->visible = 0;
        $drink->update();
    }
    public function showDrink(request $request){
        $drink = drinks::find($request['id']);
        $drink->visible = 1;
        $drink->update();
    }
    public function trashDrink(request $request){
        $drink = drinks::find($request['id']);
        Storage::disk('public')->delete('drinks/'.$drink->image_path);
        $drink->delete();
    }

    //legume functions
     public function newLegume(Request $request){
    
        $legume = new legumes();
        
        $image = $request->file('image');

        if($image){
        $validation = Validator::make($request->all(),[
            'image'  => 'mimes:png,jpg,jpeg,bmp',
         ]); 
        
        if ($validation->fails()){
           return redirect()->back()->with('msg','Please Check File Extensions');
        }

        } else {
            // change to response
           return redirect()->back()->with('msg','No Image');

        }

        $imgext = $image->getClientOriginalExtension();
        $imagename =  $request['name'] . ".".$imgext;
        $image->storeAs('public/legumes',$imagename);
        $legume->price = $request['price'];
        $legume->name = $request['name'];
        $legume->ingredients = implode('/',$request['ingredients']);
        $legume->description = $request['description'];
        $legume->visible = $request['visible'];
        $legume->image_path = $imagename;

        $legume->save();
        
        return redirect()->back();

    }

    public function getLegumeImage($imageName){
        $path = storage_path('app/public/legumes/'.$imageName);
        // dd($path);
        // return Response()->file($path);
        return Response("200");
    }



    public function editLegume(Request $request,$id) {
        $legume= legumes::find($id);
        $image = $request->file('image');

        
        $legume->price = $request['price'];
        $legume->name = $request['name'];
        $legume->ingredients = implode('/',array_filter($request['ingredients']));
        $legume->description = $request['description'];
        $legume->visible = $request['visible'];
        
        if ($image) {
           $validation = Validator::make($request->all(),[
            'image'  => 'mimes:png,jpg,jpeg,bmp',
         ]); 
        
        if ($validation->fails()){
           return redirect()->back()->with('msg','Please Check File Extensions');
           $legume->image_path = $imagename;
        }

        $imgext = $image->getClientOriginalExtension();
        $imagename =  $request['name'] . ".".$imgext;
        $image->storeAs('public/legumes',$imagename);
        }

        $legume->update();
        return redirect()->back();
    }

    public function hideLegume(request $request){
        $legume = legumes::find($request['id']);
        $legume->visible = 0;
        $legume->update();
    }
    public function showLegume(request $request){
        $legume = legumes::find($request['id']);
        $legume->visible = 1;
        $legume->update();
    }
    public function trashLegume(request $request){
        $legume = legumes::find($request['id']);
        Storage::disk('public')->delete('legumes/'.$legume->image_path);
        $legume->delete();
    }

    //dessert functions
     public function newDessert(Request $request){
    
        $dessert = new desserts();
        
        $image = $request->file('image');

        if($image){
        $validation = Validator::make($request->all(),[
            'image'  => 'mimes:png,jpg,jpeg,bmp',
         ]); 
        
        if ($validation->fails()){
           return redirect()->back()->with('msg','Please Check File Extensions');
        }

        } else {
            // change to response
           return redirect()->back()->with('msg','No Image');

        }

        $imgext = $image->getClientOriginalExtension();
        $imagename =  $request['name'] . ".".$imgext;
        $image->storeAs('public/desserts',$imagename);
        $dessert->price = $request['price'];
        $dessert->name = $request['name'];
        $dessert->ingredients = implode('/',$request['ingredients']);
        $dessert->description = $request['description'];
        $dessert->visible = $request['visible'];
        $dessert->image_path = $imagename;

        $dessert->save();
        
        return redirect()->back();

    }

    public function getDessertImage($imageName){
        $path = storage_path('app/public/desserts/'.$imageName);
        // dd($path);
        // return Response()->file($path);
        return Response("200");
    }



    public function editDessert(Request $request,$id) {
        $dessert= desserts::find($id);
        $image = $request->file('image');

        
        $dessert->price = $request['price'];
        $dessert->name = $request['name'];
        $dessert->ingredients = implode('/',array_filter($request['ingredients']));
        $dessert->description = $request['description'];
        $dessert->visible = $request['visible'];
        
        if ($image) {
           $validation = Validator::make($request->all(),[
            'image'  => 'mimes:png,jpg,jpeg,bmp',
         ]); 
        
        if ($validation->fails()){
           return redirect()->back()->with('msg','Please Check File Extensions');
           $dessert->image_path = $imagename;
        }

        $imgext = $image->getClientOriginalExtension();
        $imagename =  $request['name'] . ".".$imgext;
        $image->storeAs('public/desserts',$imagename);
        }

        $dessert->update();
        return redirect()->back();
    }

    public function hideDessert(request $request){
        $dessert = desserts::find($request['id']);
        $dessert->visible = 0;
        $dessert->update();
    }
    public function showDessert(request $request){
        $dessert = desserts::find($request['id']);
        $dessert->visible = 1;
        $dessert->update();
    }
    public function trashDessert(request $request){
        $dessert = desserts::find($request['id']);
        Storage::disk('public')->delete('desserts/'.$dessert->image_path);
        $dessert->delete();
    }

}
