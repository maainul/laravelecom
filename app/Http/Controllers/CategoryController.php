<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
session_start();
use Illuminate\support\Facades\Redirect;


class CategoryController extends Controller
{
    //add category
    public function index()
    {
        $this -> AdminAuthCheck();
    	return view('admin.add_category');
}

    //list of category
    public function all_category()
    {
        $this -> AdminAuthCheck();
    	$all_category_info = DB::table('tbl_category')->get();
    	$manage_category = view('admin.all_category')
    					   ->with('all_category_info',$all_category_info);
 
    	return view('admin_layout')
    			->with('admin.all_category',$manage_category);
    }

    public function save_category(Request $request)
    {
    	$data = array();
    	$data['category_id'] = $request->category_id;
    	$data['category_name'] = $request->category_name;
    	$data['category_description'] = $request->category_description;
    	$data['publication_status'] = $request->publication_status;

    	// echo "<pre>";
    	// print_r($data);
    	// echo "</pre>";

    	DB::table('tbl_category')->insert($data);
    	Session::put('message','Category added successfully.');
    	return Redirect::to('/add-category');
    }

    //inactive
    public function inactive_category($category_id)
    {
    	//echo $category_id;
    	DB::table('tbl_category')
    		->where('category_id',$category_id)
    		->update(['publication_status'=>0]);
    	Session::put('message','Category updated successfully');
    		return Redirect::to('/all-category');

    }

    //active
    public function active_category($category_id)
    {
    	//echo $category_id;
    	DB::table('tbl_category')
    		->where('category_id',$category_id)
    		->update(['publication_status'=>1]);
    	Session::put('message','Category updated successfully');
    		return Redirect::to('/all-category');

    }
    //edit category
    public function edit_category($category_id)
    {
    	//echo $category_id;
    	//return view('admin.edit_category');
        $this->AdminAuthCheck();
    	$category_info = DB::table('tbl_category')
    			->where('category_id',$category_id)
    			->first();//for individual id 
    	$manage_category_info = view('admin.edit_category')
    			->with('category_info',$category_info);
    	return view('admin_layout')
    		->with('admin.edit_category',$manage_category_info);
    }
   //edit logic
    //update category
    public function update_category(Request $request,$category_id)
    {
    	$data = array();
    	$data['category_name'] = $request->category_name;
    	$data['category_description'] = $request->category_description;

    	DB::table('tbl_category')->where('category_id',$category_id)->update($data);

    	Session::get('message','category update successfully');
    	return Redirect::to('/all-category');

    }
    //delete catrgory
    public function delete_category($category_id)
    {
    	//echo $category_id;	
    	DB::table('tbl_category')
    		->where('category_id',$category_id)
    		->delete();
    	Session::get('message','category deleted successfully');
    	return Redirect::to('/all-category');
    }

//login authentication
    public function AdminAuthCheck()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return;
        }
        else{
            return Redirect::to('/admin')->send();
        }

    }
}
