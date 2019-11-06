<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdminDeshboardController extends Controller
{
    public function index(){
    	$total_buyers = DB::table('seller')
    		->whereNull('deleted_at')
    		->where('user_role',1)
    		->count();
    	$total_sellers = DB::table('seller')
    		->whereNull('deleted_at')
    		->where('user_role',2)
    		->count();
    	$total_brands = DB::table('brands')
    		->whereNull('deleted_at')
    		->where('status',1)
    		->count();
    	$total_products = DB::table('products')
    		->whereNull('deleted_at')
    		->where('status',1)
			->count();
		$total_pending_orders = DB::table('order_details')
			->where('status',1)
			->distinct('order_id')
			->count('order_id');
		$total_delivered_orders = DB::table('order_details')
			->where('status',3)
			->distinct('order_id')
			->count('order_id');
    	$last_10_product = DB::table('products')
            ->select('products.*','category.name as c_name','first_category.name as first_c_name','second_category.name as second_c_name','brands.name as brand_name')
            ->whereNull('products.deleted_at')
            ->join('category','products.category','=','category.id')
            ->join('first_category','products.first_category','=','first_category.id')
            ->join('second_category','products.second_category','=','second_category.id')
            ->join('brands','products.brand_id','=','brands.id')
            ->orderBy('products.id','desc')
            ->limit(10)
            ->get();
        $last_10_users = DB::table('seller')
            ->whereNull('deleted_at')
            ->orderBy('id','desc')
            ->limit(10)
            ->get();
        $last_10_Brands = DB::table('brands')
        	->select('brands.*','category.name as c_name','first_category.name as first_c_name')
            ->whereNull('brands.deleted_at')
            ->join('category','brands.category','=','category.id')
            ->join('first_category','brands.first_category','=','first_category.id')
            ->orderBy('brands.id','desc')
            ->limit(10)
			->get();
		$last_10_orders = DB::table('order_details')
			->select('order_details.*','products.name as p_name')
			->join('products','products.id','=','order_details.product_id')
			->orderBy('order_details.id','desc')
            ->limit(10)
            ->get();
    	$data = [
    		'total_buyers'=>$total_buyers,
    		'total_sellers' => $total_sellers,
    		'total_brands' => $total_brands,
    		'total_products' => $total_products,
    		'last_10_product' => $last_10_product,
    		'last_10_users' => $last_10_users,
			'last_10_Brands' => $last_10_Brands,
			'total_delivered_orders' => $total_delivered_orders,
			'total_pending_orders' => $total_pending_orders,
			'last_10_orders' => $last_10_orders,
    	];
    	return view('admin.admindeshboard',compact('data'));
    }
}
