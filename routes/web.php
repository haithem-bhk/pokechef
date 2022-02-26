<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware'=>['web']],function(){
	Route::get('/',['uses'=>'indexController@index','as'=>'index']);
	Route::get('/admin/db/init',['uses'=>'indexController@init_db']);
	Route::get('/client/login',['uses'=>'indexController@loginPage','as'=>'clientLogin']);
	Route::get('/client/register',['uses'=>'indexController@registerPage']);
		// item images 
	Route::get('/admin/getimage/{imageName}',['uses'=>'platesController@getPlateImage','as'=>'plateImage']);
	Route::get('/admin/getspecialimage/{imageName}',['uses'=>'platesController@getSpecialImage','as'=>'specialImage']);
	Route::get('/admin/getdrinkimage/{imageName}',['uses'=>'platesController@getDrinkImage','as'=>'drinkImage']);
	Route::get('/admin/getlegumeimage/{imageName}',['uses'=>'platesController@getLegumeImage','as'=>'legumeImage']);
	Route::get('/admin/getdessertimage/{imageName}',['uses'=>'platesController@getDessertImage','as'=>'dessertImage']);
	Route::get('/legumes',['uses'=>'indexController@getLegumePage']);
	Route::get('/composé',['uses'=>'indexController@getComposePage']);

});

Route::group(['middleware'=>['admin']],function(){
	// orders
	Route::get('/admin/orders',['uses'=>'dashboardController@getOrders','as'=>'getOrders']);

	// add new item page
	Route::get('/admin/newpost',['uses'=>'dashboardController@getNewPost','as'=>'newPost']);
	Route::get('/admin/newspecial',['uses'=>'dashboardController@getNewSpecial','as'=>'getNewSpecial']);
	Route::get('/admin/newlegume',['uses'=>'dashboardController@getNewLegume','as'=>'getNewLegume']);
	Route::get('/admin/newdrink',['uses'=>'dashboardController@getNewDrink','as'=>'getNewDrink']);
	Route::get('/admin/newdessert',['uses'=>'dashboardController@getNewDessert','as'=>'getNewDessert']);

	// edit existing item page
	Route::get('/admin/editpost/{id}',['uses'=>'dashboardController@getEditPosts','as'=>'editPost']);
	Route::get('/admin/editSpecial/{id}',['uses'=>'dashboardController@getEditSpecial','as'=>'getEditSpecial']);
	Route::get('/admin/editLegume/{id}',['uses'=>'dashboardController@getEditLegume','as'=>'getEditLegume']);
	Route::get('/admin/editDrink/{id}',['uses'=>'dashboardController@getEditDrink','as'=>'getEditDrink']);
	Route::get('/admin/editDessert/{id}',['uses'=>'dashboardController@getEditDessert','as'=>'getEditDessert']);

	// items list page
	Route::get('/admin/postslist',['uses'=>'dashboardController@getPostsList','as'=>'postsList']);
	Route::get('/admin/specialslist',['uses'=>'dashboardController@getSpecialsList','as'=>'specialsList']);
	Route::get('/admin/legumeslist',['uses'=>'dashboardController@getLegumesList','as'=>'legumesList']);
	Route::get('/admin/drinkslist',['uses'=>'dashboardController@getDrinksList','as'=>'DrinksList']);
	Route::get('/admin/dessertslist',['uses'=>'dashboardController@getDessertsList','as'=>'DessertsList']);
	
	// add new item route
	Route::post('/admin/addplate',['uses'=>'platesController@newPlate','as'=>'newPlate']);
	Route::post('/admin/newspecial',['uses'=>'platesController@newSpecial','as'=>'newSpecial']);
	Route::post('/admin/newdrink',['uses'=>'platesController@newDrink','as'=>'newDrink']);
	Route::post('/admin/newlegume',['uses'=>'platesController@newLegume','as'=>'newLegume']);
	Route::post('/admin/newdessert',['uses'=>'platesController@newDessert','as'=>'newDessert']);




	// edit existing item
	Route::post('/admin/editplate/{id}',['uses'=>'platesController@editPlate','as'=>'editPlate']);
	Route::post('/admin/editspecial/{id}',['uses'=>'platesController@editSpecial','as'=>'editSpecial']);
	Route::post('/admin/editlegume/{id}',['uses'=>'platesController@editLegume','as'=>'editLegume']);
	Route::post('/admin/editdrink/{id}',['uses'=>'platesController@editDrink','as'=>'editDrink']);
	Route::post('/admin/editDessert/{id}',['uses'=>'platesController@editDessert','as'=>'editDessert']);

	//plate actions
	Route::put('/admin/plate/hide/',['uses'=>'platesController@hidePlate','as'=>'hidePlate']);
	Route::put('admin/plate/show',['uses'=>'platesController@showPlate','as'=>'showPlate']);
	Route::delete('/admin/plate/trash/',['uses'=>'platesController@trashPlate','as'=>'trashPlate']);

	// special actions
	Route::put('/admin/special/hide/',['uses'=>'platesController@hideSpecial','as'=>'hideSpecial']);
	Route::put('admin/special/show',['uses'=>'platesController@showSpecial','as'=>'showSpecial']);
	Route::delete('/admin/special/trash/',['uses'=>'platesController@trashSpecial','as'=>'trashSpecial']);

	// drinks actions
	Route::put('/admin/Drink/hide/',['uses'=>'platesController@hideDrink','as'=>'hideDrink']);
	Route::put('admin/Drink/show',['uses'=>'platesController@showDrink','as'=>'showDrink']);
	Route::delete('/admin/Drink/trash/',['uses'=>'platesController@trashDrink','as'=>'trashDrink']);

	// legume actions
	Route::put('/admin/Legume/hide/',['uses'=>'platesController@hideLegume','as'=>'hideLegume']);
	Route::put('admin/Legume/show',['uses'=>'platesController@showLegume','as'=>'showLegume']);
	Route::delete('/admin/Legume/trash/',['uses'=>'platesController@trashLegume','as'=>'trashLegume']);

	// Dessert actions
	Route::put('/admin/Dessert/hide/',['uses'=>'platesController@hideDessert','as'=>'hideDessert']);
	Route::put('admin/Dessert/show',['uses'=>'platesController@showDessert','as'=>'showDessert']);
	Route::delete('/admin/Dessert/trash/',['uses'=>'platesController@trashDessert','as'=>'trashDessert']);


	// bowl composé
	Route::get('/admin/bowlview',['uses'=>'dashboardController@getBowl','as'=>'getBowl']);
	Route::post('/admin/addcompose/',['uses'=>'platesController@addNewCompose','as'=>'addCompose']);
	Route::post('/admin/removecompose',['uses'=>'platesController@removeCompose','as'=>'removeCompose']);

	Route::get('/admin/shifts',['uses'=>'dashboardController@getShifts','as'=>'shifts']);
	Route::get('/admin/archive',['uses'=>'dashboardController@getArchive','as'=>'archive']);
	Route::get('/admin/employeelist',['uses'=>'dashboardController@getEmployeeList','as'=>'employeeList']);
	Route::get('/admin/employeeprofile',['uses'=>'dashboardController@getEmployeeProfile','as'=>'employeeProfile']);

	Route::get('/admin/live',['uses'=>'dashboardController@getLive']);
	Route::post('/admin/liveorder',['uses'=>'dashboardController@postLiveOrder','as'=>'liveOrder']);

	// legume visibility
	Route::post('/admin/legumevisibility',['uses'=>'indexController@updateVisibility']);
});
Route::group(['middleware'=>['auth']],function(){
Route::post('/cart/add/',['uses'=>'cartController@addToCart','as'=>'add_cart']);
Route::post('/cart/composeadd/',['uses'=>'cartController@composeAddToCart']);
	Route::get('/cart/destroy',['uses'=>'cartController@destroyCart']);
	Route::post('/cart/update',['uses'=>'cartController@updateCart']);
	Route::post('/cart/remove',['uses'=>'cartController@deleteCart']);
	Route::get('/cart/checkout',['uses'=>'cartController@checkout']);
	Route::get('/client/logout',['uses'=>'indexController@logout','as'=>'clientLogout']);
	Route::get('/cart/payment',['uses'=>'paymentController@paymentPage','as'=>'paymentPage']);
	Route::get('/client/history',['uses'=>'indexController@getOrderHistory','as'=>'orderHistory']);
	Route::post('/cart/purchase/',['uses'=>'paymentController@purchase','as'=>'purchase']);
});


require __DIR__.'/auth.php';
