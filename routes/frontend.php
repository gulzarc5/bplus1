<?php

Route::group(['namespace'=> 'Web'], function(){

    Route::group(['namespace'=> 'Category'], function(){
        Route::get('/', 'CategoryController@index')->name('index_page');

        Route::get('Sub/Category/{first_id}', 'CategoryController@SecondCategory')->name('web.sub_category');
        Route::get('/First/Category/{main_category_id}', 'CategoryController@firstCategory')->name('web.first_category');
        
    });

     Route::group(['namespace'=> 'Product','prefix'=>'Product'], function(){
        Route::get('Sellers/{second_category}', 'ProductController@productSellerWithSecondCategory')->name('web.product_sellers');
        Route::get('Sellers/ajax/{second_category}', 'ProductController@ajaxproductSellerWithSecondCategory')->name('web.ajax_product_sellers');

        Route::get('/All/{seller_id}/{second_category}','ProductController@productView')->name('web.product_view');
        Route::get('/Details/{product_id}','ProductController@productDetails')->name('web.product_details');

        Route::post('/Filter/','ProductController@productFilter')->name('web.product_filter');
     });

     Route::group(['namespace'=> 'Cart','prefix'=>'Cart'], function(){
        Route::get('/shopping_cart', 'CartController@viewCart')->name('web.viewCart');
        Route::post('Add', 'CartController@AddCart')->name('web.add_cart');
        Route::post('/cartUpdate', 'CartController@updateCart')->name('web.updateCart');
        Route::get('/cart/item/remove/{p_id}','CartController@cartItemRemove')->name('cartItemRemove');

     });

     Route::group(['namespace'=> 'User','prefix'=>'User'], function(){
        Route::get('/user_register', 'UserController@userRegistrationForm')->name('web.userRegistrationForm');
        Route::get('/user_login', 'UserController@userLoginForm')->name('web.userLoginForm');
        Route::post('/user_login', 'LoginController@buyerLogin')->name('web.buyerLogin');
        Route::post('/Logout', 'LoginController@logout')->name('web.buyerLogout');

        Route::post('Add', 'UserController@userRegistration')->name('web.user_registration');

        Route::get('/Application', 'UserController@sellerRequestForm')->name('seller_application');
        Route::post('/Application/Submit', 'UserController@sellerApplicationSubmit')->name('web.seller_application_submit');

     });

     Route::group(['middleware'=>'auth:buyer','namespace'=> 'User','prefix'=>'User'], function(){

        Route::get('/my_profile', 'UserController@myProfileForm')->name('web.myprofile');
        Route::post('/my_profile/Update', 'UserController@myProfileUpdate')->name('web.myprofile_update');
        Route::post('/Chnage/Password', 'UserController@changePassword')->name('web.user_change_password');
        Route::get('/checkout', 'UserController@checkout')->name('web.checkout');
        Route::post('/checkout', 'UserController@finalCheckout')->name('web.final_checkout');
        Route::get('/order_history', 'UserController@orderList')->name('web.order_history');
        Route::get('/thankyou', function () {
            return view('web.thankyou');
        })->name('web.thankyou');

        Route::post('shipping/address/update','UserController@shippingAddressUpdate')->name('web.shipping_address_update');

        Route::get('shipping/address/delete/{address_id}','UserController@shippingAddressDelete')->name('web.shipping_address_delete');

        Route::post('shipping/address/add','UserController@shippingAddressAdd')->name('web.shipping_address_add');

     });
});





Route::get('/about_us', function () {
    return view('web.about_us');
});
Route::get('/contact_us', function () {
    return view('web.contact_us');
});
Route::get('/contact_us', function () {
    return view('web.contact_us');
});
Route::get('chat_history', function () {
    return view('web.chat.chat_history');
});
Route::get('chat', function () {
    return view('web.chat.chat');
});

Route::get('product_details', function () {
    return view('web.product.product_details');
});
Route::get('seller_register', function () {
    return view('web.seller.seller_register');
});

Route::get('/forgot_password', function () {
    return view('web.profile.forgot_password');
});

