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

Route::resource('admin','Admin\AdminController');
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect('admin/sys_develop');
    });
    Route::get('/sys_develop','Admin\SystemController@index');
    Route::get('/service','Admin\ServiceController@index');
});
