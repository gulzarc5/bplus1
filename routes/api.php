<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace'=>'Api'],function(){

	Route::get('app/load','CategoryController@appLoaddata');
	Route::get('slider/image/{image}', 'CategoryController@sliderImage');
	Route::get('slider/image/thumb/{image}', 'CategoryController@sliderImageThumb');

	Route::get('main/category/image/{image}', 'CategoryController@mainCategoryImage');
	Route::get('main/category/image/thumb/{image}', 'CategoryController@mainCategoryImageThumb');

	Route::get('first_category/{main_category}','CategoryController@firstCategory');
	Route::get('first/category/image/{image}', 'CategoryController@firstCategoryImage');
	Route::get('first/category/image/thumb/{image}', 'CategoryController@firstCategoryImageThumb');


	Route::get('second/category/{first_category_id}','CategoryController@secondCategory');
	Route::get('second/category/image/{image}', 'CategoryController@secondCategoryImage');
	Route::get('second/category/image/thumb/{image}', 'CategoryController@secondCategoryImageThumb');

	Route::get('seller/list/{second_category}/{page_no}','ProductController@sellerListSecondCategory');
	Route::get('product/list/{second_category}/{seller_id}/{page_no}','ProductController@productListSecondCategory');
	Route::get('product/image/{image}', 'ProductController@productImage');
	Route::get('product/image/thumb/{image}', 'ProductController@productImageThumb');

	Route::get('product/single/view/{product_id}', 'ProductController@singleProductView');
	Route::post('product/filter', 'ProductController@productFilter');

	Route::post('user/create','UserController@userCreate');
	Route::post('user/login','UserController@userLogin');

	Route::group(['middleware'=>'auth:api'],function(){
		Route::get('user/profile/{user_id}','UserController@myProfile');
		Route::post('user/profile/update','UserController@myProfileUpdate');
		Route::post('user/change/password','UserController@changePassword');

		Route::post('user/shipping/address/add','UserController@addShippingAddress');
		Route::get('user/shipping/address/list/{user_id}','UserController@ShippingAddressList');
		Route::get('user/shipping/address/delete/{address_id}','UserController@ShippingAddressDelete');
		Route::get('user/shipping/address/{address_id}','UserController@ShippingAddressSingle');
		Route::post('user/shipping/update/','UserController@ShippingAddressUpdate');

		Route::post('cart/add','CartController@cartAdd');
		Route::get('cart/products/{user_id}','CartController@cartProducts');
		Route::post('cart/update/','CartController@cartUpdate');
		Route::get('cart/delete/{cart_id}','CartController@cartDelete');

		Route::post('place/order','OrderController@orderPlace');
		Route::post('update/payment/request/id','OrderController@updatePaymentRequestId');
		Route::post('update/payment/id','OrderController@updatePaymentId');

		Route::get('order/history/{user_id}','OrderController@orderHistory');
		Route::get('order/cancel/{order_details_id}','OrderController@orderCancel');


	});

});





Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
