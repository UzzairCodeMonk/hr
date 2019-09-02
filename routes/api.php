<?php

use Illuminate\Http\Request;


Route::group(['middleware' => ['api']], function () {

    Route::get('users', ['uses' => 'Api\UsersController@index', 'as' => 'api.users.index']);
    
    Route::get('hello', ['uses' => 'Api\UsersController@fetchGenderStats', 'as' => 'stats']);
    
    Route::get('leave-approvers/{id}', ['uses' => 'Api\UsersController@fetchLeaveApprovers', 'as' => 'user.leave-approvers']);

    Route::get('claim-approvers/{id}', ['uses' => 'Api\UsersController@fetchClaimApprovers', 'as' => 'user.claim-approvers']);
});

//mobile

Route::post('register','Api\Auth\RegisterController@register');
Route::post('login','Api\Auth\LoginController@login');
Route::post('refresh','Api\Auth\LoginController@refresh');
// Route::middleware('auth:api')->get('/user',function(Request $request){
//    dd("salut");

// });
Route::group(['middleware'=>['auth:api']],function (){
    Route::get('user',function (){
        return ['data' => 'Token is valid'];
    });

    Route::post('logout','Api\Auth\LoginController@logout');
    Route::get('leave/submitted','Api\Mobile\AppController@leaveSubmitted');
    Route::get('leave/approved','Api\Mobile\AppController@leaveApproved');
    Route::get('leave/rejected','Api\Mobile\AppController@leaveRejected');
    Route::get('leave/withdrawn','Api\Mobile\AppController@leaveWithdrawn');
    Route::get('authUser','Api\Mobile\AppController@authUser');
    // Route::get('allUser','Api\Mobile\AppController@allUser');
    Route::get('auth/leave/submitted','Api\Mobile\AppController@leaveSubmittedByAuth');
    Route::get('auth/leave/approved','Api\Mobile\AppController@leaveApprovedByAuth');
    Route::get('auth/leave/rejected','Api\Mobile\AppController@leaveRejectedByAuth');
    Route::get('auth/leave/withdrawn','Api\Mobile\AppController@leaveWithdrawnByAuth');
});