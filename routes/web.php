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
        Route::resource('student', 'StudentManagingController', ['as' => 'admin']);
        Route::get('student.search', 'StudentManagingController@search')->name('admin.student.search');

        Route::resource('teacher', 'TeacherManagingController', ['as' => 'admin']);
        Route::get('teacher.search', 'TeacherManagingController@search')->name('admin.teacher.search');

        Route::resource('subject', 'SubjectManagingController', ['as' => 'admin']);
        Route::get('subject.search', 'SubjectManagingController@search')->name('admin.subject.search');

        Route::resource('class', 'ClassManagingController', ['as' => 'admin']);
        Route::get('class.search', 'ClassManagingController@search')->name('admin.class.search');
    });
});

Route::group(['namespace' => 'Student', 'prefix' => 'student'], function (){
    Route::group(['middleware' => 'guest:student'], function (){
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('student.get-login');
        Route::post('login', 'Auth\LoginController@login')->name('student.post-login');
    });

    Route::group(['middleware' => 'auth_student'], function (){
        Route::post('logout', 'Auth\LoginController@logout')->name('student.logout');
        Route::get('home', 'HomeController@index')->name('student.home');
        Route::get('registered-classes', 'HomeController@registeredClasses')->name(('student.registered-classes'));

        Route::get('classes', 'ClassRegisterController@getClassList')->name(('student.classes'));
        Route::get('search', 'ClassRegisterController@search')->name(('student.classes.search'));
        Route::post('register', 'ClassRegisterController@register')->name('student.class-register');
        Route::delete('unregister', 'ClassRegisterController@unregister')->name('student.class-unregister');
    });
});
