<?php


Route::group(['prefix' => 'site', 'middleware' => 'auth'], function () {

    Route::group(['prefix' => 'administrator'], function () {
        Route::get('site-config', ['uses' => 'SitesController@index','as'=>'siteconfig.index']);
        Route::post('site-config/store', ['uses' => 'SitesController@store','as'=>'siteconfig.store']);
    });
});