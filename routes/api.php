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




});





Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
