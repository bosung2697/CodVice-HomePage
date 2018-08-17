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
    return view('home');
});

Route::get('home','HomeController@index');


Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect('admin/sys_develop');
    });
//    System Development
    Route::get('/sys_develop','Admin\SystemController@index');
    Route::get('/sys_develop/create', 'Admin\SystemController@create');
    Route::get('/sys_develop/{id}/edit','Admin\SystemController@edit');
    Route::put('/sys_develop/{id}/update','Admin\SystemController@update')->name('admin.system.update');
    Route::delete('/sys_develop/{id}','Admin\SystemController@destroy')->name('admin.system.delete');
    Route::post('/sys_develop/', 'Admin\SystemController@store')->name('admin.system.store');

//    Service
    Route::get('/service','Admin\ServiceController@index');
    Route::get('/service/create', 'Admin\ServiceController@create');
    Route::get('/service/{id}/edit','Admin\ServiceController@edit');
    Route::put('/service/{id}/update','Admin\ServiceController@update')->name('admin.service.update');
    Route::delete('/service/{id}','Admin\ServiceController@destroy')->name('admin.service.delete');
    Route::post('/service/', 'Admin\ServiceController@store')->name('admin.service.store');
});
