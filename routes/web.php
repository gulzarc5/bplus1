<?php

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

require __DIR__.'/frontend.php';



Auth::routes();

require __DIR__.'/seller_routes.php';
require __DIR__.'/user_routes.php';



Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/login', 'Admin\AdminLoginController@showAdminLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\AdminLoginController@adminLogin');
Route::post('/admin/logout', 'Admin\AdminLoginController@logout')->name('admin.logout');


Route::get('City/list/{state_id}', 'Admin\Configuration\ConfigurationController@cityWithState')->name('city_fetch_with_state_id');


Route::group(['middleware'=>'auth:admin','prefix'=>'admin','namespace'=>'Admin'],function(){

	require __DIR__.'/product_routes.php';

	//*************User Routes of Admin*********************
	Route::group(['namespace'=> 'Users'], function(){
		Route::get('/sellers/','UsersController@allSellers')->name('admin.allSellers');
		Route::get('Ajax/sellers/','UsersController@ajaxAllSellers')->name('admin.ajaxAllSellers');

		Route::get('/Buyers/','UsersController@allBuyers')->name('admin.allBuyers');
		Route::get('Ajax/Buyers/','UsersController@ajaxAllBuyers')->name('admin.ajaxAllBuyers');

		Route::get('/Seller/Details/{seller_id}','UsersController@sellerView')->name('admin.seller_view');
		Route::get('/Seller/verification/{seller_id}','UsersController@sellerUpdateVerification')->name('admin.sellerUpdateVerification');
		Route::get('/Seller/Status/{seller_id}/{status}','UsersController@sellerUpdateStatus')->name('admin.sellerUpdateStatus');
	});

	Route::group(['namespace'=> 'Orders'], function(){
		Route::get('/seller/Orders','OrderController@allOrders')->name('admin.all_orders');
		Route::get('/ajax/seller/Orders','OrderController@ajaxAllOrders')->name('admin.ajax_all_orders');
		Route::get('/Orders/Update/{order_details_id}/{status}','OrderController@orderUpdate')->name('admin.order_update');
		Route::get('/Single/Order/{order_id}','OrderController@singleOrderView')->name('admin.single_order_view');

		Route::get('/Pending/Orders','OrderController@pendingOrders')->name('admin.pending_orders');
		Route::get('/ajax/Pending/Orders','OrderController@ajaxPendingOrders')->name('admin.ajax_pending_orders');

		Route::get('/Delivered/Orders','OrderController@deliveredOrders')->name('admin.delivered_orders');
		Route::get('/ajax/Delivered/Orders','OrderController@ajaxDeliveredOrders')->name('admin.ajax_delivered_orders');
	});

	 
	Route::get('/deshboard', 'AdminDeshboardController@index')->name('admin.deshboard');
	///////////////////////////////All Category////////////////////////////////
	Route::group(['namespace'=> 'Category'], function(){
		Route::get('/add_main_category', 'CategoryController@viewMainCategoryForm')->name('admin.add_main_category_form');
		Route::post('/add_main_category', 'CategoryController@insertMainCategory')->name('admin.add_main_category');
		Route::get('/Edit/Category/{id}', 'CategoryController@editCategory')->name('admin.editCategory');
		Route::post('/Edit/Category', 'CategoryController@updateCategory')->name('admin.updateCategory');
		Route::get('/Status/Update/{category_id}/{status}','CategoryController@statusUpdateCategory')->name('admin.category_status_update');
		Route::get('/Delete/{category_id}','CategoryController@DeleteCategory')->name('admin.category_delete');


		Route::get('/Add/First/Category', 'CategoryController@viewFirstCategoryForm')->name('admin.add_first_category_form');
		Route::post('/Add/First/Category', 'CategoryController@insertFirstCategory')->name('admin.add_first_category');
		Route::get('/Edit/First/Category/{id}', 'CategoryController@editFirstCategory')->name('admin.edit_first_category');
		Route::post('/Edit/First/Category', 'CategoryController@updateFirstCategory')->name('admin.update_first_category');
		
		Route::get('/first/Status/Update/{first_id}/{status}','CategoryController@statusUpdateFirstCategory')->name('admin.first_category_status_update');
		Route::get('/first/Delete/{first_id}','CategoryController@deleteFirstCategory')->name('admin.first_category_delete');


		Route::get('/Add/Second/Category', 'CategoryController@viewSecondCategoryForm')->name('admin.add_second_category_form');
		Route::post('/Add/Second/Category', 'CategoryController@insertSecondCategory')->name('admin.add_second_category');
		Route::get('/Edit/Second/Category/{id}', 'CategoryController@editSecondCategory')->name('admin.edit_second_category');
		Route::post('/Update/Second/Category', 'CategoryController@updateSecondCategory')->name('admin.update_second_category');
		
		Route::get('Second/Status/Update/{category_id}/{status}', 'CategoryController@secondStatusUpdate')->name('admin.second_category_status_update');
		Route::get('Second/Delete/{category_id}', 'CategoryController@deleteSecondCategory')->name('admin.second_category_delete');


	});
	//////////////Configuration ////////////////////////////////

	Route::group(['namespace'=> 'Configuration'], function(){

		//*****************************Sliders********************

		Route::get('Slider/Form/','ConfigurationController@SliderFormView')->name('admin.SliderFormView');
		Route::post('Slider/','ConfigurationController@sliderInsert')->name('admin.sliderInsert');
		Route::get('Slider/Edit/{slider_id}','ConfigurationController@sliderEdit')->name('admin.sliderEdit');
		Route::post('Slider/Update','ConfigurationController@sliderUpdate')->name('admin.sliderUpdate');
		Route::get('Slider/Status/Update/{slider_id}/{status}','ConfigurationController@sliderStatusUpdate')->name('admin.sliderStatusUpdate');
		Route::get('Slider/Delete/{slider_id}','ConfigurationController@sliderDelete')->name('admin.sliderDelete');

		//********************Color Configuration Route*************************
		Route::get('/Add/Color/Name', 'ConfigurationController@viewColorNameForm')->name('admin.add_color_name_form');
		Route::post('/Add/Color', 'ConfigurationController@AddColor')->name('admin.add_color');
		Route::get('Ajax/Color/List', 'ConfigurationController@ajaxColorList')->name('admin.ajax_color_list');
		Route::get('/Color/Status/Update/{color_id}/{status}', 'ConfigurationController@colorStatusUpdate')->name('admin.color_status_update');

		// Route::get('/Add/Color/Map', 'ConfigurationController@viewMapColorForm')->name('admin.map_color_form');
		// Route::post('/Add/Color/Map', 'ConfigurationController@addColorMap')->name('admin.add_color_map');
		// Route::get('Ajax/Get/Color/{color_id}', 'ConfigurationController@ajaxGetColor')->name('admin.ajax_get_color');
		// Route::get('Ajax/Color/List', 'ConfigurationController@ajaxColorList')->name('admin.ajax_color_list');
		Route::get('Color/List', 'ConfigurationController@viewColorList')->name('admin.view_color_list');

		
		Route::get('/Add/Brand/Name', 'ConfigurationController@viewBrandNameForm')->name('admin.add_brand_name_form');
		Route::post('/Add/Brand', 'ConfigurationController@addBrand')->name('admin.add_brand');
		Route::get('/Brand/Name/list', 'ConfigurationController@brandNameList')->name('admin.brand_name_list');
		Route::get('/Brand/Status/Update/{brand_id}/{status}', 'ConfigurationController@brandStatusUpdate')->name('admin.brand_status_update');


		Route::post('/Add/Brand/Name', 'ConfigurationController@addBrandName')->name('admin.add_brand_name');
		Route::get('Ajax/Brand/Name/List', 'ConfigurationController@ajaxBrandNameList')->name('admin.ajax_brand_name_list');
		Route::get('/Add/Brand/Map', 'ConfigurationController@viewMapBrandForm')->name('admin.map_brand_form');
		Route::get('/Ajax/brand/{first_category}', 'ConfigurationController@AjaxBrandNames');
		Route::post('/Add/Brand/Map', 'ConfigurationController@addMapBrand')->name('admin.add_map_brand');
		Route::get('View/Brand/Mapped/List', 'ConfigurationController@ViewMappedBrandList')->name('admin.view_mapped_brand_list');
		Route::get('Ajax/Brand/Mapped/List', 'ConfigurationController@ajaxMappedBrandList')->name('admin.ajax_mapped_brand_list');
		

		//*******************State Routes*********************

		Route::get('State/Add', 'ConfigurationController@ViewStateForm')->name('admin.view_state_form');
		Route::post('State/Add', 'ConfigurationController@AddStateForm')->name('admin.add_state');
		Route::get('State/Edit/{id}', 'ConfigurationController@EditState')->name('admin.edit_state');
		Route::post('State/Update', 'ConfigurationController@updateState')->name('admin.update_state');
		Route::get('State/Delete/{id}', 'ConfigurationController@deleteState')->name('admin.delete_state');

		//*******************City Routes*********************

		Route::get('City/Add', 'ConfigurationController@ViewCityForm')->name('admin.view_city_form');
		Route::post('City/Add', 'ConfigurationController@AddCity')->name('admin.add_city');
		Route::get('City/List', 'ConfigurationController@cityList')->name('admin.city_list');
		Route::get('Ajax/City/List', 'ConfigurationController@ajaxCityList')->name('admin.ajax_city_list');
		Route::get('City/Edit/{id}', 'ConfigurationController@EditCity')->name('admin.edit_city');
		Route::post('City/Update', 'ConfigurationController@updateCity')->name('admin.update_city');
		Route::get('City/Delete/{id}', 'ConfigurationController@deleteCity')->name('admin.delete_city');
	});

});


//////////////////// Routes For accessing admin And seller /////////////////////////////

Route::group(['middleware'=>'auth:admin,seller','prefix'=>'admin','namespace'=>'Admin'],function(){

	Route::group(['namespace'=> 'Category'], function(){
		Route::get('first/Category/{id}', 'CategoryController@firstCategoryWithCategory');
		Route::get('second/Category/{id}', 'CategoryController@secondCategoryWithFirstCategory');
	});

	Route::group(['namespace'=> 'Products','prefix'=>'Products'], function(){
		// Route::get('ajax/form/load/data/{category}/{first_category}/{second_category}','ProductController@ajaxGetLoadFormData');.
			Route::get('ajax/form/load/data/{category}/{first_category}','ProductController@ajaxGetLoadFormData');
		
	});

});






