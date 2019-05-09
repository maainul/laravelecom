<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
session_start();
use Illuminate\support\Facades\Redirect;


class ProductController extends Controller
{
    //add product form
    public function index()
    {
    	return view('admin.add_product');
    }
    
    //save product logic
    public function save_product(Request $request)
    {
    	$data = array();
    	$data['product_name']=$request->product_name;
    	$data['category_id']=$request->category_id;
    	$data['manufature_id']=$request->manufature_id;
    	$data['product_short_description']=$request->product_short_description;
    	$data['product_long_description']=$request->product_long_description;
    	$data['product_price']=$request->product_price;
    	$data['product_size']=$request->product_size;
    	$data['product_color']=$request->product_color;
    	$data['product_status']=$request->product_status;
    	$image = $request->file('product_image');
    	if($image){
    		$image_name = str_random(20);
    		$ext=strtolower($image->getClientOriginalExtension());
    		$image_full_name = $image_name.'.'.$ext;
    		$upload_path='image/';
    		$image_url = $upload_path.$image_full_name;
    		$success=$image->move($upload_path,$image_full_name);
    		if($success){
    			$data['product_image']=$image_url;

    			DB::table('tbl_products')->insert($data);
    			Session::put('message','product added successcully');
    			return Redirect::to('/add-product');

    		}
    	}
    	$data['image']='';
    	DB::table('tbl_products')->insert($data);
    	Session::put('message','product added successfully without photo');
    	return Redirect::to('/add-product');
    

    }

}
