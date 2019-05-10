<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//frontend -----------------------------------
Route::get('/','Homecontroller@index');

//category wise product 
Route::get('/product-by-category/{category_id}','HomeController@show_product_by_category');
//brnad_wise_product
Route::get('/brand-wise-product/{manufature_id}','HomeController@brand_wise_product');
//view-product
Route::get('/view-product/{manufature_id}','HomeController@product_details_by_id');







//backend------------------------------------
Route::get('/logout','SuperAdminController@logout');
Route::get('/admin','AdminController@index');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::get('/dashboard','SuperAdminController@index');

//category........................
Route::get('/add-category','CategoryController@index');
Route::get('/all-category','CategoryController@all_category');
Route::post('/save-category','CategoryController@save_category');
Route::get('/inactive-category/{category_id}','CategoryController@inactive_category');
Route::get('/active-category/{category_id}','CategoryController@active_category');
Route::get('/edit-category/{category_id}','CategoryController@edit_category');
Route::post('/update-category/{category_id}','CategoryController@update_category');
Route::get('/delete-category/{category_id}','CategoryController@delete_category');



//brand route........................................................
Route::get('/add-manufacture','ManufactureController@index');
Route::post('/save-manufacture','ManufactureController@save_manufacture');
Route::get('/all-manufacture','ManufactureController@all_manufacture');
Route::get('/inactive-manufacture/{manufature_id}','ManufactureController@inactive_manufacture');
Route::get('/active-manufacture/{manufature_id}','ManufactureController@active_manufacture');
Route::get('/edit-manufacture/{manufature_id}','ManufactureController@edit_manufacture');
Route::post('/update-manufacture/{manufature_id}','ManufactureController@update_manufacture');
Route::get('/delete-manufacture/{manufature_id}','ManufactureController@delete_manufacture');

//products..........................................................
Route::get('/add-product','ProductController@index');
Route::post('/save-product','ProductController@save_product');
Route::get('/all-product','ProductController@all_product');
Route::get('/inactive-product/{product_id}','ProductController@inactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::post('/update-product/{product_id}','ProductController@update_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');

//slider............................................................
Route::get('/add-slider','SliderController@index');
Route::post('/save-slider','SliderController@save_slider');
Route::get('/all-slider','SliderController@all_slider');
Route::get('/inactive-slider/{slider_id}','SliderController@inactive_slider');
Route::get('/active-slider/{slider_id}','SliderController@active_slider');
Route::get('/delete-slider/{slider_id}','SliderController@delete_slider');
