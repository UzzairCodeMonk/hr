<?php

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('notification/{id}/mark', ['uses' => 'NotificationsController@markAsRead', 'as' => 'notification.read']);
Route::group(['prefix' => config('app.administration_prefix'), 'middleware' => ['auth','role:Admin']], function () {
    Route::resource('roles', 'RolesController');
    Route::group(['prefix' => 'employees'], function () {
        Route::get('/', 'UsersController@index')->name('user.index');
        Route::get('create', 'UsersController@create')->name('user.create');
        Route::get('{id}/edit', 'UsersController@edit')->name('user.edit')->middleware('signed');
        Route::post('store', 'UsersController@store')->name('user.store');
        Route::post('{id}/update', 'UsersController@update')->name('user.update');
        Route::delete('{id}/destroy', 'UsersController@destroy')->name('user.destroy');
        Route::post('send-email','UsersController@hantarEmail');
    });
});
Route::get('load-primary-school','UsersController@loadPrimarySchools')->name('load.primarySchool');
Route::get('test-api','UsersController@testApi')->name('load.api');

