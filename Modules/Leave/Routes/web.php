<?php

Route::get('test-upl', function () {
    $now = Carbon\Carbon::now();
    $month = $now->format('m');
    $year = $now->format('Y');
    $upl = Modules\Leave\Entities\Leave::whereHas('type', function ($query) {
        $query->where('name', '=', 'Unpaid Leave');
    })->whereMonth('start_date', $month)->whereYear('start_date', $year)->where('user_id',auth()->id())->get();
    ;
    
    dd(collect($upl)->sum('days_taken'));
});
// Normal routes
Route::group(['prefix' => 'leaves', 'middleware' => 'auth'], function () {

    // leaves

    Route::post('store', 'LeavesController@store')->name('leave.store');
    Route::get('{id}/show', 'LeavesController@show')->name('leave.show')->middleware('signed');
    Route::get('{id}/show/my-leave', 'LeavesController@showUserLeaves')->name('my-leave.show')->middleware('signed');
    Route::get('{id}/edit/my-leave', 'LeavesController@editUserLeaves')->name('my-leave.edit')->middleware('signed');
    Route::post('{id}/update','LeavesController@update')->name('my-leave.update');
    Route::get('personal', 'LeavesController@showMyLeaveApplications')->name('leave.personal');
    Route::get('apply', ['uses' => 'LeavesController@showLeaveApplicationForm', 'as' => 'leave.apply']);
    Route::delete('{id}/delete', ['uses' => 'LeavesController@destroy', 'as' => 'leave.user.destroy']);
});

// Administration routes
Route::group(['prefix' => config('app.administration_prefix'), 'middleware' => 'auth'], function () {
    
    // leaves
    Route::group(['prefix' => 'leaves'], function () {

        Route::get('/', 'LeavesController@index')->name('leave.index');

        Route::group(['prefix' => 'leave-records'], function () {
            Route::delete('{id}/delete', ['uses' => 'LeavesController@destroy', 'as' => 'leave.destroy']);
            Route::get('{id}/show', 'LeavesController@showUserLeaves')->name('leave.employee.show')->middleware('signed');
            Route::post('{id}/approve-reject', 'LeavesController@approveRejectLeave')->name('leave.approve.reject');
            Route::get('{id}/excel-export', 'LeavesController@exportUserLeaves')->name('leave.export.excel');
        });
                
    // leave types
        Route::group(['prefix' => 'leave-types'], function () {
            Route::get('/', ['uses' => 'LeaveTypesController@index', 'as' => 'leave-type.index']);
            Route::post('store', ['uses' => 'LeaveTypesController@store', 'as' => 'leave-type.store']);
            Route::post('{id}/update', ['uses' => 'LeaveTypesController@update', 'as' => 'leave-type.update']);
            Route::get('{id}/edit', ['uses' => 'LeaveTypesController@edit', 'as' => 'leave-type.edit']);
            Route::delete('{id}/delete', ['uses' => 'LeaveTypesController@destroy', 'as' => 'leave-type.destroy']);
        });

    //  holiday
        Route::group(['prefix' => 'holiday'], function () {
            Route::get('/', ['uses' => 'HolidaysController@index', 'as' => 'holiday.index']);
            Route::post('store', ['uses' => 'HolidaysController@store', 'as' => 'holiday.store']);
            Route::post('{id}/update', ['uses' => 'HolidaysController@update', 'as' => 'holiday.update']);
            Route::get('{id}/edit', ['uses' => 'HolidaysController@edit', 'as' => 'holiday.edit']);
            Route::delete('{id}/delete', ['uses' => 'HolidaysController@destroy', 'as' => 'holiday.destroy']);
        });
    });

});
