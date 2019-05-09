<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
session_start();
use Illuminate\support\Facades\Redirect;



class HomeController extends Controller
{
    public function index()
    {

    	$this->AdminAuthCheck();

    	$all_published_product = DB::table('tbl_products')
    						->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
    						->join('tbl_manufacture','tbl_products.manufature_id','=','tbl_manufacture.manufature_id')
    						->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufature_name')
    						->get();
    	$manage_product = view('pages.home_content')
    					->with('all_published_product',$all_published_product);
    	return view('welcome')
    				->with('pages.home_content',$manage_product);
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
