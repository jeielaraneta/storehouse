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
})->name('login');

Auth::routes(['verify' => true]);

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/setPassword/{user}', 'Auth\SetUserPassword@index')->name('set.password')->middleware('signed');

Route::post('/setPassword/update/{user}', 'Auth\SetUserPassword@update')->name('update.password');

Route::prefix('/members')->group(function () {

    Route::get('/', 'MemberController@index')->name('member.index');
    Route::get('/create', 'MemberController@create')->name('member.create');
    Route::post('/store', 'MemberController@store')->name('member.store');
    Route::get('/show/{id}', 'MemberController@show')->name('member.show');
    Route::put('/update/{id}', 'MemberController@update')->name('member.update');
    Route::get('/search', 'MemberController@apiResource')->name('member.search');
    Route::get('/api', 'MemberController@apiResource');

});

Route::prefix('/records')->group(function () {

    Route::get('/', 'RecordController@index')->name('record.index');
    Route::get('/create', 'RecordController@create')->name('record.create');
    Route::post('/store', 'RecordController@store')->name('record.store');
    Route::get('/show/{id}', 'RecordController@show')->name('record.show');
    Route::put('/update/{id}', 'RecordController@update')->name('record.update');
    Route::get('/api', 'RecordController@apiResource');

});

Route::prefix('/users')->group(function () {

    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('/create', 'UserController@create')->name('user.create');

});

Route::prefix('/specialOffering')->group(function () {

    Route::get('/show/{id}', 'SpecialOfferingController@show')->name('specialOffering.show');

});
