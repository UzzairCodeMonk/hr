<?php

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::view('master','backend.master');

Route::get('employees','UsersController@index')->name('user.index');