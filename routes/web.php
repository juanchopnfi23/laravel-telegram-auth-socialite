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

// Raiz Bienvenida

Route::get('/', function(){
	return View('welcome');
});

// Home

Route::get('/home', 'Web\HomeController@index')->name('home');

// Rutas Auth
Route::group(['middleware' => ['auth']], function(){

	Route::resource('users', 'Web\UsersController');
   	Route::resource('posts', 'Web\PostsController');
   	Route::resource('comments', 'Web\CommentsController');

});

// Authentication Routes...
Route::get('login', 'Web\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Web\Auth\LoginController@login');
Route::post('logout', 'Web\Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Web\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Web\Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Web\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Web\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Web\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Web\Auth\ResetPasswordController@reset');

// auth socialite

Route::get('/oauth/{provider}', 'Web\Auth\SocialAuthController@redirectToProvider');
Route::get('/oauth/{provider}/callback', 'Web\Auth\SocialAuthController@handleProviderCallback');
// probando telegram
Route::get('tel',function(){
	// obtener informacion
	$response = Telegram::getMe();

	$botId = $response->getId();
	$firstName = $response->getFirstName();
	$username = $response->getUsername();
	
	// enviar mensaje
	$response = Telegram::sendMessage([
	  'chat_id' => '-190334946', 
	  'text' => 'Hello , i am the bot of juan'
	]);

	$messageId = $response->getMessageId();
	return response($response);
});