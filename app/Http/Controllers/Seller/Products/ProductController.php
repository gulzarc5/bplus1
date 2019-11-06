<?php

namespace App\Http\Controllers\Seller\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Support\Facades\DB;
use Auth;
use Intervention\Image\Facades\Image;
use File;

class ProductController extends Controller
{
    public function viewProductAddForm()
    {
    	$category = DB::table('category')
    	->where('status','1')
    	->whereNull('deleted_at')
    	->get();
    	return view('seller.products.add_product_form',compact('category'));
    }

    public function addNewProduct(Request $request)
    {
       
        $validatedData = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'first_category' => 'required',
            'second_category' => 'required',
            'brand' => 'required',
            'mrp' => 'required',
            'price' => 'required',
            'min_quantity' => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $seller_id = Auth::guard('seller')->id();
        $name = $request->input('name');
        $tag_name = $request->input('tag_name');
        $category = $request->input('category');
        $first_category = $request->input('first_category');
        $second_category = $request->input('second_category');
        $brand = $request->input('brand');
        $color = $request->input('color'); ///This Is An Array Of Color


        $short_description = $request->input('short_description');
        $long_description = $request->input('long_description');
        $image = $request->file('image');


        $product_insert = DB::table('products')
        ->insertGetId([
            'name' => $name,
            'tag_name' => $tag_name,
            'brand_id' => $brand,
            'seller_id' => $seller_id,
            'category' => $category,
            'first_category' => $first_category,
            'second_category' => $second_category,
            'short_description' => $short_description,
            'long_description' => $long_description,
            'mrp'=> $request->input('mrp'),
            'price'=> $request->input('price'),
            'min_ord_qtty'=> $request->input('min_quantity'),
            'status' => 2,
        ]);


        if ($product_insert) {
            $product_id = $product_insert; 

            $product_id = $product_insert; 

            //*******************Insert Color**************
            // dd($color);
            if (isset($color) && !empty($color)) {
                foreach ($color as $colors) {
                    if (!empty($colors)) {
                        $color_insert = DB::table('product_colors')
                            ->insert([
                                'product_id' => $product_id,
                                'color_id' => $colors,
                            ]);
                    }
                    
                }
            }
            
            //*****************insert Product Images******************
            if($request->hasfile('image'))
            {
                $image_count = 1;
                $image_array = $request->file('image');
                foreach($image_array as $image)
                {
                    $destination = base_path().'/public/images/product/';
                    $image_extension = $image->getClientOriginalExtension();
                    $image_name = md5(date('now').time())."-".$request->input('category_name')."."."$image_extension";
                    $original_path = $destination.$image_name;
                    Image::make($image)->save($original_path);
                    $thumb_path = base_path().'/public/images/product/thumb/'.$image_name;
                    Image::make($image)
                    ->resize(300, 400)
                    ->save($thumb_path);

                    if ($image_count == 1) {
                        $product_update = DB::table('products')
                        ->where('id', $product_id)
                        ->update(['main_image' => $image_name]);
                    }

                    $product_insert = DB::table('product_image')
                    ->insert([
                        'product_id' => $product_id,
                        'image' => $image_name,
                    ]);
                    $image_count++;
                }
            }

            return redirect()->back()->with('message','Product Added Successfully');
        }else{
             return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }

    }


   public function productList()
   {
    	return view('seller.products.product_list');
   }

    public function ajaxGetProductList()
    {
    	$seller_id = Auth::guard('seller')->id();
        $query = DB::table('products')
        ->select('products.*','category.name as c_name','first_category.name as first_c_name','second_category.name as second_c_name','brands.name as brand_name')
        ->join('category','products.category','=','category.id')
        ->join('first_category','products.first_category','=','first_category.id')
        ->join('second_category','products.second_category','=','second_category.id')
        ->join('brands','products.brand_id','=','brands.id')
        ->where('products.seller_id',$seller_id)
        ->whereNull('products.deleted_at')
        ->orderBy('products.id','desc');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="'.route('seller.product_view', [encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>
                   <a href="'.route('seller.product_edit', [encrypt($row->id)]).'" class="btn btn-warning btn-sm">Edit</a>   
                   <a href="'.route('seller.product_images', [encrypt($row->id)]).'" class="btn btn-warning btn-sm">Images</a>
                   <a href="'.route('seller.product_Color_edit', [encrypt($row->id)]).'" class="btn btn-warning btn-sm">Colors</a>                  
                   ';
                   if ($row->seller_status == '1') {
                       $btn .= '<a href="'.route('seller.product_status_update', [encrypt($row->id),encrypt(2)]).'" class="btn btn-danger btn-sm">Disable</a>';
                        return $btn;
                    }else{
                       $btn .= '<a href="'.route('seller.product_status_update', [encrypt($row->id),encrypt(1)]).'" class="btn btn-success btn-sm">Enable</a>';
                        return $btn;
                    }
                    return $btn;
            })
            ->addColumn('status_tab', function($row){
                if ($row->seller_status == '1') {

                   $btn = '<a href="#" class="btn btn-success btn-sm">Enabled</a>';
                    return $btn;
                }else{

                   $btn = '<a href="#" class="btn btn-danger btn-sm">Disabled</a>';
                    return $btn;
                }
            })
            ->addColumn('approval', function($row){
                if ($row->status == '1') {

                   $btn = '<a href="#" class="btn btn-success btn-sm">Approved</a>';
                    return $btn;
                }else{

                   $btn = '<a href="#" class="btn btn-warning btn-sm">Waiting For Approval</a>';
                    return $btn;
                }
            })
            ->rawColumns(['action','status_tab','approval'])
            ->make(true);
    }



    public function productView($product_id)
    {
        try {
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $product = DB::table('products')
        ->select('products.*','category.name as c_name','first_category.name as first_c_name','second_category.name as second_c_name','brands.name as brand_name')
        ->join('category','products.category','=','category.id')
        ->join('first_category','products.first_category','=','first_category.id')
        ->join('second_category','products.second_category','=','second_category.id')
        ->join('brands','products.brand_id','=','brands.id')
        ->where('products.id','=',$product_id)
        ->first();



        $colors = DB::table('product_colors')
        ->select('product_colors.*','colors.name as c_name','colors.value as c_value')
        ->join('colors','product_colors.color_id','=','colors.id')
        ->where('product_colors.product_id',$product_id)
        ->whereNull('product_colors.deleted_at')
        ->get();

        return view('seller.products.product_details',compact('product','sizes','colors','varients'));
    }

    public function productEdit($product_id)
    {
        try {
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $category = DB::table('category')
        ->where('status','1')
        ->whereNull('deleted_at')
        ->get();

        $product = DB::table('products')
        ->where('id',$product_id)
        ->first();

        $first_category = DB::table('first_category')
        ->where('status','1')
        ->where('category_id',$product->category)
        ->whereNull('deleted_at')
        ->get();

        $second_category = DB::table('second_category')
        ->where('status','1')
        ->where('first_category_id',$product->first_category)
        ->whereNull('deleted_at')
        ->get();

        $brands = DB::table('brands')
        ->where('category',$product->category)
        ->where('first_category',$product->first_category)
        ->where('status','1')
        ->whereNull('deleted_at')
        ->get();

        return view('seller.products.edit_product',compact('category','product','first_category','second_category','brands'));
    }

   	public function productUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'name' => 'required',
            'category' => 'required',
            'first_category' => 'required',
            'second_category' => 'required',
            'brand' => 'required',
            'mrp' => 'required',
            'price' => 'required',
            'min_quantity' => 'required',

        ]);

        try {
            $product_id = decrypt($request->input('product_id'));
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        
        $product_update = DB::table('products')
        ->where('id',$product_id)
        ->update([
            'name' => $request->input('name'),
            'tag_name' => $request->input('tag_name'),
            'category' => $request->input('category'),
            'first_category' => $request->input('first_category'),
            'second_category' => $request->input('second_category'),
            'brand_id' => $request->input('brand'),
            'short_description' => $request->input('short_description'),
            'long_description' => $request->input('long_description'),
            'mrp' => $request->input('mrp'),
            'price' => $request->input('price'),
            'min_ord_qtty'=> $request->input('min_quantity'),
        ]);


        if ($product_update) {
            return redirect()->route('seller.product_edit', encrypt($product_id))->with('message','Product Updated Successfully');
        }else{
            return redirect()->route('seller.product_edit', encrypt($product_id))->with('error','Something Went Wrong Please try Again');
        } 

    }


    public function productImages($product_id)
    {
        try {
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $product = DB::table('products')
        ->where('id',$product_id)
        ->first();

        $image = DB::table('product_image')
        ->where('product_id',$product_id)
        ->whereNull('deleted_at')
        ->get();

        return view('seller.products.images',compact('product','image'));
    }

    public function productSetThumb($product_id,$image_id)
    {
        try {
            $product_id = decrypt($product_id);
            $image_id = decrypt($image_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

         $image = DB::table('product_image')
        ->where('id',$image_id)
        ->whereNull('deleted_at')
        ->first();

        $product_update =  DB::table('products')
        ->where('id',$product_id)
        ->update([
            'main_image' => $image->image,
        ]);

        if ($product_update) {
            return redirect()->route('seller.product_images', encrypt($product_id))->with('message','Product Thumb Successfully');
        }else{
            return redirect()->route('seller.product_images', encrypt($product_id))->with('error','Something Went Wrong Please try Again');
        } 
    }

    public function productUpdateImageStatus($product_id,$image_id,$status)
    {
        try {
            $product_id = decrypt($product_id);
            $status = decrypt($status);
            $image_id = decrypt($image_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $image = DB::table('product_image')
        ->where('id',$image_id)
        ->update([
            'status'=> $status,
        ]);

        if ($image) {
            return redirect()->route('seller.product_images', encrypt($product_id))->with('message','Image Status Changed Successfully');
        }else{
            return redirect()->route('seller.product_images', encrypt($product_id))->with('error','Something Went Wrong Please try Again');
        } 
    }

    public function productDeleteImage($product_id,$image_id)
    {
        try {
            $product_id = decrypt($product_id);
            $image_id = decrypt($image_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $image = DB::table('product_image')
        ->where('id',$image_id)
        ->first();

        $image_delete = DB::table('product_image')
        ->where('id',$image_id)
        ->delete();

        $destination_thumb = base_path().'/public/images/product/thumb/'.$image->image;
        File::delete($destination_thumb);

        $destination = base_path().'/public/images/product/'.$image->image;
        File::delete($destination);

        if ($image_delete) {
            return redirect()->route('seller.product_images', encrypt($product_id))->with('message','Image Status Changed Successfully');
        }else{
            return redirect()->route('seller.product_images', encrypt($product_id))->with('error','Something Went Wrong Please try Again');
        } 

    }

    public function productMoreImageAdd(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $product_id = decrypt($request->input('product_id'));
        }catch(DecryptException $e) {
            return redirect()->back();
        }


        $image_add = false;

        if($request->hasfile('image'))
            {
                $image_array = $request->file('image');
                foreach($image_array as $image)
                {
                    // $image = $request->file('img');
                    $destination = base_path().'/public/images/product/';
                    $image_extension = $image->getClientOriginalExtension();
                    $image_name = md5(date('now').time())."-".$request->input('category_name')."."."$image_extension";
                    $original_path = $destination.$image_name;
                    Image::make($image)->save($original_path);
                    $thumb_path = base_path().'/public/images/product/thumb/'.$image_name;
                    Image::make($image)
                    ->resize(300, 400)
                    ->save($thumb_path);

                    $image_insert = DB::table('product_image')
                    ->insert([
                        'product_id' => $product_id,
                        'image' => $image_name,
                    ]);

                    if ($image_insert) {
                        $image_add = true;
                    }else{
                        $image_add = false;
                    }
                }
            }

        if ($image_add == true) {
             return redirect()->route('seller.product_images', encrypt($product_id))->with('message','Image Added Successfully');
        }else{
            return redirect()->route('seller.product_images', encrypt($product_id))->with('error','Something Went Wrong Please try Again');
        }
    }

    public function productColorEdit($product_id)
    {
        try {
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $product = DB::table('products')
        ->where('id',$product_id)
        ->first();

        $color_options = DB::table('colors')
        ->where('category',$product->category)
        ->where('first_category',$product->first_category)
        ->where('status','1')
        ->whereNull('deleted_at')
        ->get();

        $product_colors = DB::table('product_colors')
        ->where('product_id',$product_id)
        ->whereNull('deleted_at')
        ->get();

        $product_id_color_add = $product_id;
        
        return view('seller.products.product_colors_edit',compact('color_options','product_colors','product_id_color_add'));

    }

    public function productColorUpdate(Request $request)
    {
        $product_color_id = $request->input('product_color_id');
        $color = $request->input('color');

        if (isset($product_color_id) && !empty($product_color_id) && isset($color) && !empty($color)) {
            $color_update = DB::table('product_colors')
            ->where('id',$product_color_id)
            ->update([
                'color_id' => $color,
            ]);

            if ($color_update) {
                 return 2;
            }else{
                return 3; 
            }

        }else{
            return 1;
        }
    }

    public function productNewColorAdd(Request $request)
    {
        $product_id = $request->input('product_id');

        if (!isset($product_id) && empty($product_id)) {
             return redirect()->route('admin.product_list');
        }

        $colors = $request->input('color'); //This is an Array of Colors

        for ($i=0; $i < count($colors) ; $i++) { 
           if (!empty($colors[$i])) {
               
               $check_color = DB::table('product_colors')
                ->where('product_id',$product_id)
                ->where('color_id',$colors[$i])
                ->count();

                if ($check_color < 1) {
                    $color_update = DB::table('product_colors')
                    ->insert([
                        'product_id' => $product_id,
                        'color_id' => $colors[$i],
                    ]);
                }
           }
        }

        return redirect()->route('seller.product_Color_edit',['product_id' => encrypt($product_id)]);

    }

    public function productStatusUpdate($product_id,$status)
    {
        try {
            $product_id = decrypt($product_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $product_status_update = DB::table('products')
        ->where('id',$product_id)
        ->update([
            'seller_status' => $status,
        ]);
        return redirect()->back();
    }

}
