<?php

use Illuminate\Support\Facades\Route;

Route::get('activity/update', 'ActivityController@update');

Route::group([
    'prefix' => 'auth'
], function () {
    Route::view('login', 'pages.auth.login')->name('auth.login')->middleware('l.out');
    Route::view('register', 'pages.auth.register')->name('auth.register')->middleware('l.out');
    Route::get('logout', 'AuthController@logout')->name('auth.logout')->middleware('l.in');
    Route::post('login', 'AuthController@login')->middleware('l.out');
    Route::post('register', 'AuthController@register')->middleware('l.out');
});

Route::group([
    'middleware' => 'l.in',
    'namespace' => 'Transaction',
], function () {
    Route::get('pay', 'PayController@home')->name('pay.home');
    Route::post('pay/proceed', 'PayController@proceed')->name('pay.proceed');
    Route::get('charge', 'ChargeController@home')->name('charge.home');
    Route::post('charge/proceed', 'ChargeController@proceed')->name('charge.proceed');
    Route::get('lookup', 'LookupController@home')->name('lookup.home');
    Route::get('issue', 'RegisterController@issueToken')->name('register.user');
    Route::get('register', 'RegisterController@checkFingerprint')->name('register.home');
    Route::post('register/proceed', 'RegisterController@saveFingerprint')->name('register.proceed');
    Route::get('transaction/rollback/{id}', 'TransactionController@rollback')->name('transaction.rollback');
});

Route::group([
    'middleware' => 'l.in'
], function () {
    Route::get('/', 'ContentController@home')->name('home');
    Route::get('unlock', 'ContentController@unlock')->name('unlock');
});
