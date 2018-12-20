<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(['prefix' => 'profile', 'middleware' => ['auth']], function () {

    Route::group(['prefix' => 'personal-details'], function () {
        Route::get('/', ['uses' => 'PersonalDetailsController@index', 'as' => 'personal.index']);
        Route::post('store', ['uses' => 'PersonalDetailsController@store', 'as' => 'personal.store']);

        // family
        Route::group(['prefix' => 'family'], function () {
            Route::get('/', ['uses' => 'FamiliesController@index', 'as' => 'family.index']);
            Route::post('store', ['uses' => 'FamiliesController@store', 'as' => 'family.store']);
        });

    // academic
        Route::group(['prefix' => 'academic'], function () {
            Route::get('/', ['uses' => 'AcademicsController@index', 'as' => 'academic.index']);
            Route::post('store', ['uses' => 'AcademicsController@store', 'as' => 'academic.store']);
        });
    
    // experience
        Route::group(['prefix' => 'employment-history'], function () {
            Route::get('/', ['uses' => 'ExperiencesController@index', 'as' => 'experience.index']);
            Route::post('store', ['uses' => 'ExperiencesController@store', 'as' => 'experience.store']);
        });

        Route::group(['prefix' => 'skills'], function () {
            Route::get('/', ['uses' => 'SkillsController@index', 'as' => 'skill.index']);
            Route::post('store', ['uses' => 'SkillsController@store', 'as' => 'skill.store']);
        });

        Route::group(['prefix' => 'awards'], function () {
            Route::get('/', ['uses' => 'AwardsController@index', 'as' => 'award.index']);
            Route::post('store', ['uses' => 'AwardsController@store', 'as' => 'award.store']);
        });
    });


    Route::group(['prefix' => 'security'], function () {
        Route::get('/', ['uses' => 'SecuritiesController@index', 'as' => 'security']);
        Route::post('/reset-password', ['uses' => 'SecuritiesController@resetPassword', 'as' => 'reset.password']);
    });

    Route::group(['prefix' => 'administration'], function () {
        Route::group(['prefix' => 'family-types'], function () {
            Route::get('/', ['uses' => 'FamilyTypesController@index', 'as' => 'family-type.index']);
            Route::post('store', ['uses' => 'FamilyTypesController@store', 'as' => 'family-type.store']);
            Route::post('{id}/update', ['uses' => 'FamilyTypesController@update', 'as' => 'family-type.update']);
            Route::get('{id}/edit', ['uses' => 'FamilyTypesController@edit', 'as' => 'family-type.edit']);
            Route::delete('{id}/delete', ['uses' => 'FamilyTypesController@destroy', 'as' => 'family-type.destroy']);
        });

        Route::group(['prefix' => 'positions'], function () {
            Route::get('/', ['uses' => 'PositionsController@index', 'as' => 'position.index']);
            Route::post('store', ['uses' => 'PositionsController@store', 'as' => 'position.store']);
            Route::post('{id}/update', ['uses' => 'PositionsController@update', 'as' => 'position.update']);
            Route::get('{id}/edit', ['uses' => 'PositionsController@edit', 'as' => 'position.edit']);
            Route::delete('{id}/delete', ['uses' => 'PositionsController@destroy', 'as' => 'position.destroy']);
        });

    });

});
