<?php



Route::group(['middleware'=>['api']],function(){

    Route::get('user/{id}', 'Api\LeaveApproversController@index')->name('getUser');

    Route::get('leave/{id}/approvers',['uses'=>'Api\LeavesController@fetchLeaveApprovers','as' => 'api.leaves.approvers']);

});