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
            ->select('brands.id as brand_id', 'brands.name as brand_name',DB::raw('count(*) as total'))
            ->join('brands','products.brand_id','=','brands.id')
            ->whereNull('products.deleted_at')
            ->where('products.status',1)
            ->where('products.second_category',$second_category)
            ->distinct()
            ->groupBy('brands.id','brands.name')
            ->get();
        $product_colors = DB::table('products')
            ->select('colors.id as color_id','colors.name as color_name','colors.value as color_value',DB::raw('count(*) as total'))
            ->join('product_colors','products.id','=','product_colors.product_id')
            ->join('colors','product_colors.color_id','=','colors.id')
            ->where('products.second_category',$second_category)
            ->distinct('colors.id')
            ->groupBy('colors.id','colors.name','colors.value')
            ->get();

        $limit = ($page*10)-10;

        // $product_min_max_price = DB::table('products')
        //     ->select(DB::raw('min(price) as min_price'),DB::raw('max(price) as max_price'))
        //     ->whereNull('deleted_at')
        //     ->where('status',1)
        //     ->where('second_category',$second_category)
        //     ->where('seller_id',$seller_id)
        //     ->first();

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
                // 'price_range' => $product_min_max_price,
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
        ->select('products.*','brands.name as brand_name')
        ->join('brands','brands.id','=','products.brand_id')
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
        ->select('product_colors.id as color_id','colors.name as color_name','colors.value as color_value')
        ->join('colors','product_colors.color_id','colors.id')
        ->where('product_colors.product_id',$product_id)
        ->where('product_colors.status','1')
        ->whereNull('product_colors.deleted_at')
        ->get();
        $related_products = null;
        if ($product) {
            $related_products = DB::table('products')
                ->where('second_category',$product->second_category)
                ->whereNull('deleted_at')
                ->where('status',1)
                ->limit(10)
                ->get();
        }
        

        $data = [
            'product' => $product,
            'product_images' => $product_images,
            'product_color'=> $product_color,
            'seller_details' => $seller_details,
            'related_products' => $related_products,
        ];


        $response = [
            'status' => true,
            'message' => 'Product Details',
            'data' => $data,

        ];

        return response()->json($response, 200);
    }

    public function productFilter(Request $request)
    {
        $second_category = $request->input('second_category');
        $sellers = $request->input('sellers_id'); // Array of Sellers
        $brands = $request->input('brands_id'); //Array of Brands
        $colors = $request->input('colors_id'); //Array of Colors
        $min_price = $request->input('min_price'); 
        $max_price = $request->input('max_price'); 
        $sort = $request->input('sort_by');
        $page = $request->input('page_no');

        if (empty($page)) {
            $response = [
                'status' => false,
                'current_page' =>1,
                'total_page' =>1,
                'message' => 'Page Number Field Required',
                'data' => null,
    
            ];
            return response()->json($response, 200);
        }

        if (empty($second_category)) {
            $response = [
                'status' => false,
                'current_page' =>1,
                'total_page' =>1,
                'message' => 'Category Field Required',
                'data' => null,
    
            ];
            return response()->json($response, 200);
        }
        if (!empty($min_price) && empty($max_price)) {
            $response = [
                'status' => false,
                'current_page' =>1,
                'total_page' =>1,
                'message' => 'Maximum Price Field Required',
                'data' => null,
            ];
            return response()->json($response, 200);
        }
        if (!empty($max_price) && empty($min_price)) {
            $response = [
                'status' => false,
                'current_page' =>1,
                'total_page' =>1,
                'message' => 'Minimum Price Field Required',
                'data' => null,
            ];
            return response()->json($response, 200);
        }

        $product_count = DB::table('products')
            ->select('products.*')
            ->join('product_colors','products.id', '=', 'product_colors.product_id')
            ->whereNull('products.deleted_at')
            ->where('products.status',1)
            ->where('products.second_category',$second_category)
            
            ->where(function($q) use ($sellers) {
                if (isset($sellers) && !empty($sellers) && count($sellers) > 0 ) {
                    $seller_count = 1;
                    foreach ($sellers as $key => $seller) {
                        if ($seller_count == 1) {
                            $q->where('products.seller_id',$seller);
                        }else{
                            $q->orWhere('products.seller_id',$seller);
                        }                       
                       $seller_count++;
                    }            
                 }
            })
            ->where(function($q1) use ($brands) {
                if (isset($brands) && !empty($brands) && count($brands) > 0 ) {
                    $brand_count = 1;
                    foreach ($brands as $key => $brand) {
                        if ($brand_count == 1) {
                            $q1->where('products.brand_id',$brand);
                        }else{
                            $q1->orWhere('products.brand_id',$brand);
                        }                       
                       $brand_count++;
                    }            
                 }
            });
            if (isset($colors) && !empty($colors) && count($colors) > 0 ) {
                $product_count->where(function($q2) use ($colors) {
                    
                        $colors_count = 1;
                        foreach ($colors as $key => $color) {
                            if ($colors_count == 1) {
                                $q2->where('product_colors.color_id',$color);
                            }else{
                                $q2->orWhere('product_colors.color_id',$color);
                            }                       
                        $colors_count++;
                        }            
                    
                });
            }

         if (isset($min_price) && isset($max_price) && !empty($max_price) && !empty($min_price) ) {
            $product_count->whereBetween('products.price',[$min_price,$max_price]);                     
         }

        $product_count=$product_count            
            ->distinct('products.id');
        $product_against_seller = $product_count;
         
        if (isset($sort) && !empty($sort)) {
            if ($sort == 'newest') {
                $product_against_seller->orderBy('products.id', 'asc');
            }
            elseif ($sort == 'low') {
                $product_against_seller->orderBy('products.price', 'asc');
            }elseif ($sort == 'high') {
                $product_against_seller->orderBy('products.price', 'desc');
            }elseif ($sort == 'title_asc') {
                $product_against_seller->orderBy('products.name', 'asc');
            }elseif ($sort == 'title_dsc') {
                $product_against_seller->orderBy('products.name', 'desc');
            }
        }

        $product_total = $product_count->count();
        
        $limit = ($page*12)-12;
        $total_page = ceil($product_total /12);
        // DB::enableQueryLog();
        $products = $product_against_seller
            ->latest('products.id')
            ->skip($limit)
            ->take(12)
            ->get();
            // dd(str_replace_array('?', \DB::getQueryLog()[0]['bindings'], 
            // \DB::getQueryLog()[0]['query']));
        $response = [
            'status' => true,
            'current_page' =>$page,
            'total_page' => $total_page,
            'message' => 'Product list After Filter',
            'data' =>$products,
        ];
        return response()->json($response, 200);

    }
}
