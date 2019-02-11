<?php

Route::group(['prefix' => config('app.administration_prefix')], function () {

    Route::group(['prefix' => 'site', 'middleware' => ['auth', 'role:Admin']], function () {
        
        Route::get('/', ['uses' => 'SitesController@index', 'as' => 'siteconfig.index']);
        
        Route::post('store', ['uses' => 'SitesController@store', 'as' => 'siteconfig.store']);
    });

    Route::group(['prefix' => 'company', 'middleware' => ['auth', 'role:Admin']], function () {
        
        Route::get('/', ['uses' => 'CentersController@index', 'as' => 'company.index']);
        
        Route::get('create', ['uses' => 'CentersController@create', 'as' => 'company.create']);

        Route::get('edit/{id}', ['uses' => 'CentersController@edit', 'as' => 'company.edit']);

        Route::post('store', ['uses' => 'CentersController@store', 'as' => 'company.store']);

        Route::put('update/{id}',['uses' => 'CentersController@update', 'as' => 'company.update']);

        Route::delete('delete',['uses' => 'CentersController@destroy','as' => 'company.delete']);
    });

    
});
