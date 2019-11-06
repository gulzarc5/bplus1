<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\FirstCategory;
use App\SecondCategory;
use Validator;
use Intervention\Image\Facades\Image;
use File;

class CategoryController extends Controller
{

    ///*****************Main Category *****************
    public function viewMainCategoryForm(){
    	$maincategory = Category::all();
    	return view('admin.category.add_main_category',['main_category'=>$maincategory]);
    }
    public function insertMainCategory(Request $request){
        $validatedData = $request->validate([
        'name' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $image_name = null;
        if($request->hasfile('image')){
            $destination = public_path('images/category/main_category/');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".$request->input('name')."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);
            $thumb_path = public_path('images/category/main_category/thumb/').$image_name;
            Image::make($image)
            ->resize(300, 400)
            ->save($thumb_path);
        }

        $maincategory = Category::create([
            'name' => $request->input('name'),
            'image' => $image_name,
        ]);
        if ($maincategory) {
            return redirect()->back()->with('message','Main Category Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }
    public function editCategory($id){
        $main_category = Category::all();
        $category = Category::where('id',$id)->first();
        return view('admin.category.add_main_category',compact('category','main_category'));
    }
    public function updateCategory(Request $request){
        $validatedData = $request->validate([
        'name' => 'required',
        'id' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

       
        if($request->hasfile('image')){

            $image = $request->file('image');
            $destination = public_path('images/category/main_category/');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".$request->input('name')."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);
            $thumb_path = public_path('images/category/main_category/thumb/').$image_name;
            Image::make($image)
            ->resize(300, 400)
            ->save($thumb_path);

            $cateegory_fetch =  Category::where('id',$request->input('id'))->first();

             $category = Category::where('id',$request->input('id'))
                ->update([
                    'image' => $image_name,
                ]);

            if($category){                
                if (!empty($cateegory_fetch->image)) {
                     $destination_thumb = public_path('images/category/main_category/').$cateegory_fetch->image;
                    File::delete($destination_thumb);

                    $destination = public_path('images/category/main_category/thumb/').$cateegory_fetch->image;
                    File::delete($destination);
                }               
            }
        }else{
            $category = Category::where('id',$request->input('id'))
            ->update([
                'name' => $request->input('name'),
            ]);
        }
        
        if ($category) {
            return redirect()->back()->with('message','Category Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }

    public function statusUpdateCategory($category_id,$status)
    {
        try {
            $category_id = decrypt($category_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $category = Category::where('id',$category_id)
        ->update([
            'status' => $status,
        ]);
        if ($category) {
            return redirect()->back()->with('message','Category Status Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }

    }

    public function DeleteCategory($category_id)
    {
        try {
            $category_id = decrypt($category_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $delete_category = Category::where('id',$category_id)
        ->delete();

        if ($delete_category) {
            return redirect()->back()->with('message','Category Deleted Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }
    

    ///*****************First Category *****************
    public function viewFirstCategoryForm(){
     	$category = Category::all()->pluck('name','id');
        $firstCategoryList = FirstCategory::all();
    	return view('admin.category.add_first_category_form',compact('category','firstCategoryList'));
    }

    public function insertFirstCategory(Request $request){
       
        $validatedData = $request->validate([
        'category_id' => 'required',
        'name' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $image_name = null;
        if($request->hasfile('image')){
            $destination = public_path('images/category/first_category/');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".$request->input('name')."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);
            $thumb_path = public_path('images/category/first_category/thumb/').$image_name;
            Image::make($image)
            ->resize(300, 400)
            ->save($thumb_path);
        }

        $firstSubCategory = FirstCategory::create([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'image' => $image_name,
        ]);
        if ($firstSubCategory) {
            return redirect()->back()->with('message','First Category Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }

    public function editFirstCategory($id){
        $category = Category::all()->pluck('name','id');
        $firstCategoryList = FirstCategory::all();
        $first_category = FirstCategory::where('id',$id)->first();
        return view('admin.category.add_first_category_form',compact('first_category','category','firstCategoryList'));
    }

    public function updateFirstCategory(Request $request){
        $validatedData = $request->validate([
        'name' => 'required',
        'id' => 'required',
        'category_id' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $image_name = null;
        if($request->hasfile('image')){
            $destination = public_path('images/category/first_category/');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".$request->input('name')."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);
            $thumb_path = public_path('images/category/first_category/thumb/').$image_name;
            Image::make($image)
            ->resize(300, 400)
            ->save($thumb_path);

            $fetch_category = FirstCategory::where('id',$request->input('id'))->first();
            $category = FirstCategory::where('id',$request->input('id'))
            ->update([
                'name' => $request->input('name'),
                'category_id' => $request->input('category_id'),
                'image' => $image_name
            ]);

            if($category){                
                if (!empty($fetch_category->image)) {
                     $destination_thumb = public_path('images/category/first_category/').$fetch_category->image;
                    File::delete($destination_thumb);

                    $destination = public_path('images/category/first_category/thumb/').$fetch_category->image;
                    File::delete($destination);
                }               
            }
        }else{
            $category = FirstCategory::where('id',$request->input('id'))
            ->update([
                'name' => $request->input('name'),
                'category_id' => $request->input('category_id'),
            ]);
        }

        if ($category) {
            return redirect()->back()->with('message','Category Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }

    public function statusUpdateFirstCategory($first_id,$status)
    {
        try {
            $first_id = decrypt($first_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $category = FirstCategory::where('id',$first_id)
        ->update([
            'status' =>  $status,
        ]);
        if ($category) {
            return redirect()->back()->with('message','Category Status Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }

    public function deleteFirstCategory($first_id)
    {
        try {
            $first_id = decrypt($first_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $category = FirstCategory::where('id',$first_id)
        ->delete();
        if ($category) {
            return redirect()->back()->with('message','First Category Deleted Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }

    }

    public function firstCategoryWithCategory($id){
        $category = FirstCategory::where('category_id',$id)
        ->where('status','1')
        ->get()
        ->pluck('name','id');
        echo $category;
    }


    public function viewSecondCategoryForm(){
    	$main_category = Category::all()->pluck('name','id');
        $secondCategoryList = SecondCategory::whereNull('deleted_at')->get();
    	return view('admin.category.add_second_sub_category_form',compact('main_category','secondCategoryList'));
    }

    public function insertSecondCategory(Request $request){
        $validatedData = $request->validate([
        'category_id' => 'required',
        'name' => 'required',
        'first_category_id' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $image_name = null;
        if($request->hasfile('image')){
            $destination = public_path('images/category/second_category/');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".$request->input('name')."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);
            $thumb_path = public_path('images/category/second_category/thumb/').$image_name;
            Image::make($image)
            ->resize(300, 400)
            ->save($thumb_path);
        }

        $second_category = SecondCategory::create([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'first_category_id' => $request->input('first_category_id'),
            'image' => $image_name,
        ]);

        if ($second_category) {
            return redirect()->back()->with('message','Second Category Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }

    public function editSecondCategory($id){
        $main_category = Category::all()->pluck('name','id');
        $secondCategoryList = SecondCategory::whereNull('deleted_at')->get();
        $second_category = SecondCategory::where('id',$id)->first();
        return view('admin.category.add_second_sub_category_form',compact('main_category','secondCategoryList','second_category'));
    }

    public function updateSecondCategory(Request $request)
    {
        $validatedData = $request->validate([
        'id' => 'required',
        'category_id' => 'required',
        'name' => 'required',
        'first_category_id' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image_name = null;
        if($request->hasfile('image')){
            $image = $request->file('image');
            $destination = public_path('images/category/second_category/');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".$request->input('name')."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);
            $thumb_path = public_path('images/category/second_category/thumb/').trim($image_name);
            Image::make($image)
            ->resize(300, 400)
            ->save($thumb_path);

            $fetch_category = SecondCategory::where('id',$request->input('id'))->first();
            $second_category = SecondCategory::where('id',$request->input('id'))
            ->update([
                'category_id' => $request->input('category_id'),
                'name' => $request->input('name'),
                'first_category_id' => $request->input('first_category_id'),
                'image' => $image_name,
            ]);

            if($second_category){                
                if (!empty($fetch_category->image)) {
                     $destination_thumb = public_path('images/category/second_category/').$fetch_category->image;
                    File::delete($destination_thumb);

                    $destination = public_path('images/category/second_category/thumb/').$fetch_category->image;
                    File::delete($destination);
                }               
            }
        }else{
            $second_category = SecondCategory::where('id',$request->input('id'))
            ->update([
                'category_id' => $request->input('category_id'),
                'name' => $request->input('name'),
                'first_category_id' => $request->input('first_category_id'),
            ]);

        }

        if ($second_category) {
            return redirect()->back()->with('message','Second Category Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }

    public function secondStatusUpdate($category_id,$status)
    {
        $second_category = SecondCategory::where('id',$category_id)
        ->update([
            'status' => $status,
        ]);

        if ($second_category) {
            return redirect()->back()->with('message','Second Category Status Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }

    public function deleteSecondCategory($category_id)
    {
        $second_category = SecondCategory::where('id',$category_id)
        ->delete();

        if ($second_category) {
            return redirect()->back()->with('message','Second Category Status Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }

    public function secondCategoryWithFirstCategory($id){
        $category = SecondCategory::where('first_category_id',$id)
        ->where('status','1')
        ->get()
        ->pluck('name','id');
        echo $category;
    }
}
