<?php

Route::group(['namespace'=> 'Products','prefix'=>'Products'], function(){

	Route::get('/Add/Form', 'ProductController@viewProductAddForm')->name('admin.add_product_form');

	

	Route::post('/Add', 'ProductController@addNewProduct')->name('admin.add_new_product');

	Route::get('/list', 'ProductController@productList')->name('admin.product_list');

	Route::get('ajax/Get/List/','ProductController@ajaxGetProductList')->name('admin.ajax.get_product_list');

	Route::get('/view/{product_id}', 'ProductController@productView')->name('admin.product_view');

	Route::get('/Edit/{product_id}', 'ProductController@productEdit')->name('admin.product_edit');

	Route::post('/Update/', 'ProductController@productUpdate')->name('admin.update_product');

	Route::get('ajax/Get/Brands/{category}/{first_category}/{second_category}','ProductController@ajaxGetLoadFormData');

	Route::get('/Images/{product_id}', 'ProductController@productImages')->name('admin.product_images');

	Route::get('/Thumb/Set/{product_id}/{image_id}', 'ProductController@productSetThumb')->name('admin.product_set_thumb');

	Route::get('/Images/Status/Update/{product_id}/{image_id}/{status}', 'ProductController@productUpdateImageStatus')->name('admin.product_images_status_update');

	Route::get('/Images/Delete/{product_id}/{image_id}', 'ProductController@productDeleteImage')->name('admin.product_images_delete');
	Route::post('/More/Image/Add/', 'ProductController@productMoreImageAdd')->name('admin.product_more_image_add');

	Route::get('/Sizes/{product_id}', 'ProductController@productSizes')->name('admin.product_sizes');
	Route::post('/Size/Update/', 'ProductController@productSizeUpdate')->name('admin.product_size_update');
	Route::get('/Size/Status/{size_id}/{status}/{product_id}', 'ProductController@productSizeStatusUpdate')->name('admin.product_size_status_update');
	Route::post('/New/Size/Add/', 'ProductController@productNewSizeAdd')->name('admin.product_new_size_add');

	Route::get('/Varients/Edit/{product_id}', 'ProductController@productVarientEdit')->name('admin.product_varient_edit');
	Route::post('/Varients/Update/', 'ProductController@productVarientUpdate')->name('admin.product_varient_update');

	Route::get('/Colors/Edit/{product_id}', 'ProductController@productColorEdit')->name('admin.product_Color_edit');
	Route::post('/Color/Update/', 'ProductController@productColorUpdate')->name('admin.product_color_update');
	Route::post('/New/Color/Add/', 'ProductController@productNewColorAdd')->name('admin.product_new_color_add');

	Route::get('/Status/Update/{product_id}/{status}', 'ProductController@productStatusUpdate')->name('admin.product_status_update');
});