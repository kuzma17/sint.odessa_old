<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/', function () {
 //   return view('welcome');
//});
Route::get('/', 'PageController@home');

Auth::routes();

//Route::get('/home', 'HomeController@index');

//Route::get('/social_login', 'SocialController@index');
Route::get('/social/{provider}', 'SocialController@login');
Route::get('/social/callback/{provider}', 'SocialController@callback');

Route::get('/user', ['as'=>'user.profile', 'uses'=>'UserProfileController@profile']);
Route::get('/user/edit', ['as'=>'user.profile.edit', 'uses'=>'UserProfileController@edit']);
Route::post('/user/edit', ['as'=>'user.profile.save', 'uses'=>'UserProfileController@edit']);
Route::get('/user/avatar', ['as'=>'user.avatar.edit', 'uses'=>'UserProfileController@avatar']);
Route::post('/user/avatar', ['as'=>'user.avatar.save', 'uses'=>'UserProfileController@avatar']);
Route::get('/user/avatar/delete', ['as'=>'user.avatar.delete', 'uses'=>'UserProfileController@dell_avatar']);
Route::get('/user/password', ['as'=>'user.password.edit', 'uses'=>'UserProfileController@edit_password']);
Route::post('/user/password', ['as'=>'user.password.save', 'uses'=>'UserProfileController@edit_password']);

//Route::get('/order', ['as'=>'user.order', 'uses'=>'OrderController@order']);
Route::get('/order', ['as'=>'user.order.add', 'uses'=>'OrderController@add_order']);
Route::post('/order', ['as'=>'user.order.save', 'uses'=>'OrderController@add_order']);

Route::get('/home', ['as'=>'home', 'uses'=>'PageController@home']);
Route::get('/contacts', ['as'=>'contacts', 'uses'=>'PageController@contacts']);
Route::get('/mail', ['as'=>'mail', 'uses'=>'PageController@mail']);
Route::post('/mail', ['as'=>'send.mail', 'uses'=>'PageController@send_mail']);
Route::get('/stock', ['as'=>'stock', 'uses'=>'PageController@stock']);
Route::get('/news', ['as'=>'news', 'uses'=>'NewsController@index']);
Route::get('/news/{id}', ['as'=>'news_id', 'uses'=>'NewsController@news']);

Route::get('/login_admin', ['as'=>'login.admin', 'uses'=>'Auth\LoginController@showLoginForm']);
Route::post('/login_admin', ['as'=>'login.admin.auth', 'uses'=>'Auth\LoginController@login']);
Route::get('/admin', ['as'=>'admin.dashboard']);
Route::get('/admin/logout', ['as'=>'admin.logout', 'uses'=>'Auth\LoginController@logout']);

Route::get('/{url}', ['as'=>'page', 'uses'=>'PageController@page']);

Route::post('upload-image', ['as'=>'upload_image', 'uses'=>'FileUploadController@uploader']);
