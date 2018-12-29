<?php

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');

Route::group(['prefix' => config('app.administration_prefix'), 'middleware' => 'auth'], function () {
    Route::resource('roles', 'RolesController');
    Route::group(['prefix' => 'employees'], function () {
        Route::get('/', 'UsersController@index')->name('user.index');
        Route::get('create', 'UsersController@create')->name('user.create');
        Route::post('store', 'UsersController@store')->name('user.store');
        Route::delete('{id}/destroy', 'UsersController@destroy')->name('user.destroy');
    });
});
