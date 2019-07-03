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

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

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
    Route::get('/show/{giverType}/{id}', 'RecordController@show')->name('record.show');
    /*Route::get('/show/{giverType}/{id}', [
        'as' => 'record-show',
        'uses' => 'RecordController@show'
    ]);*/

    Route::get('/api', 'RecordController@apiResource');

});

Route::prefix('/specialOffering')->group(function () {

    Route::get('/getSpecialOffering', 'SpecialOfferingController@getSpecialOfferingsRecord')->name('specialOffering.getSpecialOffering');

});
