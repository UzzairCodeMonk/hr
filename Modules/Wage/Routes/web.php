<?php

Route::group(['prefix' => 'wage', 'middleware' => 'auth'], function () {
    Route::get('/', 'WagesController@index');
    Route::get('{id}/view', ['uses' => 'PayslipsController@viewMyPayslip', 'as' => 'payslip.my.payslip'])->middleware('signed');
    Route::view('payslip', 'wage::payslips.payslip');
    Route::get('my-payslips', ['uses' => 'PayslipsController@myPayslips', 'as' => 'payslip.personal-payslips'])->middleware('signed');
    Route::get('{id}/{month}/{year}/view', ['uses' => 'PayslipsController@viewPayslip', 'as' => 'payslip.my.record'])->middleware('signed');
    Route::get('{id}/{month}/{year}/print', ['uses' => 'PayslipsController@printPayslip', 'as' => 'payslip.print'])->middleware('signed');
});


Route::group(['prefix' => 'claim', 'middleware' => ['auth']], function () {
    
    Route::get('{id}/detail', 'ClaimsController@index')->name('claim.detail')->middleware('signed');
    Route::post('store', 'ClaimsController@store')->name('claim.store');
    Route::delete('{id}/delete', ['uses' => 'ClaimsController@destroy', 'as' => 'claim.destroy']);
    Route::get('{id}/show','ClaimsController@show')->name('claim.show')->middleware('signed');    
    Route::get('my-claims','ClaimsController@showMyClaims')->name('claim.my-claims');
    Route::post('submit', 'ClaimSubmissionsController@store')->name('claim.submit');
    Route::post('approval', 'ClaimApprovalsController@store')->name('claim.approval.store');

});

Route::group(['prefix' => 'claimdetails', 'middleware' => ['auth']],function(){

    Route::post('store','ClaimDetailsController@store')->name('claimdetail.store');
    Route::get('show/{id}', 'ClaimDetailsController@show')->name('claimdetail.show'); 
    Route::post('update',['before' => 'auth|csrf','uses' =>'ClaimDetailsController@update', 
    'as' => 'claimdetail.update' ]);

});


Route::group(['prefix' => config('app.administration_prefix').'/wages', 'middleware' => ['auth','role:Admin']], function () {

    Route::group(['prefix' => 'payslips'], function () {
        Route::get('view', ['uses' => 'PayslipsController@index', 'as' => 'payslip.index']);
        Route::get('{id}/view', ['uses' => 'PayslipsController@show', 'as' => 'payslip.show'])->middleware('signed');
        Route::post('generate', ['uses' => 'PayslipsController@generatePayslip', 'as' => 'payslip.generate']);
        Route::get('{id}/{month}/{year}/view', ['uses' => 'PayslipsController@viewPayslip', 'as' => 'payslip.employee.record'])->middleware('signed');
        Route::delete('{id}/delete',['uses' => 'PayslipsController@destroy','as'=>'payslip.delete']);
        Route::get('generate-payslip-index','PayslipsController@showPayslipSummaryForm')->name('payslip.summary');
        Route::post('payslip-summary','PayslipsController@generatePayslipSummary')->name('generate.payslip.summary');
        Route::get('show/payslip-summary/{month}/{year}','PayslipsController@showPayslipSummary')->name('show.payslip.summary');
        Route::get('print-payslip-summary/{month}/{year}','PayslipsController@printPayslipSummary')->name('print.payslip.summary');
    });

    Route::group(['prefix' => 'claim'],function(){
        Route::get('records','ClaimsController@claimRecords')->name('claim.records');
    });

});
