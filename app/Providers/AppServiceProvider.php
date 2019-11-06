<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use DB;
use Auth;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer('web.include.header', function ($view) {

            $category = DB::table('category')->whereNull('deleted_at')->where('status',1)->get();

            $category_list = [];
            $cart_data =[];

            foreach ($category as $key => $value) {
                $first_category = DB::table('first_category')
                ->where('category_id',$value->id)
                ->whereNull('deleted_at')
                ->where('status',1)
                ->get();

                $category_list[] = [
                    'id' => $value->id,
                    'name' => $value->name,
                    'image' => $value->image,
                    'first_category' => $first_category,
                ];
            }
            

            // Shopping Cart Data

            if( Auth::guard('buyer')->user() && !empty(Auth::guard('buyer')->user()->id)) 
            {
                $user_id = Auth::guard('buyer')->user()->id;
                $cart = DB::table('cart')->where('user_id',$user_id)->get();
                if (count($cart) > 0) {
                    foreach ($cart as $key => $item) {
                        $product = DB::table('products')->where('id',$item->product_id)
                            ->whereNull('deleted_at')
                            ->where('status',1)
                            ->first();
                        $cart_data[] = [
                            'product_id' => $product->id,
                            'title' => $product->name,
                            'image' => $product->main_image,
                            'quantity' => $item->quantity,
                            'price' => $product->price,
                           ];
                    }
                }else{
                    $cart_data = false;
                }

            }else{
                if (Session::has('cart') && !empty(Session::get('cart'))) {
                    $cart = Session::get('cart');
                    

                    if (count($cart) > 0) {
                        foreach ($cart as $product_id => $value) {
                            $product = DB::table('products')->where('id',$product_id)
                            ->whereNull('deleted_at')
                            ->where('status',1)
                            ->first();

                        ;
                           $cart_data[] = [
                            'product_id' => $product->id,
                            'title' => $product->name,
                            'image' => $product->main_image,
                            'quantity' => $value['quantity'],
                            'price' => $product->price,
                           ];
                        }
                    }else{
                        $cart_data = false;
                    }
                }else{
                    $cart_data = false;
                }
            }

            $header_data = [
                'category_list' => $category_list,
                'cart_data' => $cart_data,
            ];
            $view->with('header_data',$header_data);
        });
    }
}
