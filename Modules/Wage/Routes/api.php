<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'claims'], function () {

    Route::get('details/{claimId}', 'Api\ClaimDetailsController@index')->name('api.claimdetails.index');
    Route::post('details/update', 'Api\ClaimDetailsController@update')->name('api.claimdetails.update');
    Route::post('{claimId}/total', 'Api\ClaimDetailsController@calculateClaimTotal')->name('api.claim.total');

});
