<?php

namespace App\Http\Controllers\Web\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
use Carbon\Carbon;

class CartController extends Controller
{
    public function viewCart()
    {
        if( Auth::guard('buyer')->user() && !empty(Auth::guard('buyer')->user()->id)) {
            $cart_data =[];
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

            return view('web.shopping_cart',compact('cart_data'));
        }else{
            if (Session::has('cart') && !empty(Session::get('cart'))) {
                $cart = Session::get('cart');
                $cart_data =[];

                if (count($cart) > 0) {
                    foreach ($cart as $product_id => $value) {
                        $product = DB::table('products')->where('id',$product_id)
                        ->whereNull('deleted_at')
                        ->where('status',1)
                        ->first();

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

            return view('web.shopping_cart',compact('cart_data'));
        }

         
    }
    public function AddCart(Request $request)
    {
    	$product_id = $request->input('product_id');
    	$quantity = $request->input('quantity');
    	$color = $request->input('color');

    	try{
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        //*********************if user is logged in*********************
        if( Auth::guard('buyer')->user() && !empty(Auth::guard('buyer')->user()->id)) {
            $user_id = Auth::guard('buyer')->user()->id;

            // Check This Product Is already Exist in Cart Or Not
            $check_cart_product = DB::table('cart')
                ->where('product_id',$product_id)
                ->where('user_id',$user_id)
                ->count();

            if ($check_cart_product) {
                if ($check_cart_product > 0 ) {
                    return redirect()->route('web.viewCart');
                }
            }

            $cart_insert = DB::table('cart')
             ->insert([
                    'product_id' =>  $product_id,
                    'user_id' => Auth::guard('buyer')->user()->id,
                    'color_id' => $color,
                    'quantity' => $quantity,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
             return redirect()->route('web.viewCart');
        }else{
            //***************If Guest User***************
            if (Session::has('cart') && !empty(Session::get('cart'))) {
                $cart = Session::get('cart');
                $cart[$product_id] =[
                     'quantity' => $quantity,
                     'color' => $color,
                 ];
            }else{
                $cart = [
                    $product_id => [
                     'quantity' => $quantity,
                     'color' => $color,
                    ],
                ];
            }
            Session::put('cart', $cart);
            Session::save();

            return redirect()->route('web.viewCart');
        }

        

        
        // dd(session()->all());
       // Session::forget('cart.'.$product_id);

        dd(Session::get('cart'));
    }

    public function updateCart(Request $request)
    {
        $validatedData = $request->validate([
            'p_id' => 'required',
            'quantity' => ['required', 'numeric'],
        ]);

        $product_id = $request->input('p_id');
        $quantity = $request->input('quantity');

        try{
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        //**********Minimum Order Quantity Check**************
        $product = DB::table('products')->where('id',$product_id)->first();
        if ($product && ($product->min_ord_qtty > 0)) {
            if ($quantity < $product->min_ord_qtty) {
                return redirect()->route('web.viewCart')->with('error',"Sorry Minimum Order Quantity Can Not Be Less Then  $product->min_ord_qtty ");
            }
        }
        if (Auth::guard('buyer')->user() && !empty(Auth::guard('buyer')->user()->id)) {
            $user_id = Auth::guard('buyer')->user()->id;

            $updateCart = DB::table('cart')
            ->where('user_id',$user_id)
            ->where('product_id',$product_id)
            ->update([
                    'quantity' => $quantity
                ]);
            return redirect()->route('web.viewCart')->with('message','Cart Updated Successfully');
        }elseif(Session::has('cart') && !empty(Session::get('cart'))){
            $cart = Session::get('cart');
            $item = $cart[$product_id]['quantity'] = $quantity;

            Session::put('cart', $cart);
            Session::save();
            return redirect()->route('web.viewCart')->with('message','Cart Updated Successfully');
        }

    }

    public function cartItemRemove($product_id)
    {
        try{
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        if (Auth::guard('buyer')->user() && !empty(Auth::guard('buyer')->user()->id)) {
            $user_id = Auth::guard('buyer')->user()->id;
            $delete_cart = DB::table('cart')
            ->where('user_id',$user_id)
            ->where('product_id',$product_id)
            ->delete();
            return redirect()->route('web.viewCart')->with('message','Product Removed From Cart');
        }elseif(Session::has('cart') && !empty(Session::get('cart'))){
            Session::forget('cart.'.$product_id);
            return redirect()->route('web.viewCart')->with('message','Product Removed From Cart');
        }


    }
}
