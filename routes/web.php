<?php

Auth::routes();

Route::view('/', 'auth.login');

Route::view('master', 'backend.master');

Route::group(['prefix' => 'administration', 'middleware' => ['auth']], function () {
    Route::group(['prefix' => 'employees'], function () {
        Route::get('/', 'UsersController@index')->name('user.index');
        Route::get('create', 'UsersController@create')->name('user.create');
        Route::post('store', 'UsersController@store')->name('user.store');
    });
});
