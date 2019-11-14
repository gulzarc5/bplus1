<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Validator;
use SmsHelpers;

class OrderController extends Controller
{
    public function orderPlace(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',  
            'payment_method' => 'required',
            'address_id' => 'required',  
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'pay_status' => false,
                'error' => true,
                'data' => null,
                'error_message' => $validator->errors(),
    
            ];    	
            return response()->json($response, 200);
        }
        $shipping_adress_id = $request->input('address_id');
        $user_id = $request->input('user_id');
        $payment_method = $request->input('payment_method');
        $order = DB::table('orders')
            ->insertGetId([
                'user_id' => $user_id,
                'payment_method' => $payment_method,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($order) {
            $cart = DB::table('cart')
                ->select('cart.*','products.price as p_price')
                ->join('products','cart.product_id','=','products.id')
                ->where('user_id',$user_id)
                ->get();
            $total_amount = 0;

            foreach ($cart as $product) {
                $seller_id = null;
                $seller = DB::table('products')->where('id',$product->product_id)->first();
                $cart = DB::table('order_details')
                    ->insert([
                        'user_id'=>$user_id,
                        'seller_id' => $seller->seller_id,
                        'order_id' => $order,
                        'product_id' => $product->product_id,
                        'color_id' => $product->color_id,
                        'quantity' => $product->quantity,
                        'price' => $product->p_price,
                        'total' => ($product->p_price * $product->quantity),
                        'shipping_address_id' => $shipping_adress_id,
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
                $total_amount +=  ($product->p_price * $product->quantity);
            }

            $order_update = DB::table('orders')
                ->where('id',$order)
                ->update([
                    'amount' => $total_amount,
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            if($order_update){
                DB::table('cart')->where('user_id',$user_id)->delete();
            }

            if ($payment_method == '1') {
                //SMS Send To Buyer
                $user_mobile = DB::table('seller')->select('mobile','name')->where('id',$user_id)->first();
                $request_info = urldecode("Dear ".$user_mobile->name.", Your Order Has Been Placed Successfully We Wiill Process it Shortly. Thank You");
                SmsHelpers::smsSend($user_mobile->mobile,$request_info);

                //SMS Send To Seller
                $products = DB::table('order_details')
                    ->select('products.name as p_name','seller.name as seller_name','seller.mobile as mobile')
                    ->leftjoin('products','products.id','=','order_details.product_id')
                    ->leftjoin('seller','seller.id','=','products.seller_id')
                    ->where('order_details.order_id',$order)
                    ->get();
                foreach ($products as $key => $value) {
                    $request_info = urldecode("Dear ".$value->seller_name.", Order of ".$value->p_name." Has Been Placed By a Customer From Bplus Keep Your Product Ready and wait for further update . Thank You");
                    SmsHelpers::smsSend($value->mobile,$request_info);
                }
               $order_data = DB::table('orders')->where('id',$order)->first();
                $response = [
                    'status' => true,
                    'message' => 'Order Placed Successfully',
                    'pay_status' => false,
                    'error' => false,
                    'data' => $order_data,
                    'error_message' => null,        
                ];    	
                return response()->json($response, 200);

            }else{
                $order_data = DB::table('orders')->where('id',$order)->first();
                $response = [
                    'status' => true,
                    'message' => 'Order Placed Pay Online',
                    'pay_status' => true,
                    'amount' => $total_amount,
                    'error' => false,
                    'data' => $order_data,
                    'error_message' => null,
        
                ];    	
                return response()->json($response, 200);
            } 
        } else {
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong Please Try Again',
                'pay_status' => false,
                'error' => false,
                'data' => null,
                'error_message' => null,
    
            ];    	
            return response()->json($response, 200);
        }
        
    }

    public function updatePaymentRequestId(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'order_id' => 'required',  
            'payment_request_id' => 'required',  
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
        $order_id = $request->input('order_id');
        $payment_request_id = $request->input('payment_request_id');

        $order_update = DB::table('orders')
                ->where('id',$order_id)
                ->update([
                    'payment_request_id' => $payment_request_id,
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
        if($order_update){
            $response = [
                'status' => true,
                'message' => 'Payment Request Id Updated Successfully',
                'error' => false,
                'error_message' => null,    
            ];    	
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong',
                'error' => false,
                'error_message' => null,
            ];    	
            return response()->json($response, 200);
        }
    }

    public function updatePaymentId(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'order_id' => 'required',  
            'payment_request_id' => 'required',  
            'payment_id' => 'required',
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

        $order_id = $request->input('order_id');
        $payment_request_id = $request->input('payment_request_id');
        $payment_id = $request->input('payment_id');

        $order_update = DB::table('orders')
                ->where('id',$order_id)
                ->where('payment_request_id',$payment_request_id)
                ->update([
                    'payment_id' => $payment_id,
                    'payment_status' => '2',
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
        if($order_update){
            $response = [
                'status' => true,
                'message' => 'Payment Id Updated Successfully',
                'error' => false,
                'error_message' => null,    
            ];    	
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong',
                'error' => false,
                'error_message' => null,
            ];    	
            return response()->json($response, 200);
        }
    }

    public function orderHistory($user_id)
    {
        $order = DB::table('orders')->where('user_id',$user_id)
        ->orderBy('id','desc')->get();

        $order_data = [];
        foreach ($order as $orders) {
            $order_details =DB::table('order_details')
                ->select('order_details.*','products.name as p_name','orders.payment_method as payment_method','orders.payment_status as payment_status')
                ->leftjoin('products','products.id','=','order_details.product_id')
                ->leftjoin('orders','orders.id','=','order_details.order_id')
                ->where('order_details.user_id',$user_id)
                ->where('order_details.order_id',$orders->id)
                ->get();
            $order_id = $orders->id;
            $order_data[] = [
                'order_id' => $order_id,
                'order_details' => $order_details,
            ];
        }
        $response = [
            'status' => true,
            'message' => 'Order History',
            'data' => $order_data,
        ];    	
        return response()->json($response, 200);

    }

    public function orderCancel($order_details_id)
    {
        $order_cancel = DB::table('order_details')
            ->where('id',$order_details_id)
            ->update([
                'status' => 3,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($order_cancel) {
            $response = [
                'status' => true,
                'message' => 'Order Cancelled Successfully',
            ];    	
            return response()->json($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong',
            ];    	
            return response()->json($response, 200);
        }
        
    }
}
