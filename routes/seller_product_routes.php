<?php
Route::group(['namespace'=> 'Products','prefix'=>'Products'], function(){

 	Route::get('/Add/Form', 'ProductController@viewProductAddForm')->name('seller.add_product_form');

 	Route::post('/Add', 'ProductController@addNewProduct')->name('seller.add_new_product');

 	Route::get('/list', 'ProductController@productList')->name('seller.product_list');

 	Route::get('ajax/Get/List/','ProductController@ajaxGetProductList')->name('seller.ajax.get_product_list');

 	Route::get('/view/{product_id}', 'ProductController@productView')->name('seller.product_view');
 	Route::get('/Edit/{product_id}', 'ProductController@productEdit')->name('seller.product_edit');
 	Route::post('/Update/', 'ProductController@productUpdate')->name('seller.update_product');
 	Route::get('/Images/{product_id}', 'ProductController@productImages')->name('seller.product_images');
 	Route::get('/Thumb/Set/{product_id}/{image_id}', 'ProductController@productSetThumb')->name('seller.product_set_thumb');
 	Route::get('/Images/Status/Update/{product_id}/{image_id}/{status}', 'ProductController@productUpdateImageStatus')->name('seller.product_images_status_update');

 	Route::get('/Images/Delete/{product_id}/{image_id}', 'ProductController@productDeleteImage')->name('seller.product_images_delete');
	Route::post('/More/Image/Add/', 'ProductController@productMoreImageAdd')->name('seller.product_more_image_add');

	Route::get('/Sizes/{product_id}', 'ProductController@productSizes')->name('seller.product_sizes');
	Route::post('/Size/Update/', 'ProductController@productSizeUpdate')->name('seller.product_size_update');
	Route::get('/Size/Status/{size_id}/{status}/{product_id}', 'ProductController@productSizeStatusUpdate')->name('seller.product_size_status_update');
	Route::post('/New/Size/Add/', 'ProductController@productNewSizeAdd')->name('seller.product_new_size_add');


	Route::get('/Varients/Edit/{product_id}', 'ProductController@productVarientEdit')->name('seller.product_varient_edit');
	Route::post('/Varients/Update/', 'ProductController@productVarientUpdate')->name('seller.product_varient_update');


	Route::get('/Colors/Edit/{product_id}', 'ProductController@productColorEdit')->name('seller.product_Color_edit');
	Route::post('/Color/Update/', 'ProductController@productColorUpdate')->name('seller.product_color_update');
	Route::post('/New/Color/Add/', 'ProductController@productNewColorAdd')->name('seller.product_new_color_add');

	Route::get('/Status/Update/{product_id}/{status}', 'ProductController@productStatusUpdate')->name('seller.product_status_update');

});