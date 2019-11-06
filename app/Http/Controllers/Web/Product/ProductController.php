<?php

namespace App\Http\Controllers\Web\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    public function productSellerWithSecondCategory($second_category)
    {
    	try{
            $second_category = decrypt($second_category);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

    	$products_sellers_query=DB::table('products')
    	->leftjoin('seller','products.seller_id','=','seller.id')
    	->whereNull('products.deleted_at')
    	->where('products.status',1)
        ->where('products.second_category',$second_category)
        ->select('products.seller_id as seller_id')
        ->groupBy('products.seller_id')
        ->orderby('products.seller_id', 'ASC');
        $products_sellers = $products_sellers_query->paginate(10);

        $total_data =  $products_sellers_query->distinct('products.seller_id')->count('products.seller_id');

    	$products = [];

    	foreach ($products_sellers as $products_Seller) {
    		$product_against_seller=DB::table('products')
	    	->whereNull('deleted_at')
	    	->where('status',1)
	    	->where('second_category',$second_category)
	    	->where('seller_id',$products_Seller->seller_id)
	    	->get();

            $seller_address = DB::table('seller_details')
            ->select('state.name as state_name','city.name as city_name','seller.name as seller_name')
            ->leftjoin('seller','seller.id','=','seller_details.seller_id')
            ->join('state','seller_details.state_id','=','state.id')
            ->join('city','seller_details.city_id','=','city.id')
            ->whereNull('seller_details.deleted_at')
            ->where('seller_details.seller_id',$products_Seller->seller_id)
            ->first();


    		$products[]=[
    			'seller_id' => $products_Seller->seller_id,
                'second_category' => $second_category,
    			'seller_name' => $seller_address->seller_name,
                'seller_state' => $seller_address->state_name,
                'seller_city' => $seller_address->city_name,
    			'product' => $product_against_seller,
    		];
    	}

    	return view('web.product.product_saller',compact('products','products_sellers','second_category','paginator'));
    }

    public function productView($seller_id,$second_category)
    {
        try{
            $seller_id  = decrypt($seller_id);
            $second_category = decrypt($second_category);
        }catch(DecryptException $e) {
            return redirect()->back();
        }


        $products_sellers=DB::table('products')
            ->select('products.seller_id as seller_id', 'seller.name as seller_name')
            ->join('seller','products.seller_id','=','seller.id')
            ->whereNull('products.deleted_at')
            ->where('products.status',1)
            ->where('products.second_category',$second_category)
            ->distinct()
            ->get();

        $seller_second_category = DB::table('products')
            ->select('products.seller_id as seller_id','products.second_category as second_category','second_category.name as category_name')
            ->join('second_category','products.second_category','=','second_category.id')
            ->whereNull('products.deleted_at')
            ->where('products.status',1)
            ->where('products.seller_id',$seller_id)
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

  

        $product_min_max_price = DB::table('products')
            ->select(DB::raw('min(price) as min_price'),DB::raw('max(price) as max_price'))
            ->whereNull('deleted_at')
            ->where('status',1)
            ->where('second_category',$second_category)
            ->where('seller_id',$seller_id)
            ->first();
        // dd($product_min_max_price);

        $product_against_seller=DB::table('products')
            ->whereNull('deleted_at')
            ->where('status',1)
            ->where('second_category',$second_category)
            ->where('seller_id',$seller_id)
            ->paginate(12);
         
        $second_category_name = DB::table('second_category')->where('id',$second_category)->first();
        return view('web.product.product_category',compact('seller_second_category','products_sellers','products_brands','product_colors','product_against_seller','second_category_name','product_min_max_price','seller_id'));
    }

    public function productFilter(Request $request)
    {
        $this->validate($request, [
            'category'   => 'required',
            'sellers' => 'required',
        ]);

        $second_category = $request->input('category');
        $sellers = $request->input('sellers');
        $brands = $request->input('brands');
        $prices = $request->input('prices');
        $colors = $request->input('colors');
        $sort = $request->input('sort');
        
        $product_count = DB::table('products')
            ->select('products.*')
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
                $product_count->join('product_colors','products.id', '=', 'product_colors.product_id')
                ->where(function($q2) use ($colors) {
                    
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

         if (isset($prices) && !empty($prices) ) {
            $prices = explode(";",$prices);
            $product_count->whereBetween('products.price',[$prices[0],$prices[1]]);                     
         }

              // DB::enableQueryLog();
        $product_against_seller=$product_count            
            ->distinct('products.id');
            
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
        $product_against_seller = $product_against_seller->paginate(12);

       
       $product_min_max_price = DB::table('products')
            ->select(DB::raw('min(price) as min_price'),DB::raw('max(price) as max_price'))
            ->whereNull('deleted_at')
            ->where('status',1)
            ->where('second_category',$second_category)
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
            ->first();
            // dd(str_replace_array('?', \DB::getQueryLog()[0]['bindings'], 
                // \DB::getQueryLog()[0]['query']));


        // $response=[
        //     'pagination'=> $pagination,
        //     'products' => $product_against_seller,
        //     'product_min_max_price' => $product_min_max_price,
        // ];

        return view('web.product.pagination.product_with_category',compact('product_against_seller'));

    }

    public function productDetails($product_id)
    {
        try{
            $product_id  = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $product=DB::table('products')
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
        
        $related_products = DB::table('products')
            ->whereNull('deleted_at')
            ->where('status',1)
            ->where('second_category',$product->second_category)
            ->inRandomOrder()
            ->limit(8)
            ->get();
        return view('web.product.product_details',compact('product','seller_details','product_images','product_color','related_products'));

    }
}
