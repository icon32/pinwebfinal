<?php

use Illuminate\Support\Facades\Route;
use App\Posts;
use Carbon\Carbon;
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

//Home Page
Route::get('/', 'PostsController@index');

Auth::routes();




//User Control Page
Route::get('/controlPanel', 'homeController@index')->name('home');



//Posts Mechanism
Route::get('/posts/newpost','PostsController@create');
Route::get('/posts',function (){ return redirect('/'); });
Route::post('/posts','PostsController@store');
Route::get('/posts/{slug}/edit','PostsController@edit');
Route::get('/posts/{slug}','PostsController@show');
Route::put('/posts/{slug}','PostsController@update');
Route::get('/posts-delete/{slug}','PostsController@destroy');
//Route::get('/posts',function (){
//    return  view('profile');
//});



// Profile Mechanism
Route::get('/profile','UserController@index');
Route::get('/profile/{name}','UserController@show');
Route::get('/profile/{slug}/edit','UserController@edit');
Route::put('/profile/{name}/edit/name', 'UserController@editname');
Route::put('/profile/{name}/edit/desc', 'UserController@editdescription');
Route::put('/profile/{name}/edit/avatar', 'UserController@editavatar');

// Comments Mechanism
Route::post('/comments/create','PostsController@createcomment');


//Search Mechanism
Route::get('/search','SearchController@index');



//Likes
Route::post('/postliked','LikesController@postliked');
Route::post('/postunliked','LikesController@postunliked');


