<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::prefix('wage')->group(function () {
    Route::get('/', 'WagesController@index');

    Route::group(['prefix' => 'administration'], function () {
        //get users record
        Route::group(['prefix' => 'payslips'], function () {
            Route::get('view', ['uses' => 'PayslipsController@index','as'=>'payslip.index']);
            Route::get('{id}/view',['uses' => 'PayslipsController@show','as'=>'payslip.show'])->middleware('signed');
            Route::post('generate',['uses'=>'PayslipsController@generatePayslip','as'=>'payslip.generate']);
            Route::get('{id}/{month}/{year}/view',['uses'=>'PayslipsController@viewPayslip','as'=>'payslip.employee.record'])->middleware('signed');
        });
        
        //generate payslip
        //generate 
    });
    Route::view('payslip','wage::payslips.payslip');
});
