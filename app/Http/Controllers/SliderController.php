<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
session_start();
use Illuminate\support\Facades\Redirect;

class SliderController extends Controller
{
    //slider
    public function index()
    {
        $this -> AdminAuthCheck();

    	return view('admin.add_slider'); 
    }

    //save slider

    public function save_slider(Request $request)
    {
    	$data = array();
    	$data['publication_status']=$request->publication_status;

    	$image = $request->file('slider_image');
    	if($image){
    		$image_name = str_random(20);
    		$ext=strtolower($image->getClientOriginalExtension());
    		$image_full_name = $image_name.'.'.$ext;
    		$upload_path='slider/';
    		$image_url = $upload_path.$image_full_name;
    		$success=$image->move($upload_path,$image_full_name);
    		if($success){
    			$data['slider_image']=$image_url;

    			DB::table('tbl_slider')->insert($data);
    			Session::put('message','slider added successcully');
    			return Redirect::to('/add-slider');

    		}
    	}
    	$data['slider_image']='';
    	DB::table('tbl_slider')->insert($data);
    	Session::put('message','slider added successfully without photo');
    	return Redirect::to('/add-slider');

    }
	//list of category
    public function all_slider()
    {
        $this -> AdminAuthCheck();
    	$all_slider_info = DB::table('tbl_slider')->get();
    	$manage_slider = view('admin.all_slider')
    					   ->with('all_slider_info',$all_slider_info);
 
    	return view('admin_layout')
    			->with('admin.all_slider',$manage_slider);
    }

    //inactive slider
    public function inactive_slider(Request $request, $slider_id)
    {
    	DB::table('tbl_slider')
    		->where('slider_id',$slider_id)
    		->update(['publication_status'=>0]);
    	Session::put('message','slider updated successfully');
    	return Redirect::to('/all-slider');
    }

    //active slider
    public function active_slider(Request $request,$slider_id)
    {
    	DB::table('tbl_slider')
    		->where('slider_id',$slider_id)
    		->update(['publication_status'=>1]);
    	Session::put('message','slider updated successfully');
    	return Redirect::to('/all-slider');

    }
    //delete sider
    public function delete_slider($slider_id)
    {
        DB::table('tbl_slider')
            ->where('slider_id',$slider_id)
            ->delete();
        Session::get('message','slider deleted successfully');
        return Redirect::to('/all-slider');

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
