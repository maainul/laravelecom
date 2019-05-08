<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
session_start();
use Illuminate\support\Facades\Redirect;


class AdminController extends Controller
{
    //login page
    //1st page of admin  
    public function index(){
    	return view('admin.admin_login');
    }
    //aftr login
    //admin dashboard
    public function show_dashboard(){
    	return view('admin.dashboard');
    }
    //it will check login
    //first check the login
    //after successfull login page
    //admin-dashboard
    public function dashboard(Request $request){
    	$admin_email = $request ->admin_email;
    	//$admin_password = md5($request->admin_password);
    	$admin_password = $request->admin_password;
    	$result = DB::table('tbl_admin')
    			->where('admin_email',$admin_email)
    			->where('admin_password',$admin_password)
    			->first();
    			// echo "<pre>";
    			// print_r($result);
    			// exit();
    		if ($result){
    			Session::put('admin_name',$result->admin_name);
    			Session::put('admin_id',$result->admin_id);
    			return Redirect::to('/dashboard');
    		}
    		else{
    			Session::put('message','Email or password invalid');
    			return Redirect::to('/admin');
    		}
    }
}
