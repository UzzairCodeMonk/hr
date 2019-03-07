<?php

Auth::routes();
Route::view('dashboard', 'dashboard');
Route::get('/', 'Auth\LoginController@showLoginForm');

Route::group(['middleware' => 'auth'], function () {
    Route::post('notification/mark', ['uses' => 'NotificationsController@markAsRead', 'as' => 'notification.read']);
    Route::get('my-notifications', ['uses' => 'NotificationsController@getMyNotifications', 'as' => 'personal.notifications']);
    Route::delete('notifications/delete', ['uses' => 'NotificationsController@deleteNotifications', 'as' => 'delete.notifications']);
    Route::get('notifications',['uses' => 'NotificationsController@index', 'as' => 'notifications']);

});
// prefix
// middleware
// name

Route::group(['prefix' => config('app.administration_prefix') . '/employees', 'middleware' => ['auth', 'role:Admin']], function () {

    Route::group(['prefix' => 'employees'], function () {
        Route::get('/', 'UsersController@index')->name('user.index');
        Route::get('create', 'UsersController@create')->name('user.create');
        Route::get('{id}/edit', 'UsersController@edit')->name('user.edit')->middleware('signed');
        Route::post('store', 'UsersController@store')->name('user.store');
        Route::post('{id}/update', 'UsersController@update')->name('user.update');
        Route::delete('{id}/destroy', 'UsersController@destroy')->name('user.destroy');
        Route::post('send-email', 'UsersController@hantarEmail');
    });
});
Route::group(['prefix' => config('app.administration_prefix'), 'middleware' => ['auth', 'role:Admin']], function () {
    Route::resource('roles', 'RolesController');
});
Route::get('load-primary-school', 'UsersController@loadPrimarySchools')->name('load.primarySchool');
Route::get('test-api', 'UsersController@testApi')->name('load.api');

Route::view('admin-panel', 'backend.admin.index')->middleware(['auth','role:Admin'])->prefix(config('app.administration_prefix'))->name('backend.admin.index');

Route::get('dashboard', 'DashboardsController@index')->middleware(['auth','role:Admin'])->prefix(config('app.administration_prefix'))->name('backend.admin.index');

Route::post('demos/jquery-image-upload','DemoController@saveJqueryImageUpload');
