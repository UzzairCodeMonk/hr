<?php

Auth::routes();

Route::view('/', 'auth.login');

Route::group(['prefix' => env('ADMINISTRATION_PREFIX','administration'), 'middleware' => ['auth']], function () {
    Route::resource('roles', 'RolesController');
    Route::group(['prefix' => 'employees'], function () {
        Route::get('/', 'UsersController@index')->name('user.index');
        Route::get('create', 'UsersController@create')->name('user.create');
        Route::post('store', 'UsersController@store')->name('user.store');
        Route::delete('{id}/destroy', 'UsersController@destroy')->name('user.destroy');
    });
});
