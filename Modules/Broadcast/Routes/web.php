<?php



Route::group(['prefix' => config('app.administration_prefix'), 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'memo'], function () {
        Route::get('create', ['uses' => 'MemosController@create']);
    });
});
