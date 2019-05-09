<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
session_start();
use Illuminate\support\Facades\Redirect;

class ManufactureController extends Controller
{
    //add brand form
    public function index()
    {
        $this->AdminAuthCheck();
        
    	return view('admin.add_manufacture');
    }

    //save
    public function save_manufacture(Request $request)
    {
    	$data = array();
    	$data['manufature_id']=$request->manufature_id;
    	$data['manufature_name']=$request->manufature_name;
    	$data['manufature_description']=$request->manufature_description;
    	$data['publication_status']=$request->publication_status;
    	DB::table('tbl_manufacture')->insert($data);
    	Session::get('message','Manufacture successfully');
    	return Redirect::to('/add-manufacture');
    }

    //list of manufactures or brands
    public function all_manufacture()
    {
        

        $this->AdminAuthCheck();

    	$all_manufacture_info = DB::table('tbl_manufacture')->get();
    	$manage_manufacture = view('admin.all_manufacture')
    						->with('all_manufacture_info',$all_manufacture_info);
    	return view('admin_layout')
    				->with('admin.all_manufacture',$manage_manufacture);
    }

    //inactive manufacture
    public function inactive_manufacture($manufature_id)
    {
    	DB::table('tbl_manufacture')
    			->where('manufature_id',$manufature_id)
    			->update(['publication_status'=>0]);
    	Session::put('message','Manufacture update successfully');
    	return Redirect::to('/all-manufacture');
    }

    //active manufacture
    public function active_manufacture($manufature_id)
    {
    	DB::table('tbl_manufacture')
    			->where('manufature_id',$manufature_id)
    			->update(['publication_status'=>1]);
    	Session::put('message','Manufacture update successfully');
    	return Redirect::to('/all-manufacture');
    }

    //edit form//brand//manufacture
    public function edit_manufacture($manufature_id)
    {
        

        $this->AdminAuthCheck();

    	$manufacture_info = DB::table('tbl_manufacture')
    						->where('manufature_id',$manufature_id)
    						->first();
    	$manage_manufacture_info = view('admin.edit_manufacture')
    						->with('manufacture_info',$manufacture_info);
    	return view('admin_layout')
    				->with('admin.edit_manufacture',$manage_manufacture_info);
    }

    //update logic
    public function update_manufacture(Request $request,$manufature_id)
    {
    	$data = array();
    	$data['manufature_name']=$request->manufature_name;
    	$data['manufature_description']=$request->manufature_description;
    	DB::table('tbl_manufacture')->where('manufature_id',$manufature_id)->update($data);

    	Session::get('message','manufacture update successfully');
    	return Redirect::to('/all-manufacture');
    }

   //delete manufacture
    public function delete_manufacture($manufature_id)
    {
    	DB::table('tbl_manufacture')
    		->where('manufature_id',$manufature_id)
    		->delete();

    	Session::get('message','manufacture delete successfully');
    	return Redirect::to('/all-manufacture');
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
