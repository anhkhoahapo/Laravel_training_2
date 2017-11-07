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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('401', function(){
   return view('401-permission-denied');
});

Route::middleware(['auth'])->group(function(){
    Route::get('admin/home', function (){
        return view('admin.home');
    })->name('admin.home')->middleware('admin');

    Route::get('teacher/home', function (){
        return view('teacher.home');
    })->name('teacher.home');

    Route::get('student/home', function (){
        return view('student.home');
    })->name('student.home');
});