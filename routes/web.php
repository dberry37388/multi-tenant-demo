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

Route::domain("gopcollab.com")->group(function() {
   Route::get('/', function() {
       return view('welcome');
   });
});

Route::domain("www.gopcollab.com")->group(function() {
    Route::get('/', function() {
        return view('welcome');
    });
});

Route::group(['middleware' => 'tenancy.enforce'], function () {
        Route::get('/', 'Auth\LoginController@showLoginForm');
    
        Auth::routes();
        
        Route::get('/home', 'HomeController@index')->name('home');
});
