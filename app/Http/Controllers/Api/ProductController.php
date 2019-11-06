<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ProductController extends Controller
{
    public function sellerListSecondCategory($second_category,$page)
    {
    	$limit = ($page*10)-10;
    	

    	$products_sellers=DB::table('products')
    	->select('products.seller_id as seller_id', 'seller.name as seller_name')
    	->join('seller','products.seller_id','=','seller.id')
    	->whereNull('products.deleted_at')
    	->where('products.status',1)
    	->where('products.second_category',$second_category)
    	->distinct()
    	->skip($limit)
    	->take(10)
    	->get();

    	$total_rows = clone $products_sellers;
    	$total_rows = $total_rows->count();
		$total_page = ceil($total_rows/10);

		$products = [];

    	foreach ($products_sellers as $products_Seller) {

    		$product_against_seller=DB::table('products')
	    	->whereNull('deleted_at')
	    	->where('status',1)
	    	->where('second_category',$second_category)
	    	->where('seller_id',$products_Seller->seller_id)
	    	->latest('id')
	    	->limit(10)
	    	->get();

            $seller_address = DB::table('seller_details')
            ->select('state.name as state_name','city.name as city_name')
            ->join('state','seller_details.state_id','=','state.id')
            ->join('city','seller_details.city_id','=','city.id')
            ->whereNull('seller_details.deleted_at')
            ->where('seller_details.seller_id',$products_Seller->seller_id)
            ->first();


    		$products[]=[
    			'seller_id' => $products_Seller->seller_id,
                'second_category' => $second_category,
    			'seller_name' => $products_Seller->seller_name,
                'seller_state' => $seller_address->state_name,
                'seller_city' => $seller_address->city_name,
    			'product' => $product_against_seller,
    		];
    	}

    	$response = [
            'status' => true,
            'current_page' =>$page,
            'total_page' =>$total_page,
            'message' => 'Reseller List',
            'data' => $products,

        ];
    	
    	return response()->json($response, 200);

    }


    public function productListSecondCategory($second_category,$seller_id,$page)
    {
    	// Filteration data
    	$seller_second_category = DB::table('products')
            ->select('products.seller_id as seller_id','products.second_category as second_category','second_category.name as category_name')
            ->join('second_category','products.second_category','=','second_category.id')
            ->whereNull('products.deleted_at')
            ->where('products.status',1)
            ->where('products.seller_id',$seller_id)
            ->distinct()
            ->get();

        $products_sellers=DB::table('products')
	        ->select('products.seller_id as seller_id', 'seller.name as seller_name')
	        ->join('seller','products.seller_id','=','seller.id')
	        ->whereNull('products.deleted_at')
	        ->where('products.status',1)
	        ->where('products.second_category',$second_category)
	        ->distinct()
	        ->get();

	    $products_brands=DB::table('products')
            ->select('brand_name.id as brand_id', 'brand_name.name as brand_name',DB::raw('count(*) as total'))
            ->join('brand_name','products.brand_id','=','brand_name.id')
            ->whereNull('products.deleted_at')
            ->where('products.status',1)
            ->where('products.second_category',$second_category)
            ->distinct()
            ->groupBy('brand_name.id','brand_name.name')
            ->get();
        $product_colors = DB::table('products')
            ->select('color.id as color_id','color.name as color_name','color.value as color_value',DB::raw('count(*) as total'))
            ->join('product_colors','products.id','=','product_colors.product_id')
            ->join('color','product_colors.color_id','=','color.id')
            ->where('products.second_category',$second_category)
            ->distinct('color.id')
            ->groupBy('color.id','color.name','color.value')
            ->get();

        $limit = ($page*10)-10;

        $product_min_max_price = DB::table('products')
            ->select(DB::raw('min(price) as min_price'),DB::raw('max(price) as max_price'))
            ->whereNull('deleted_at')
            ->where('status',1)
            ->where('second_category',$second_category)
            ->where('seller_id',$seller_id)
            ->first();

        $product_against_seller=DB::table('products')
            ->whereNull('deleted_at')
            ->where('status',1)
            ->where('second_category',$second_category)
            ->where('seller_id',$seller_id)
            ->latest('id')
            ->skip($limit)
            ->take(12)
            ->get();

        $total_rows = clone $product_against_seller;
    	$total_rows = $total_rows->count();
		$total_page = ceil($total_rows/12);
      
		$data = [
			'filter_data' =>[
				'second_category' => $seller_second_category,
				'sellers' => $products_sellers,
				'brands' => $products_brands,
				'colors' => $product_colors,
                'price_range' => $product_min_max_price,
			],
			'products' => $product_against_seller,
		];


		$response = [
            'status' => true,
            'current_page' =>$page,
            'total_page' =>$total_page,
            'message' => 'Product List',
            'data' => $data,

        ];

        return response()->json($response, 200);
    }

    public function productImage($image_name)
    {
        $path =  public_path('images/product/').$image_name;

        if (file_exists($path)) {
            $mime = \File::mimeType($path);

            header('Content-type: '.$mime);

            return readfile($path);
        }else{
            return 0;
        }        
    }

    public function productImageThumb($image_name)
    {
        $path =  public_path('images/product/thumb/').$image_name;

        if (file_exists($path)) {
            $mime = \File::mimeType($path);

            header('Content-type: '.$mime);

            return readfile($path);
        }else{
            return 0;
        }        
    }

    public function singleProductView($product_id)
    {        

        $product=DB::table('products')
        ->select('products.*','brand_name.name as brand_name')
        ->join('brand_name','brand_name.id','=','products.brand_id')
        ->whereNull('products.deleted_at')
        ->where('products.status',1)
        ->where('products.id',$product_id)
        ->first();

        $seller_details = DB::table('seller')
        ->select('seller.name as seller_name','state.name as state_name','city.name as city_name')
        ->join('seller_details','seller.id','=','seller_details.seller_id')
        ->join('state','seller_details.state_id','=','state.id')
        ->join('city','seller_details.city_id','=','city.id')
        ->where('seller.id',$product->seller_id)
        ->first();

        $product_images = DB::table('product_image')
        ->where('product_id',$product_id)
        ->whereNull('deleted_at')
        ->where('status',1)
        ->get();
        $product_color = DB::table('product_colors')
        ->select('product_colors.id as color_id','color.name as color_name','color.value as color_value')
        ->join('color','product_colors.color_id','color.id')
        ->where('product_colors.product_id',$product_id)
        ->where('product_colors.status','1')
        ->whereNull('product_colors.deleted_at')
        ->get();
        

        $data = [
            'product' => $product,
            'product_images' => $product_images,
            'product_color'=> $product_color,
            'seller_details' => $seller_details,
        ];


        $response = [
            'status' => true,
            'message' => 'Product Details',
            'data' => $data,

        ];

        return response()->json($response, 200);
    }
}
