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
    return view('auth.login');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/members')->group(function () {

    Route::get('/', 'MemberController@index')->name('member.index');
    Route::get('/create', 'MemberController@create')->name('member.create');
    Route::post('/store', 'MemberController@store')->name('member.store');
    Route::get('/show/{id}', 'MemberController@show')->name('member.show');
    Route::put('/update/{id}', 'MemberController@update')->name('member.update');

});

Route::prefix('/records')->group(function () {

    Route::get('/', 'RecordController@index')->name('record.index');
    Route::get('/create', 'RecordController@create')->name('record.create');

});
