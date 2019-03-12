<?php



Route::group(['middleware'=>['api']],function(){

    Route::get('leave/{id}/approvers',['uses'=>'Api\LeavesController@fetchLeaveApprovers','as' => 'api.leaves.approvers']);

});