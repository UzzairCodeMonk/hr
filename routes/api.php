<?php

use Illuminate\Http\Request;


Route::group(['middleware' => ['api']], function () {

    Route::get('users', ['uses' => 'Api\UsersController@index', 'as' => 'api.users.index']);
    
    Route::get('hello', ['uses' => 'Api\UsersController@fetchGenderStats', 'as' => 'stats']);
    
    Route::get('leave-approvers/{id}', ['uses' => 'Api\UsersController@fetchLeaveApprovers', 'as' => 'user.leave-approvers']);

    Route::get('claim-approvers/{id}', ['uses' => 'Api\UsersController@fetchClaimApprovers', 'as' => 'user.claim-approvers']);
});
