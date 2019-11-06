<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Seller;
use DB;
use Auth;
use Carbon\Carbon;

class SellerController extends Controller
{
    public function sellerRegistration(Request $request)
    {
    	$validatedData = $request->validate([
	        'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:seller'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile' =>  ['required','digits:10','numeric','unique:seller'],
        ]);

        $seller = Seller::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'mobile' => $request->input('mobile'),
            'user_role' => 2,
        ]);


        if ($seller) {

            $seller_id = $seller->id;

            $seller_details = DB::table('seller_details')
            ->insert([
                'seller_id' => $seller_id,
            ]);

            $bank_details = DB::table('seller_bank')
            ->insert([
                'seller_id' => $seller_id,
            ]);


        	return redirect()->route('seller_login')->with('message','Thank You For Registering With Us Please Login To See The Action');
        }else{
        	return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }

    public function index(){
        $user_id = Auth::guard('seller')->user()->id;
        $last_10_product = DB::table('products')
            ->select('products.*','category.name as c_name','first_category.name as first_c_name','second_category.name as second_c_name','brands.name as brand_name')
            ->whereNull('products.deleted_at')
            ->where('products.seller_id',$user_id)
            ->join('category','products.category','=','category.id')
            ->join('first_category','products.first_category','=','first_category.id')
            ->join('second_category','products.second_category','=','second_category.id')
            ->join('brands','products.brand_id','=','brands.id')
            ->orderBy('products.id','desc')
            ->limit(10)
            ->get();
        
        $last_10_orders = DB::table('order_details')
            ->select('order_details.*','products.name as p_name')
            ->join('products','products.id','=','order_details.product_id')
            ->where('order_details.seller_id',$user_id)
            ->orderBy('order_details.id','desc')
            ->limit(10)
            ->get();
        $total_products = DB::table('products')
    		->whereNull('deleted_at')
            ->where('status',1)
            ->where('seller_id',$user_id)
            ->count();
        $total_orders = DB::table('order_details')
            ->where('seller_id',$user_id)
            ->count();
        $pending_orders = DB::table('order_details')
            ->where('seller_id',$user_id)
            ->where('status',1)
            ->count();
        $delivered_orders = DB::table('order_details')
            ->where('seller_id',$user_id)
            ->where('status',3)
			->count();
        $data = [
            'last_10_product' => $last_10_product,
            'last_10_orders' => $last_10_orders,
            'total_products' => $total_products,
            'total_orders' => $total_orders,
            'pending_orders' => $pending_orders,
            'delivered_orders' => $delivered_orders,
        ];
        return view('seller.seller_deshboard',compact('data'));
    }

    public function myProfileForm()
    {
        $seller_id = Auth::guard('seller')->user()->id;
        $seller = DB::table('seller')
        ->select('seller.name as name','seller.email as email', 'seller.mobile as mobile','seller_details.dob as dob','seller_details.pan as pan', 'seller_details.gst as gst','seller_details.gender as gender','seller_details.state_id as state', 'seller_details.city_id as city','seller_details.pin as pin','seller_details.address as address','seller_bank.bank_name as bank_name','seller_bank.branch_name as branch_name','seller_bank.account as account','seller_bank.ifsc as ifsc','seller_bank.micr as micr')
        ->join('seller_bank','seller.id','=','seller_bank.seller_id')
        ->join('seller_details','seller.id','=','seller_details.seller_id')
        ->where('seller.id',$seller_id)
        ->first();

        $state = DB::table('state')->whereNull('deleted_at')->get();

        $city = null;
        if (!empty($seller->state)) {
            $city = DB::table('city')
            ->where('state_id',$seller->state)
            ->get();
        }
        
        return view('seller.profile.myprofile',compact('seller','state','city'));
    }

    public function sellerUpdate(Request $request)
    {
        $seller_id = Auth::guard('seller')->user()->id;

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile' =>  ['required','digits:10','numeric'],
            'pan' => 'required',
            'gst' => 'required',
            'gender' => 'required',
            'pin' => 'required',
            'state' => 'required',
            'city' => 'required',
            'bank_name' => 'required',
            'branch_name' => 'required',
            'account_no' => 'required',
            'ifsc' => 'required',
        ]);

        $seller = DB::table('seller')
        ->where('id',$seller_id)
        ->update([
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'verification_status'=>2,
        ]);

        $seller_details = DB::table('seller_details')
        ->where('seller_id',$seller_id)
        ->update([
            'state_id' => $request->input('state'),
            'city_id' => $request->input('city'),
            'address' => $request->input('address'),
            'pin' => $request->input('pin'),
            'gst' => $request->input('gst'),
            'pan' => $request->input('pan'),
            'dob' => $request->input('dob'),
            'gender' => $request->input('gender'),
        ]);

        $seller_bank = DB::table('seller_bank')
        ->where('seller_id',$seller_id)
        ->update([
            'bank_name' => $request->input('bank_name'),
            'branch_name' => $request->input('branch_name'),
            'account' => $request->input('account_no'),
            'ifsc' => $request->input('ifsc'),
            'micr' => $request->input('micr'),
        ]);

        return redirect()->back();

    }

    public function viewChangePasswordForm()
    {
        return view('seller.profile.change_password');
    }

    public function ChangePassword(Request $request)
    {
        $validatedData = $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8','same:new_password'],
            'confirm_password' => ['required', 'string', 'min:8', 'same:new_password'],
        ]);

        $current_password = Auth::guard('seller')->user()->password;   

        if(Hash::check($request->input('current_password'), $current_password)){           
            $user_id = Auth::guard('seller')->user()->id; 
            $password_change = DB::table('seller')
            ->where('id',$user_id)
            ->update([
                'password' => Hash::make($request->input('confirm_password')),
            ]);

            return redirect()->back()->with('message','Your Password Changed Successfully');
            
        }else{           
            return redirect()->back()->with('error','Sorry Current Password Does Not matched');
       }
    }
    
    public function orderList()
    {
        return view('seller.orders.seller_order');
    }

    public function ajaxOrderList()
    {
        $seller_id = Auth::guard('seller')->id();
        $query = DB::table('order_details')
        ->select('order_details.*','products.name as p_name')
        ->join('products','products.id','=','order_details.product_id')
        ->where('products.seller_id',$seller_id)
        ->orderBy('order_details.id','desc');
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '<a href="'.route('seller.product_view', ['product_id' =>encrypt($row->product_id)]).'" class="btn btn-info btn-sm" target="_blank">View Product</a>';
                   if ($row->status == '1') {
                       $btn .= '<a href="'.route('seller.orderUpdate',['order_details_id' =>encrypt($row->id),'status' =>encrypt(2)]).'" class="btn btn-warning btn-sm">Shipped</a>
                       <a href="'.route('seller.orderUpdate', ['order_details_id' =>encrypt($row->id),'status' =>encrypt(4)]).'" class="btn btn-danger btn-sm">Cancel</a>';
                        return $btn;
                    }elseif($row->status == '2'){
                        $btn .= '<a href="'.route('seller.orderUpdate',['order_details_id' =>encrypt($row->id),'status' =>encrypt(3)]).'" class="btn btn-primary btn-sm">Delivered</a>
                        <a href="'.route('seller.orderUpdate', ['order_details_id' =>encrypt($row->id),'status' =>encrypt(4)]).'" class="btn btn-danger btn-sm">Cancel</a>';
                         return $btn;
                    }else{
                        $btn .= '<a  class="btn btn-success btn-sm">Order Processed</a>';
                         return $btn;
                     }
                    return $btn;
            })
            ->addColumn('status_tab', function($row){
                if ($row->status == '1') {
                   $btn = '<a href="#" class="btn btn-warning btn-sm">Pending</a>';
                    return $btn;
                }elseif($row->status == '2'){
                   $btn = '<a href="#" class="btn btn-info btn-sm">Dispatched</a>';
                    return $btn;
                }elseif($row->status == '3'){
                    $btn = '<a href="#" class="btn btn-primary btn-sm">Delivered</a>';
                     return $btn;
                 }else{
                    $btn = '<a href="#" class="btn btn-danger btn-sm">Cancelled</a>';
                     return $btn;
                 }
            })
            ->addColumn('total', function($row){
                $total = $row->price * $row->quantity;
                return $total;
            })
            ->addColumn('date', function($row){
                $date = $row->created_at;
                $date = Carbon::parse($row->created_at)->toDayDateTimeString();
                return $date;
            })
            ->rawColumns(['action','status_tab'])
            ->toJson();
    }

    public function orderUpdate($order_details_id,$status)
    {
       
        try {
            $order_details_id = decrypt($order_details_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        
        $update_order = DB::table('order_details')
            ->where('id',$order_details_id)
            ->update([
                'status' => $status,
                'updated_at' =>  Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back()->with('message','Order Status Updated Successfully');
    }
}
