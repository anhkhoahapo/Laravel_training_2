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
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.get_login');
        Route::post('login', 'Auth\LoginController@login')->name('admin.post_login');
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
        Route::post('class/{class}/student-score', 'ClassManagingController@updateStudentScore')->name('admin.class.student_score');
    });
});

Route::group(['namespace' => 'Student', 'prefix' => 'student'], function (){
    Route::group(['middleware' => 'guest:student'], function (){
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('student.get_login');
        Route::post('login', 'Auth\LoginController@login')->name('student.post_login');
    });

    Route::group(['middleware' => 'auth_student'], function (){
        Route::post('logout', 'Auth\LoginController@logout')->name('student.logout');
        Route::get('home', 'HomeController@index')->name('student.home');
        Route::get('registered-classes', 'HomeController@registeredClasses')->name(('student.registered_classes'));
        Route::get('classes', 'ClassRegisterController@getClassList')->name(('student.classes'));
        Route::get('search', 'ClassRegisterController@search')->name(('student.classes.search'));
        Route::post('register', 'ClassRegisterController@register')->name('student.class_register');
        Route::delete('unregister', 'ClassRegisterController@unregister')->name('student.class_unregister');
    });
});

Route::group(['namespace' => 'Teacher', 'prefix' => 'teacher'], function (){
    Route::group(['middleware' => 'guest:teacher'], function (){
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('teacher.get_login');
        Route::post('login', 'Auth\LoginController@login')->name('teacher.post_login');
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('teacher.password.reset');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('teacher.password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('teacher.password.reset');
    });

    Route::group(['middleware' => 'auth_teacher'], function (){
        Route::post('logout', 'Auth\LoginController@logout')->name('teacher.logout');

        Route::get('changePassword', 'HomeController@showChangePasswordForm')->name('teacher.changePassword');
        Route::put('changePassword', 'HomeController@changePassword')->name('teacher.changePassword');

        Route::get('home', 'HomeController@index')->name('teacher.home');
        Route::get('registered-classes', 'HomeController@registeredClasses')->name('teacher.registered_classes');
        Route::get('classes', 'ClassRegisterController@getClassList')->name('teacher.classes');
        Route::get('search', 'ClassRegisterController@search')->name('teacher.classes.search');
        Route::post('register', 'ClassRegisterController@register')->name('teacher.class_register');
        Route::delete('unregister', 'ClassRegisterController@unregister')->name('teacher.class_unregister');

        Route::get('class/{class}/list-student', 'ClassStudentsController@getListStudent')->name('teacher.class_students');
        Route::post('class/{class}/student-score', 'ClassStudentsController@updateStudentScore')->name('teacher.student_score');
    });
});

