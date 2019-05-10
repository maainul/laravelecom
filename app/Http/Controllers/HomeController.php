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
                            ->where('tbl_products.product_status',1)
                            ->limit(9)
    						->get();
    	$manage_product = view('pages.home_content')
    					->with('all_published_product',$all_published_product);
    	return view('welcome')
    				->with('pages.home_content',$manage_product);
    }

    //show_product_by_category
    public function show_product_by_category($category_id)
    {
        //echo $category_id;
        $this->AdminAuthCheck();
        $show_product_category = DB::table('tbl_products')
                            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                            ->join('tbl_manufacture','tbl_products.manufature_id','=','tbl_manufacture.manufature_id')
                            ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufature_name')
                            ->where('tbl_products.product_status',1)
                            ->where('tbl_category.category_id',$category_id)
                            ->limit(18)
                            ->get();
        $manage_show_product_category = view('pages.category_by_product')
                        ->with('show_product_category',$show_product_category);
        return view('welcome')
                    ->with('pages.category_by_product',$manage_show_product_category);

    }

    //brand wise product
    public function brand_wise_product($manufature_id)
    {
         // echo $manufature_id;
        $this->AdminAuthCheck();
        $show_product_brand = DB::table('tbl_products')
                            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                            ->join('tbl_manufacture','tbl_products.manufature_id','=','tbl_manufacture.manufature_id')
                            ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufature_name')
                            ->where('tbl_products.product_status',1)
                            ->where('tbl_manufacture.manufature_id',$manufature_id)
                            ->limit(18)
                            ->get();
        $manage_show_product_brand = view('pages.brand_wise_product')
                        ->with('show_product_brand',$show_product_brand);
        return view('welcome')
                    ->with('pages.brand_wise_product',$manage_show_product_brand);
       
    }

    public function product_details_by_id($product_id)
    {
                 // echo $manufature_id;
        $this->AdminAuthCheck();
        $product_by_details = DB::table('tbl_products')
                            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                            ->join('tbl_manufacture','tbl_products.manufature_id','=','tbl_manufacture.manufature_id')
                            ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufature_name')
                            ->where('tbl_products.product_status',1)
                            ->where('tbl_products.product_id',$product_id)
                            ->first();
        $manage_product_by_category = view('pages.product_details')
                        ->with('product_by_details',$product_by_details);
        return view('welcome')
                    ->with('pages.product_details',$manage_product_by_category);

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
