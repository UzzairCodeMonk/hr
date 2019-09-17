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
    Route::get('allUser','Api\Mobile\AppController@allUser');
    Route::get('searchUser','Api\Mobile\AppController@searchUser');
    Route::delete('user/destroy/{id}','Api\Mobile\AppController@destroy');
    Route::post('user/store','Api\Mobile\AppController@store');
    Route::get('auth/leave/submitted','Api\Mobile\AppController@leaveSubmittedByAuth');
    Route::get('auth/leave/approved','Api\Mobile\AppController@leaveApprovedByAuth');
    Route::get('auth/leave/rejected','Api\Mobile\AppController@leaveRejectedByAuth');
    Route::get('auth/leave/withdrawn','Api\Mobile\AppController@leaveWithdrawnByAuth');
    Route::post('leave/apply','Api\Mobile\AppController@applyLeave');
    Route::get('leave/show/{id}','Api\Mobile\AppController@showLeave');
    Route::post('leave/approval/{id}','Api\Mobile\AppController@approvalLeave');
    Route::delete('leave/retract/{id}','Api\Mobile\AppController@retractLeave'); //delete
    Route::get('leave/edit/{id}','Api\Mobile\AppController@editLeave');
    Route::post('leave/update/{id}','Api\Mobile\AppController@updateLeave');
    Route::get('leave/showWithdrawn/{id}','Api\Mobile\AppController@showWithdrawn');
    Route::get('auth/leave/showWithdrawn/{id}','Api\Mobile\AppController@showWithdrawnAuth');
    
    Route::post('family/store','Api\Mobile\AppController@storeFamily');
    Route::get('family/show','Api\Mobile\AppController@showFamily');
    Route::get('family/edit/{id}','Api\Mobile\AppController@editFamily');
    Route::post('family/update/{id}','Api\Mobile\AppController@updateFamily');
    Route::delete('family/delete/{id}','Api\Mobile\AppController@deleteFamily');

    Route::post('academic/store','Api\Mobile\AppController@storeAcademic');
    Route::get('academic/show','Api\Mobile\AppController@showAcademic');
    Route::get('academic/edit/{id}','Api\Mobile\AppController@editAcademic');
    Route::post('academic/update/{id}','Api\Mobile\AppController@updateAcademic');
    Route::delete('academic/delete/{id}','Api\Mobile\AppController@deleteAcademic');

    Route::post('employment/store','Api\Mobile\AppController@storeEmployment');
    Route::get('employment/show','Api\Mobile\AppController@showEmployment');
    Route::get('employment/edit/{id}','Api\Mobile\AppController@editEmployment');
    Route::post('employment/update/{id}','Api\Mobile\AppController@updateEmployment');
    Route::delete('employment/delete/{id}','Api\Mobile\AppController@deleteEmployment');

    Route::post('skill/store','Api\Mobile\AppController@storeSkill');
    Route::get('skill/show','Api\Mobile\AppController@showSkill');
    Route::get('skill/edit/{id}','Api\Mobile\AppController@editSkill');
    Route::post('skill/update/{id}','Api\Mobile\AppController@updateSkill');
    Route::delete('skill/delete/{id}','Api\Mobile\AppController@deleteSkill');

    Route::post('award/store','Api\Mobile\AppController@storeAward');
    Route::get('award/show','Api\Mobile\AppController@showAward');
    Route::get('award/edit/{id}','Api\Mobile\AppController@editAward');
    Route::post('award/update/{id}','Api\Mobile\AppController@updateAward');
    Route::delete('award/delete/{id}','Api\Mobile\AppController@deleteAward');

    Route::get('leave/balance','Api\Mobile\AppController@leavetypebalance');
    Route::get('leave/prorated','Api\Mobile\AppController@leaveprorated');
});