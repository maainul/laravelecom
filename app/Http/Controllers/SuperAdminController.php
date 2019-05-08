<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
session_start();
use Illuminate\support\Facades\Redirect;


class SuperAdminController extends Controller
{
    //logout
    public function logout(){
    	// Session::put('admin_name',null);
    	// Session::put('admin_id',null);
    	Session::flush();
    	return Redirect:: to('/admin');
    }
}
