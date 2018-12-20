<?php

Route::group(['prefix'=>'leaves','middleware'=>['auth']],function () {
    Route::get('/', 'LeavesController@index')->name('leave.index');
    Route::post('/', 'LeavesController@store')->name('leave.store');
    Route::get('{id}/show','LeavesController@show')->name('leave.show')->middleware('signed');
    Route::get('personal', 'LeavesController@showMyLeaveApplications')->name('leave.personal');
    Route::get('apply', ['uses' => 'LeavesController@showLeaveApplicationForm', 'as' => 'leave.apply']);
    
    Route::group(['prefix' => 'administration'], function () {
        Route::group(['prefix' => 'leave-types'], function () {
            Route::get('/', ['uses' => 'LeaveTypesController@index', 'as' => 'leave-type.index']);
            Route::post('store', ['uses' => 'LeaveTypesController@store', 'as' => 'leave-type.store']);
            Route::post('{id}/update', ['uses' => 'LeaveTypesController@update', 'as' => 'leave-type.update']);
            Route::get('{id}/edit', ['uses' => 'LeaveTypesController@edit', 'as' => 'leave-type.edit']);
            Route::delete('{id}/delete', ['uses' => 'LeaveTypesController@destroy', 'as' => 'leave-type.destroy']);
        });
    });

});
