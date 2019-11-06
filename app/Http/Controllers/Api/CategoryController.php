<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CategoryController extends Controller
{
    public function appLoaddata()
    {
    	$main_category = DB::table('category')
    	->whereNull('deleted_at')
    	->where('status',1)
    	->get();

        $app_slider_list = DB::table('slider')
        ->whereNull('deleted_at')
        ->where('status',1)
        ->where('type',1)
        ->get();

        $popular_products = DB::table('products')
        ->whereNull('deleted_at')
        ->where('status',1)
        ->inRandomOrder()
        ->limit(10)
        ->get();

        $new_arrivals = DB::table('products')
        ->whereNull('deleted_at')
        ->where('status',1)
        ->latest('id')
        ->limit(10)
        ->get();


    	$data = [
    		'main_category_list' => $main_category,
            'sliders' => $app_slider_list,
            'popular_products' => $popular_products,
            'new_arrivals' => $new_arrivals,
    	];

        $response = [
            'status' => true,
            'message' => 'data lists',
            'data' => $data,
        ];
    	
    	return response()->json($response, 200);

    }

    public function sliderImage($image_name)
    {
        $path =  public_path('images/slider/').$image_name;

        if (file_exists($path)) {
            $mime = \File::mimeType($path);

            header('Content-type: '.$mime);

            return readfile($path);
        }else{
            return 0;
        }        
    }

    public function sliderImageThumb($image_name)
    {
        $path =  public_path('images/slider/thumb/').$image_name;

        if (file_exists($path)) {
            $mime = \File::mimeType($path);

            header('Content-type: '.$mime);

            return readfile($path);
        }else{
            return 0;
        }        
    }

    public function mainCategoryImage($image_name)
    {
        $path =  public_path('images/category/main_category/').$image_name;

 
        if (file_exists($path)) {
            $mime = \File::mimeType($path);

            header('Content-type: '.$mime);

            return readfile($path);
        }else{
            return 0;
        }        
    }

    public function mainCategoryImageThumb($image_name)
    {
        $path =  public_path('images/category/main_category/thumb/').$image_name;

        if (file_exists($path)) {
            $mime = \File::mimeType($path);

            header('Content-type: '.$mime);

            return readfile($path);
        }else{
            return 0;
        }        
    }

    public function firstCategory($main_category)
    {
      
        $first_category = DB::table('first_category')
        ->where('category_id',$main_category)
        ->whereNull('deleted_at')
        ->where('status',1)
        ->get();

        if ($first_category) {
            $response = [
                'status' => true,
                'message' => 'data lists',
                'data' => $first_category,
            ];
                
            return response()->json($response, 200);
        }else{
            $first_category=[];
            $response = [
                'status' => false,
                'message' => 'data lists',
                'data' => $first_category,
            ];
                
            return response()->json($response, 200);
        }
    }

    public function firstCategoryImage($image_name)
    {
        $path =  public_path('images/category/first_category/').$image_name;

        if (file_exists($path)) {
            $mime = \File::mimeType($path);

            header('Content-type: '.$mime);

            return readfile($path);
        }else{
            return 0;
        }        
    }

    public function firstCategoryImageThumb($image_name)
    {
        $path =  public_path('images/category/first_category/thumb/').$image_name;

        if (file_exists($path)) {
            $mime = \File::mimeType($path);

            header('Content-type: '.$mime);

            return readfile($path);
        }else{
            return 0;
        }        
    }

    public function secondCategory($first_category)
    {
        $second_category1 = DB::table('second_category')
        ->where('first_category_id',$first_category)
        ->whereNull('deleted_at')
        ->where('status',1)
        ->get();

        if ($second_category1) {

            $second_category = [];
            foreach ($second_category1 as $key => $value) {
                $product_count = 0;
                $product_count = DB::table('products')
                ->where('second_category',$value->id)
                ->whereNull('deleted_at')
                ->where('status',1)
                ->count();
                $second_category[] = [
                    'id' => $value->id,
                    'name' => $value->name,
                    'image' => $value->image,
                    'total_product' => $product_count,
                ];
            }
            $response = [
                'status' => true,
                'message' => 'Second category list',
                'data' => $second_category,
            ];
                
            return response()->json($response, 200);
        }else{
            $second_category=[];
            $response = [
                'status' => false,
                'message' => 'Second category list',
                'data' => $second_category,
            ];
                
            return response()->json($response, 200);
        }
    }

    public function secondCategoryImage($image_name)
    {
        $path =  public_path('images/category/second_category/').$image_name;

        if (file_exists($path)) {
            $mime = \File::mimeType($path);

            header('Content-type: '.$mime);

            return readfile($path);
        }else{
            return 0;
        }        
    }

    public function secondCategoryImageThumb($image_name)
    {
        $path =  public_path('images/category/second_category/thumb/').$image_name;

        if (file_exists($path)) {
            $mime = \File::mimeType($path);

            header('Content-type: '.$mime);

            return readfile($path);
        }else{
            return 0;
        }        
    }
}
