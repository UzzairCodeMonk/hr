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
     //claim status user
     Route::get('my-claims/status/{status}', 'ClaimsController@myclaims')->name('claim.myclaims'); 
     Route::get('editClaim/{id}','ClaimsController@editClaim')->name('claim.editClaim')->middleware('signed');  

});

Route::group(['prefix' => 'claimdetails', 'middleware' => ['auth']],function(){

    Route::post('store','ClaimDetailsController@store')->name('claimdetail.store');
    Route::get('show/{id}', 'ClaimDetailsController@show')->name('claimdetail.show'); 
    Route::post('update',['before' => 'auth|csrf','uses' =>'ClaimDetailsController@update', 
    'as' => 'claimdetail.update' ]);
    //edit,delete dan update 
    Route::get('edit/{id}', 'ClaimDetailsController@edit')->name('claimdetail.edit');
    Route::post('update/{id}', 'ClaimDetailsController@updateclaim')->name('claimdetail.updateclaim');
    Route::delete('deletedetail/{id}', 'ClaimDetailsController@deletedetail')->name('claimdetail.deletedetail');
    Route::get('showAuth/{id}', 'ClaimDetailsController@showAuth')->name('claimdetail.showAuth'); 
    Route::get('pdf-claimdetail/{id}','ClaimDetailsController@exportPDFclaim')->name('pdf-claim'); //convert pdf
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
        Route::get('pdf/{month}/{year}','PayslipsController@exportPDF')->name('pdf'); //convert pdf
        Route::delete('{id}/payslip-summary/delete',['uses' => 'PayslipsController@destroySummary','as'=>'payslip-summary.delete']);//delete summary
    });

    Route::group(['prefix' => 'claim'],function(){
        Route::get('records','ClaimsController@claimRecords')->name('claim.records');
         //asing ikut status
         Route::get('status/{status}','ClaimsController@claimstatus')->name('claim.statusrecord');
    });

     // claim types
     Route::group(['prefix' => 'claim-category'], function () {

        Route::get('/',['uses' => 'ClaimTypeController@index', 'as' => 'claim-type.index']);
        Route::post('store',['uses' => 'ClaimTypeController@store', 'as' => 'claim-type.store']);
        Route::post('{id}/update',['uses' => 'ClaimTypeController@update', 'as' => 'claim-type.update']);
        Route::get('{id}/edit',['uses' => 'ClaimTypeController@edit', 'as' => 'claim-type.edit']);
        Route::delete('{id}/delete',['uses' => 'ClaimTypeController@destroy', 'as' => 'claim-type.destroy']);
    });


});
