<?php

namespace App\Http\Controllers\Web\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Seller;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Validator;
use SmsHelpers;


class UserController extends Controller
{
	public function userRegistrationForm()
	{
		return view('web.user.user_register');
	}

	public function userLoginForm()
	{
		return view('web.user.user_login');
	}
    public function userRegistration(Request $request)
    {
    	$validatedData = $request->validate([
	        'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:seller'],
            'password' => ['required', 'string', 'min:8', 'same:confirm_password'],
            'mobile' =>  ['required','digits:10','numeric','unique:seller'],
        ]);

        $seller = Seller::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'mobile' => $request->input('mobile'),
            'user_role' => 1,
        ]);


        if ($seller) {
            $seller_id = $seller->id;
            $seller_details = DB::table('seller_details')
            ->insert([
                'seller_id' => $seller_id,
            ]);

        	return redirect()->route('web.userLoginForm')->with('message','Thank You For Registering With Us Please Login To See The Action');
        }else{
        	return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }

    public function myProfileForm()
    {
        $user_id = Auth::guard('buyer')->id();
        $states = DB::table('state')
        ->whereNull('deleted_at')
        ->get();

        $user = DB::table('seller')
        ->where('id',$user_id)
        ->first();

        $user_details = DB::table('seller_details')
        ->where('seller_id',$user_id)
        ->first();

        $city = null;
        if (!empty($user_details->state_id)) {
            $city = DB::table('city')
            ->where('state_id',$user_details->state_id)
            ->get();
        }
        $user_data = [
            'user' => $user,
            'user_details' => $user_details,
            'city_list' => $city,
        ];
        // dd($states);
        $shipping_adress = DB::table('shipping_address')
            ->select('shipping_address.*','state.name as s_name','city.name as c_name')
            ->join('state','shipping_address.state_id','=','state.id')
            ->join('city','shipping_address.city_id','=','city.id')
            ->where('shipping_address.user_id',$user_id)
            ->whereNull('shipping_address.deleted_at')
            ->get();

    	return view('web.profile.my_profile',compact('states','user_data','shipping_adress'));
    }

    public function myProfileUpdate(Request $request)
    {
        $user_id = Auth::guard('buyer')->id();
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dob' => 'required',
            'gender' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required',
        ]);

        $user_update = Seller::where('id',$user_id)
            ->update([
                'name' => $request->input('name'),
            ]);
        $user_profile_update = DB::table('seller_details')
        ->where('seller_id',$user_id)
        ->update([
            'state_id' => $request->input('state'),
            'city_id' => $request->input('city'),
            'address' => $request->input('address'),
            'dob' => $request->input('dob'),
            'pin' => $request->input('pin'),
        ]);

        return redirect()->back()->with('message','Your Profile Has Been Updated Successfully');
    }

    public function changePassword(Request $request)
    {
         $validator = $request->validate([
            'current_pass' => 'required',
            'new_pass' => 'required',
            'confirm_pass' => 'required',     
          ]);
        if ($request->input('confirm_pass') != $request->input('new_pass')) {
            return 2;
        }
        if ($request->input('confirm_pass') == $request->input('current_pass')) {
            return 4;
        }
        if ( strlen($request->input('confirm_pass')) < 8) {
            return 3;
        }
        $user_id = Auth::guard('buyer')->id();
        $current_password = DB::table('seller')->where('id',$user_id)->first();
        if(Hash::check($request->input('current_pass'), $current_password->password)){           
            $password_change = DB::table('seller')
            ->where('id',$user_id)
            ->update([
                'password' => Hash::make($request->input('confirm_pass')),
            ]);

            return 1;
            
        }else{           
            return 0;
        }
    }

    public function checkout()
    {
        $user_id = Auth::guard('buyer')->id();

        $shipping_adress = DB::table('shipping_address')
            ->select('shipping_address.*','state.name as s_name','city.name as c_name')
            ->join('state','shipping_address.state_id','=','state.id')
            ->join('city','shipping_address.city_id','=','city.id')
            ->where('shipping_address.user_id',$user_id)
            ->whereNull('shipping_address.deleted_at')
            ->orderBy('shipping_address.id','desc')
            ->get();

        $state = DB::table('state')->whereNull('deleted_at')->get();
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



        $user_data = [
            'shipping_adress' => $shipping_adress,
            'cart_data' => $cart_data,
            'state' => $state,
        ];
        return view('web.checkout',compact('user_data'));
    }

    public function finalCheckout(Request $request)
    {
        $user_id = Auth::guard('buyer')->id();
        $validator = $request->validate([
            'payment_method' => 'required',
          ]);
        $shipping_adress_id = $request->input('address_id');
        $payment_method =  $request->input('payment_method');
        if (!isset($shipping_adress_id) && empty($shipping_adress_id)) {
            $validator = $request->validate([
                'state' => 'required',
                'city' => 'required',
                'pin' => 'required',   
                'address' => 'required',  
              ]);

            $insert_shipping = DB::table('shipping_address')
                ->insertGetId([
                    'state_id' => $request->input('state'),
                    'city_id' => $request->input('city'),
                    'pin' => $request->input('pin'),
                    'address' => $request->input('address'),
                    'user_id' => $user_id,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            if ($insert_shipping) {
                $shipping_adress_id = $insert_shipping;
            }else{
                return redirect()->back()->with('error','Something Went Wrong While Placing Your Order Please Try After Sometime');
            }
        }

        if ( isset($shipping_adress_id) && !empty($shipping_adress_id) ) {
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
                    $request_info = urldecode("Dear ".Auth::guard('buyer')->user()->name.", Your Order Has Been Placed Successfully We Wiill Process it Shortly. Thank You");
                    SmsHelpers::smsSend(Auth::guard('buyer')->user()->mobile,$request_info);

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
                    return redirect()->route('web.thankyou');
                }else{
                    $total_cost =  $total_amount;
                    $user_name = Auth::guard('buyer')->user()->name;
                    $user_email = Auth::guard('buyer')->user()->email;
                    $user_mobile = Auth::guard('buyer')->user()->mobile;

                    $api = new \Instamojo\Instamojo(
                        config('services.instamojo.api_key'),
                        config('services.instamojo.auth_token'),
                        config('services.instamojo.url')
                    );
                    try {
                        $response = $api->paymentRequestCreate(array(
                            "purpose" => "Ecommerce Bplus Payment",
                            "amount" => $total_cost,
                            "buyer_name" => $user_name,
                            "send_email" => true,
                            "email" => $user_email,
                            "phone" => $user_mobile,
                            "redirect_url" => route('web.pay_order_amount',['order_id'=>encrypt($order)]),
                            ));
            
                            DB::table('orders')
                                ->where('id',$order)
                                ->update([
                                    'payment_request_id' => $response['id'],
                                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                                ]);
                            
                            header('Location: ' . $response['longurl']);
                            exit();
                    }catch (Exception $e) {
                        print('Error: ' . $e->getMessage());
                    }
                } 
            }else{
                return redirect()->back()->with('error','Something Went Wrong While Placing Your Order Please Try After Sometime');
            }
        }else{
            return redirect()->back()->with('error','Something Went Wrong While Placing Your Order Please Try After Sometime');
        }
    }

    public function paySuccess(Request $request,$order_id)
    {
        try {
            $order_id = decrypt($order_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        try {
    
            $api = new \Instamojo\Instamojo(
                config('services.instamojo.api_key'),
                config('services.instamojo.auth_token'),
                config('services.instamojo.url')
            );
     
            $response = $api->paymentRequestStatus(request('payment_request_id'));
     
            if( !isset($response['payments'][0]['status']) ) {
             return redirect('web.order_history');
            } else if($response['payments'][0]['status'] != 'Credit') {
             return redirect('web.order_history');
            } 
          }catch (\Exception $e) {
             return redirect('web.order_history');
         }
        
        if($response['payments'][0]['status'] == 'Credit') {
 
             $user_id = Auth::guard('buyer')->user()->id;
             DB::table('orders')
                ->where('id', $order_id)
                ->where('user_id', $user_id)
                ->where('payment_request_id', $response['id'])
                ->update(['payment_id' => $response['payments'][0]['payment_id'], 'payment_status' => '2']);
            
            $request_info = urldecode("Dear ".Auth::guard('buyer')->user()->name.", Your Order Has Been Placed Successfully We Wiill Process it Shortly. Thank You");
            SmsHelpers::smsSend(Auth::guard('buyer')->user()->mobile,$request_info);

            //SMS Send To Seller
            $products = DB::table('order_details')
                ->select('products.name as p_name','seller.name as seller_name','seller.mobile as mobile')
                ->leftjoin('products','products.id','=','order_details.product_id')
                ->leftjoin('seller','seller.id','=','products.seller_id')
                ->where('order_details.order_id',$order_id)
                ->get();
            foreach ($products as $key => $value) {
                $request_info = urldecode("Dear ".$value->seller_name.", Order of ".$value->p_name." Has Been Placed By a Customer From Bplus Keep Your Product Ready and wait for further update . Thank You");
                SmsHelpers::smsSend($value->mobile,$request_info);
            }
            return redirect()->route('web.thankyou');
        } 
    }

    public function orderList()
    {
        $user_id = Auth::guard('buyer')->id();
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
       
        // dd($order_data);
        return view('web.order_history',compact('order_data'));
    }

    public function orderStatus($order_details_id)
    {
        try {
            $order_id = decrypt($order_details_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        DB::table('order_details')
            ->where('id',$order_id)
            ->update([
                'status' => 3,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back();
    }

    public function sellerRequestForm()
    {
        $user_id = Auth::guard('buyer')->id();
        $states = DB::table('state')
        ->whereNull('deleted_at')
        ->get();

        $user = DB::table('seller')
        ->where('id',$user_id)
        ->first();

        $user_details = DB::table('seller_details')
        ->where('seller_id',$user_id)
        ->first();

        $city = null;
        if (!empty($user_details->state_id)) {
            $city = DB::table('city')
            ->where('state_id',$user_details->state_id)
            ->get();
        }
        $user_data = [
            'user' => $user,
            'user_details' => $user_details,
            'city_list' => $city,
        ];
        // dd($states);
        return view('web.seller.sell_on_bplus1',compact('states','user_data'));
    }

    public function sellerApplicationSubmit(Request $request)
    {
        $user_id = Auth::guard('buyer')->id();
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dob' => 'required',
            'gender' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'bank_name' => 'required',
            'branch_name' => 'required',
            'account_no' => 'required',
            'ifsc' => 'required',
        ]);

        $user_update = Seller::where('id',$user_id)
            ->update([
                'name' => $request->input('name'),
                'user_role' => 2,
                'verification_status' => 2,
            ]);
        $user_profile_update = DB::table('seller_details')
            ->where('seller_id',$user_id)
            ->update([
                'state_id' => $request->input('state'),
                'city_id' => $request->input('city'),
                'address' => $request->input('address'),
                'dob' => $request->input('dob'),
                'gender' => $request->input('gender'),
                'pin' => $request->input('pin'),
            ]);
        $user_bank = DB::table('seller_bank')
            ->insert([
                'seller_id' => $user_id,
                'bank_name' => $request->input('bank_name'),
                'branch_name' => $request->input('branch_name'),
                'account' => $request->input('account_no'),
                'ifsc' => $request->input('ifsc'),
                'micr' => $request->input('micr'),
            ]);
        return redirect()->route('seller_application')->with('message','Seller Application Has Been Sent Successfully Please Login To See The Action');
    }

    public function shippingAddress()
    {
        $user_id = Auth::guard('buyer')->id();

        $shipping_adress = DB::table('shipping_address')
            ->select('shipping_address.*','state.name as s_name','city.name as c_name')
            ->join('state','shipping_address.state_id','=','state.id')
            ->join('city','shipping_address.city_id','=','city.id')
            ->where('shipping_address.user_id',$user_id)
            ->whereNull('shipping_address.deleted_at')
            ->get();
    }

    public function shippingAddressUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'address' => 'required',
            'address_id' => 'required',
        ]);

        if ($validator->fails()) {
            return 2;
        }

        $update = DB::table('shipping_address')
            ->where('id',$request->input('address_id'))
            ->update([
                'state_id' => $request->input('state'),
                'city_id' => $request->input('city'),
                'pin' => $request->input('pin'),
                'address' => $request->input('address'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return 1;
    }

    public function shippingAddressDelete($address_id)
    {
        try{
            $address_id  = decrypt($address_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        DB::table('shipping_address')
            ->where('id',$address_id)
            ->update([
                'deleted_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back();
    }

    public function shippingAddressAdd(Request $request)
    {
        $validatedData = $request->validate([
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'address' => 'required',
        ]);
        
        $user_id = Auth::guard('buyer')->id();
        DB::table('shipping_address')
            ->insert([
                'user_id' => $user_id,
                'state_id' => $request->input('state'),
                'city_id' => $request->input('city'),
                'pin' => $request->input('pin'),
                'address' => $request->input('address'),
            ]);
        return redirect()->back();
    }
}
