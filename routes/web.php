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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function (){
    Route::group(['middleware' => 'guest:admin'], function (){
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.get-login');
        Route::post('login', 'Auth\LoginController@login')->name('admin.post-login');
    });

    Route::group(['middleware' => 'auth_admin'], function (){
        Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');
        Route::get('home', 'HomeController@index')->name('admin.home');
    });
});