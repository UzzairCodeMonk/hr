<?php

// Normal routes
Route::group(['prefix' => 'leaves', 'middleware' => 'auth'], function () {


Route::get('status/{status}',            'LeavesController@index')->name('leave.index');



Route::get('withdrawn',                  'LeavesController@withdrawn')->name('leave.withdrawn');



Route::get('apply',                      'LeavesController@create')->name('leave.apply');    




Route::post('store',                     'LeavesController@store')->name('leave.store');



Route::get('show/{id}',                  'LeavesController@show')->name('leave.show')->middleware('signed');



Route::get('show/withdrawn/{id}',                  'LeavesController@showWithdrawn')->name('leave.show.withdrawn')->middleware('signed');
    


Route::get('edit/{id}',                  'LeavesController@edit')->name('leave.edit')->middleware('signed');
    

Route::post('my-leave/update/{id}',      'LeavesController@update')->name('my-leave.update');    
    

Route::delete('{id}/delete',             'LeavesController@destroy')->name('leave.user.destroy');

Route::delete('{id}/retract',             'LeavesController@retract')->name('leave.user.retract');


});

// Administration routes
Route::group(['prefix' => config('app.administration_prefix'), 'middleware' => ['auth','role:Admin']], function (){    
    // leaves
    Route::group(['prefix' => 'leaves'], function () {

    Route::get('status/{status}',                               'AdminLeavesController@index')->name('leave.admin.index');
    

    Route::get('withdrawn',                                      'AdminLeavesController@withdrawn')->name('leave.admin.withdrawn');

    Route::get('show/withdrawn/{id}',                  'AdminLeavesController@showWithdrawn')->name('leave.admin.show.withdrawn')->middleware('signed');

    Route::get('apply-for-employees',             'LeavesController@create')->name('admin.apply.leave');


    Route::get('{id}/show',                       'AdminLeavesController@show')->name('leave.admin.show')->middleware('signed');
    
        
    Route::delete('{id}/retract',                  'AdminLeavesController@retract')->name('leave.admin.retract');
            
    
    
    Route::post('{id}/approve-reject',            'AdminLeavesController@approveRejectLeave')->name('leave.approve.reject');
    
    
    
    Route::get('{id}/excel-export',               'LeavesController@exportUserLeaves')->name('leave.export.excel');
    
    
    // leave types
    Route::group(['prefix' => 'leave-types'], function () {
            
        Route::get('/',                               ['uses' => 'LeaveTypesController@index', 'as' => 'leave-type.index']);
    
    
        Route::post('store',                          ['uses' => 'LeaveTypesController@store', 'as' => 'leave-type.store']);
                
        
        Route::post('{id}/update',                    ['uses' => 'LeaveTypesController@update', 'as' => 'leave-type.update']);
                
        
        Route::get('{id}/edit',                       ['uses' => 'LeaveTypesController@edit', 'as' => 'leave-type.edit']);
                
        
        Route::delete('{id}/delete',                  ['uses' => 'LeaveTypesController@destroy', 'as' => 'leave-type.destroy']);
            
    
    });
    
        //  holiday
        Route::group(['prefix' => 'holiday'], function () {
                
            
        Route::get('/',                               ['uses' => 'HolidaysController@index', 'as' => 'holiday.index']);
                
                
        Route::post('store',                          ['uses' => 'HolidaysController@store', 'as' => 'holiday.store']);
                
                
        Route::post('{id}/update',                    ['uses' => 'HolidaysController@update', 'as' => 'holiday.update']);
                
                
        Route::get('{id}/edit',                       ['uses' => 'HolidaysController@edit', 'as' => 'holiday.edit']);
                
                
        Route::delete('{id}/delete',                  ['uses' => 'HolidaysController@destroy', 'as' => 'holiday.destroy']);
            
    
    });
    
    // Configurations
    
    Route::group(['prefix'=>'configurations'],function(){
    
        
    Route::get('/',                              ['uses' => 'ConfigsController@index', 'as' => 'leave.config.index']);
    
    
    Route::post('store',                         ['uses' => 'ConfigsController@store', 'as' => 'leave.config.store']);
    
    });

    
 });
                
    
    

});

