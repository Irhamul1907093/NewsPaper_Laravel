<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\frontController@index');
Route::get('/category/{slug}', 'App\Http\Controllers\frontController@category');
Route::get('/article/{slug}', 'App\Http\Controllers\frontController@article');
Route::get('/search-content', 'App\Http\Controllers\frontController@searchContent');
Route::get('/page/{slug}', 'App\Http\Controllers\frontController@page');
Route::get('/contact-us', 'App\Http\Controllers\frontController@contactUs');
Route::post('/sendmessage','App\Http\Controllers\crudController@insertData');
//Route::get('/post', 'App\Http\Controllers\frontController@post');

//admin
Route::get('/my-admin','App\Http\Controllers\adminController@index');
//category
Route::get('/viewcategory','App\Http\Controllers\adminController@category');
Route::post('/addcategory','App\Http\Controllers\crudController@insertData');
Route::get('/editcategory/{id}','App\Http\Controllers\adminController@editCategory');
Route::post('/updatecategory/{id}','App\Http\Controllers\crudController@updateData');
Route::post('multipledelete','App\Http\Controllers\adminController@multipleDelete');
//Route::get('/check','App\Http\Controllers\adminController@check');

//settings
Route::get('/settingszz','App\Http\Controllers\adminController@settings');
Route::post('/addsettings','App\Http\Controllers\crudController@insertData');
Route::post('/updatesettings/{id}','App\Http\Controllers\crudController@updateData');

//posts
Route::get('/add-post','App\Http\Controllers\adminController@addPost');
Route::post('/addpost','App\Http\Controllers\crudController@insertData');
Route::get('/all-posts','App\Http\Controllers\adminController@allPosts');
Route::get('/editpost/{id}','App\Http\Controllers\adminController@editPost');
Route::post('/updatepost/{id}','App\Http\Controllers\crudController@updateData');


//pages
Route::get('/add-page','App\Http\Controllers\adminController@addPage'); //to show add page
Route::post('/addpage','App\Http\Controllers\crudController@insertData'); //to insert data in db
Route::get('/all-pages','App\Http\Controllers\adminController@allPages');
Route::get('/editpage/{id}','App\Http\Controllers\adminController@editPage');
Route::post('/updatepage/{id}','App\Http\Controllers\crudController@updateData');

//messages
Route::get('/messages','App\Http\Controllers\adminController@messages');
//advertisements
Route::get('/add-adv','App\Http\Controllers\adminController@addAdv');
Route::post('/addadv','App\Http\Controllers\crudController@insertData');
Route::get('/all-advs','App\Http\Controllers\adminController@allAdv');
Route::get('editadv/{id}','App\Http\Controllers\adminController@editAdv');
Route::post('/updateadv/{id}','App\Http\Controllers\crudController@updateData');

//Auth
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

