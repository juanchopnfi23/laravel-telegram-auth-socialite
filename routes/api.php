<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::group(['middleware' => 'MyApi', 'middleware' => 'MyJson' ],
Route::group(['middleware' => 'MyApi'], function(){

    Route::resource( 'posts' , 'Api\PostsController' );

	Route::get('posts/{id}/comments','Api\PostsController@showComments');

	Route::resource( 'users' , 'Api\UsersController' );

	Route::get('users/{id}/posts','Api\UsersController@showPosts');

});

