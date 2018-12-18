<?php

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::view('master','backend.master');

Route::get('employees','UsersController@index')->name('user.index');
Route::get('employees/create','UsersController@create')->name('user.create');
Route::post('employees/store','UsersController@store')->name('user.store');