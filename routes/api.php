<?php

use Illuminate\Http\Request;


Route::group(['middleware'=>['api']],function(){

    Route::get('users',['uses'=>'Api\UsersController@index','as' => 'api.users.index']);

});

