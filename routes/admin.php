<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin/login', 'Admin\AuthController@ShowLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\AuthController@LoginCheck')->name('admin.login.check');
Route::group(['as'=>'admin.','prefix' =>'admin','namespace'=>'Admin', 'middleware' => ['auth', 'admin']], function(){

    Route::resource('products','ProductController');


    Route::post('products/update2/{id}','ProductController@update2')->name('products.update2');
    Route::get('products/slug/{name}','ProductController@ajaxSlugMake')->name('products.slug');
    Route::post('products/get-subcategories-by-category','ProductController@ajaxSubCat')->name('products.get_subcategories_by_category');
    Route::post('products/get-subsubcategories-by-subcategory','ProductController@ajaxSubSubCat')->name('products.get_subsubcategories_by_subcategory');
    Route::post('products/sku_combination','ProductController@sku_combination')->name('products.sku_combination');
    Route::post('/products/sku_combination_edit', 'ProductController@sku_combination_edit')->name('products.sku_combination_edit');
    Route::post('products/todays_deal', 'ProductController@updateTodaysDeal')->name('products.todays_deal');
    Route::post('products/published/update', 'ProductController@updatePublished')->name('products.published');
    Route::post('products/featured/update', 'ProductController@updateFeatured')->name('products.featured');




});
