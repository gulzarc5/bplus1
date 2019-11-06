<?php

Route::get('seller_login', function () {
    return view('web.seller.seller_login');
})->name('seller_login');

Route::group(['prefix'=>'Seller','namespace'=>'Seller'],function(){



	Route::post('/seller/Registration', 'SellerController@sellerRegistration')->name('seller.registration');
	Route::post('/Login', 'SellerLoginController@sellerLogin');
	Route::post('/logout', 'SellerLoginController@logout')->name('seller.logout');

	Route::group(['middleware'=>'auth:seller'],function(){

		require __DIR__.'/seller_product_routes.php';
	 
		Route::get('/Deshboard', 'SellerController@index')->name('seller.deshboard');

		Route::get('/MyProfile', 'SellerController@myProfileForm')->name('seller.MyprofileForm');
		Route::post('/MyProfile', 'SellerController@sellerUpdate')->name('seller.MyprofileUpdate');
		Route::get('/change/Password', 'SellerController@viewChangePasswordForm')->name('seller.change_password_form');
		Route::post('/change/Password', 'SellerController@ChangePassword')->name('seller.change_password');
		Route::get('/Orders', 'SellerController@orderList')->name('seller.order_list');
		Route::get('/ajax/Orders', 'SellerController@ajaxOrderList')->name('seller.ajax_order_list');
		Route::get('/Orders/Status/{order_details_id}/{status}', 'SellerController@orderUpdate')->name('seller.orderUpdate');

	});
});

