<?php

namespace App\Http\Controllers\Web\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CategoryController extends Controller
{
    public function index()
    {
        $newarrival = DB::table('products')->whereNull('deleted_at')->where('status','1')->orderBy('id','desc')->limit(10)->get();
        $best_selling = DB::table('products')->whereNull('deleted_at')->where('status','1')->inRandomOrder()->limit(10)->get();

        $data = [
            'newarrival' => $newarrival,
            'best_selling' => $best_selling,
        ];
    	 return view('web.index',compact('data'));
    }

    public function SecondCategory($first_Catgory)
    {
    	try{
            $first_Catgory = decrypt($first_Catgory);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $first_category = DB::table('first_category')->where('id',$first_Catgory)->first();

        $second_category1 = DB::table('second_category')
            ->where('first_category_id',$first_category->id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->get();

       

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
    	return view('web.product.product_subcategory',compact('first_category','second_category'));
    }

    public function firstCategory($main_category_id)
    {
        try{
            $main_category_id = decrypt($main_category_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $main_category = DB::table('category')->where('id',$main_category_id)->first();

        $first_category1 = DB::table('first_category')
            ->where('category_id',$main_category_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->get();

       

        $first_category = [];
        foreach ($first_category1 as $key => $value) {
            $product_count = 0;
            $product_count = DB::table('products')
            ->where('first_category',$value->id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->count();
            $first_category[] = [
                'id' => $value->id,
                'name' => $value->name,
                'image' => $value->image,
                'total_product' => $product_count,
            ];
        }
        // dd($first_category);
        return view('web.product.product_subcategory_from_home',compact('first_category','main_category'));
    }
}
