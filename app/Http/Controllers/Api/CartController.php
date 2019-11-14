<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Validator;

class CartController extends Controller
{
    public function cartAdd(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',   
            'color_id' => 'required',      
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error' => true,
                'error_message' => $validator->errors(),
    
            ];    	
            return response()->json($response, 200);
        }

        $user_id = $request->input('user_id');
        $product_id = $request->input('product_id');
    	$quantity = $request->input('quantity');
        $color = $request->input('color_id');

        // Check This Product Is already Exist in Cart Or Not
        $check_cart_product = DB::table('cart')
            ->where('product_id',$product_id)
            ->where('user_id',$user_id)
            ->count();

        if ($check_cart_product) {
            if ($check_cart_product > 0 ) {
                $response = [
                    'status' => false,
                    'message' => 'Product Alredy Added in Cart',
                    'error' => false,
                    'error_message' => null,
        
                ];    	
                return response()->json($response, 200);
            }
        }else{
            $cart_insert = DB::table('cart')
                ->insert([
                    'product_id' =>  $product_id,
                    'user_id' => $user_id,
                    'color_id' => $color,
                    'quantity' => $quantity,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            if ($cart_insert) {
                $response = [
                    'status' => true,
                    'message' => 'Product Added in The Cart',
                    'error' => false,
                    'error_message' => null,
        
                ];    	
                return response()->json($response, 200);
            }else{
                $response = [
                    'status' => false,
                    'message' => 'Something Went Wrong Please Try Again',
                    'error' => false,
                    'error_message' => null,
        
                ];    	
                return response()->json($response, 200);
            }
        }       
    }

    public function cartProducts($user_id)
    {
        $cart = DB::table('cart')->where('user_id',$user_id)
            ->select('cart.id as cart_id','cart.product_id as product_id','cart.color_id as color_id','cart.quantity as quantity','products.name as product_name','products.min_ord_qtty as min_ord_qtty','products.price as product_price','products.mrp as product_mrp','products.tag_name as product_tag_name','products.main_image as product_image','colors.name as color_name','colors.value as color_value')
            ->leftjoin('products','products.id','=','cart.product_id')
            ->leftjoin('colors','colors.id','=','cart.color_id')
            ->where('cart.user_id',$user_id)
            ->get();
        
        if (count($cart) > 0) {
            $response = [
                'status' => true,
                'message' => 'Cart Product List',
                'data' => $cart,
    
            ];    	
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => true,
                'message' => 'cart is Empty',
                'data' => [],    
            ];    	
            return response()->json($response, 200);
        }

    }

    public function cartUpdate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'cart_id' => 'required',
            'quantity' => 'required',         
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error' => true,
                'error_message' => $validator->errors(),
    
            ];    	
            return response()->json($response, 200);
        }

        $cart_update = DB::table('cart')
            ->where('id',$request->cart_id)
            ->update([
                'quantity' => $request->input('quantity'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($cart_update) {
            $response = [
                'status' => true,
                'message' => 'Cart Updated Successfully',
                'error' => false,
                'error_message' => null,
    
            ];    	
            return response()->json($response, 200);
        }else {
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong',
                'error' => false,
                'error_message' => null,
            ];    	
            return response()->json($response, 200);
        }
    }

    public function cartDelete($cart_id)
    {
        DB::table('cart')->where('id',$cart_id)->delete();
        $response = [
            'status' => true,
            'message' => 'Item Removed From Cart',
        ];    	
        return response()->json($response, 200);
    }
}
