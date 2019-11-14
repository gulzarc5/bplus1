<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Seller;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function userCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:seller'],
            'password' => ['required', 'string', 'min:8', 'same:confirm_password'],
            'mobile' =>  ['required','digits:10','numeric','unique:seller'],
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),    
            ];    	
            return response()->json($response, 200);
        }

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

            $response = [
                'status' => true,
                'message' => 'User Account Created Successfully',
                'error_code' => false,
                'error_message' => null,
            ];    	
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'Sorry Something Went Wrong',
                'error_code' => false,
                'error_message' => null,
            ];    	
            return response()->json($response, 200);
        }
    }

    public function userLogin(Request $request)
    {
        $user_email = $request->input('email');
        $user_pass = $request->input('password');
        
        if (!empty($user_email) && !empty($user_pass)) {
            $user = Seller::where('email',$user_email)->first();
           
            if ($user) {
                if(Hash::check($user_pass, $user->password)){ 
                   
                    $user_update = Seller::where('id',$user->id)
                        ->update([
                        'api_token' => Str::random(60),
                        ]);
                    $user = Seller::where('id',$user->id)->first();
                    
                    $response = [
                        'status' => true,
                        'message' => 'User Logged In Successfully',    
                        'data' => $user,
                    ];    	
                    return response()->json($response, 200);
                }else{
                    $response = [
                        'status' => false,
                        'message' => 'Email or password Wrong',   
                        'data' => null,
                    ];    	
                    return response()->json($response, 200);
                }
            }else{
                $response = [
                    'status' => false,
                    'message' => 'Email or password Wrong',  
                    'data' => null,  
                ];    	
                return response()->json($response, 200);
            }
        }else{
            $response = [
                'status' => false,
                'message' => 'Required Field Can Not be Empty',  
                'data' => null,  
            ];    	
            return response()->json($response, 200);
        }
    }

    public function myProfile($user_id)
    {
        $user = DB::table('seller')
        ->select('id','name','email','mobile')
        ->where('id',$user_id)
        ->first();

        $user_profile = DB::table('seller_details')
            ->select('seller_details.*','city.name as c_name','state.name as s_name')
            ->leftjoin('state','state.id','=','seller_details.state_id')
            ->leftjoin('city','city.id','=','seller_details.city_id')
            ->where('seller_details.seller_id',$user_id)
            ->whereNull('seller_details.deleted_at')
            ->first();


        $city = null;
        if (!empty($user_address->state_id)) {
            $city = DB::table('city')
            ->where('state_id',$user_address->state_id)
            ->get();
        }
        $user_data = [
            'user' => $user,
            'user_profile' => $user_profile,
        ];
        if ($user_profile) {
            $response = [
                'status' => true,
                'message' => 'User Profile Details',
                'data' => $user_data,
            ];    	
        }else{
            $response = [
                'status' => false,
                'message' => 'User Profile Details Not Found',
                'data' => $user_data,
            ];    	
        }
       
    	return response()->json($response, 200);
    }

    public function myProfileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'address' => 'required',
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

        $user_update = DB::table('seller')
            ->where('id',$user_id)
            ->update([
                'name' => $request->input('name'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        $profile_update = DB::table('seller_details')
            ->where('seller_id',$user_id)
            ->update([
                'state_id' => $request->input('state'),
                'city_id' => $request->input('city'),
                'pin' => $request->input('pin'),
                'address' => $request->input('address'),
                'dob' => $request->input('dob'),
                'pan' => $request->input('pan'),
                'gender' => $request->input('gender'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($user_update) {
            $response = [
                'status' => true,
                'message' => 'Profile Updated SuccessFully',
                'error' => false,
                'error_message' => [],
    
            ];    	
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong Please Try Again',
                'error' => false,
                'error_message' => [],
    
            ];    	
            return response()->json($response, 200);
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'current_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8','same:confirm_password'],
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

        $user = DB::table('seller')->where('id',$request->input('user_id'))->first();

        if(Hash::check($request->input('current_password'), $user->password)){           
            $password_change = DB::table('seller')
            ->where('id',$request->input('user_id'))
            ->update([
                'password' => Hash::make($request->input('new_password')),
            ]);
            $response = [
                'status' => true,
                'message' => 'Password Changed Successfully',
                'error' => false,
                'error_message' => null,
    
            ];    	
            return response()->json($response, 200);
            
        }else{           
            $response = [
                'status' => false,
                'message' => 'Current Password Does Not Matched',
                'error' => false,
                'error_message' => null,
    
            ];    	
            return response()->json($response, 200);
       }
    }

    public function addShippingAddress(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'address' => 'required',
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

        $shipping_add = DB::table('shipping_address')
        ->insert([
            'user_id' => $request->input('user_id'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'state_id' => $request->input('state'),
            'city_id' => $request->input('city'),
            'address' => $request->input('address'),
            'pin' => $request->input('pin'),
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
        ]);
        if ($shipping_add) {
            $response = [
                'status' => true,
                'message' => 'Shipping Address Added Successfully',
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

    public function ShippingAddressList($user_id)
    {
        $shipping_address = DB::table('shipping_address')
            ->select('shipping_address.*','state.name as s_name','city.name as c_name')
            ->leftjoin('state','state.id','=','shipping_address.state_id')
            ->leftjoin('city','city.id','=','shipping_address.city_id')
            ->where('shipping_address.user_id',$user_id)
            ->whereNull('shipping_address.deleted_at')
            ->orderBy('shipping_address.id','desc')
            ->get();
        if ($shipping_address->count() > 0) {
            $response = [
                'status' => true,
                'message' => 'Shipping Address List',
                'data' => $shipping_address,
            ];    	
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'No Shipping Address Found Please Add New',
                'data' => [],
            ];    	
            return response()->json($response, 200);
        }
    }

    public function ShippingAddressSingle($address_id)
    {
        $shipping_address = DB::table('shipping_address')
            ->select('shipping_address.*','state.name as s_name','city.name as c_name')
            ->leftjoin('state','state.id','=','shipping_address.state_id')
            ->leftjoin('city','city.id','=','shipping_address.city_id')
            ->where('shipping_address.id',$address_id)
            ->whereNull('shipping_address.deleted_at')
            ->first();
        if ($shipping_address) {
            $response = [
                'status' => true,
                'message' => 'Shipping Address By Id',
                'data' => $shipping_address,
            ];    	
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'No Address Found',
                'data' => $shipping_address,
            ];    	
            return response()->json($response, 200);
        }
    }

    public function ShippingAddressUpdate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'shipping_address_id' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'address' => 'required',
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

        $shipping_update = DB::table('shipping_address')
            ->where('id',$request->input('shipping_address_id'))
            ->update([
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'state_id' => $request->input('state'),
                'city_id' => $request->input('city'),
                'address' => $request->input('address'),
                'pin' => $request->input('pin'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($shipping_update) {
            $response = [
                'status' => true,
                'message' => 'Shipping Address Updated Successfully',
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

    public function ShippingAddressDelete($address_id)
    {
        $shipping_address_delete = DB::table('shipping_address')
            ->where('id',$address_id)
            ->update([
                'deleted_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($shipping_address_delete) {
            $response = [
                'status' => true,
                'message' => 'Shipping Address Deleted Successfully',
            ];    	
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong Please Try Again',
            ];    	
            return response()->json($response, 200);
        }
    }
}
