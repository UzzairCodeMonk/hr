<?php

Route::group(['prefix' => config('app.administration_prefix')], function () {
    Route::group(['prefix' => 'site', 'middleware' => ['auth', 'role:Admin']], function () {
        Route::get('site-config', ['uses' => 'SitesController@index', 'as' => 'siteconfig.index']);
        
        Route::post('site-config/store', ['uses' => 'SitesController@store', 'as' => 'siteconfig.store']);
    });
});
