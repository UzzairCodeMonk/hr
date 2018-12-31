<?php

Route::group(['prefix'=>'wage','middleware'=>'auth'],function () {
    Route::get('/', 'WagesController@index');
    Route::get('{id}/view', ['uses' => 'PayslipsController@viewMyPayslip', 'as' => 'payslip.my.payslip'])->middleware('signed');
    Route::view('payslip', 'wage::payslips.payslip');
});

Route::group(['prefix' => config('app.administration_prefix'), 'middleware' => 'auth'], function () {

    Route::group(['prefix' => 'payslips'], function () {
        Route::get('view', ['uses' => 'PayslipsController@index', 'as' => 'payslip.index']);
        Route::get('{id}/view', ['uses' => 'PayslipsController@show', 'as' => 'payslip.show'])->middleware('signed');
        Route::post('generate', ['uses' => 'PayslipsController@generatePayslip', 'as' => 'payslip.generate']);
        Route::get('{id}/{month}/{year}/view', ['uses' => 'PayslipsController@viewPayslip', 'as' => 'payslip.employee.record'])->middleware('signed');
    });

});
