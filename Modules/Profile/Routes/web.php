<?php


Route::group(['prefix' => 'in-profile-modules', 'middleware' => 'auth'], function () {

    Route::group(['prefix' => 'in-personal-details'], function () {
        Route::get('viewing-personal-details', ['uses' => 'PersonalDetailsController@index', 'as' => 'personal.index']);
        Route::post('storing-personal-details', ['uses' => 'PersonalDetailsController@store', 'as' => 'personal.store']);

        // family
        Route::group(['prefix' => 'in-family'], function () {
            Route::get('viewing-family-information', ['uses' => 'FamiliesController@index', 'as' => 'family.index']);
            Route::post('storing-family-information', ['uses' => 'FamiliesController@store', 'as' => 'family.store']);
            Route::get('editing-family-information/where-identity-is/{id}', ['uses' => 'FamiliesController@edit', 'as' => 'family.edit']);
            Route::post('{id}/update', ['uses' => 'FamiliesController@update', 'as' => 'family.update']);
            Route::delete('bulk-delete',['uses' => 'FamiliesController@destroy','as' =>'family.bulkdelete']);
        });

    // academic
        Route::group(['prefix' => 'in-academic-records'], function () {
            Route::get('viewing-academic-records', ['uses' => 'AcademicsController@index', 'as' => 'academic.index']);
            Route::post('storing-academic-records', ['uses' => 'AcademicsController@store', 'as' => 'academic.store']);
            Route::get('editing-academic-records/where-identity-is/{id}', ['uses' => 'AcademicsController@edit', 'as' => 'academic.edit']);
            Route::post('{id}/update', ['uses' => 'AcademicsController@update', 'as' => 'academic.update']);
            Route::delete('bulk-delete',['uses' => 'AcademicsController@destroy','as' =>'academic.bulkdelete']);
        });
    
    // experience
        Route::group(['prefix' => 'in-employment-history'], function () {
            Route::get('/', ['uses' => 'ExperiencesController@index', 'as' => 'experience.index']);
            Route::post('store', ['uses' => 'ExperiencesController@store', 'as' => 'experience.store']);
            Route::get('{id}/edit', ['uses' => 'ExperiencesController@edit', 'as' => 'experience.edit']);
            Route::post('{id}/update', ['uses' => 'ExperiencesController@update', 'as' => 'experience.update']);
        });

        Route::group(['prefix' => 'in-skills'], function () {
            Route::get('/', ['uses' => 'SkillsController@index', 'as' => 'skill.index']);
            Route::post('store', ['uses' => 'SkillsController@store', 'as' => 'skill.store']);
            Route::get('{id}/edit', ['uses' => 'SkillsController@edit', 'as' => 'skill.edit']);
            Route::post('{id}/update', ['uses' => 'SkillsController@update', 'as' => 'skill.update']);
            Route::delete('bulk-delete',['uses' => 'SkillsController@destroy','as' =>'skill.bulkdelete']);
        });

        Route::group(['prefix' => 'in-awards'], function () {
            Route::get('/', ['uses' => 'AwardsController@index', 'as' => 'award.index']);
            Route::post('store', ['uses' => 'AwardsController@store', 'as' => 'award.store']);
            Route::get('{id}/edit', ['uses' => 'AwardsController@edit', 'as' => 'award.edit']);
            Route::post('{id}/update', ['uses' => 'AwardsController@update', 'as' => 'award.update']);
            Route::delete('bulk-delete',['uses' => 'AwardsController@destroy','as' =>'award.bulkdelete']);
        });
    });


    Route::group(['prefix' => 'security'], function () {
        Route::get('/', ['uses' => 'SecuritiesController@index', 'as' => 'security']);
        Route::post('/reset-password', ['uses' => 'SecuritiesController@resetPassword', 'as' => 'reset.password']);
    });
});

Route::group(['prefix' => config('app.administration_prefix'), 'middleware' => ['auth','role:Admin']], function () {

    Route::group(['prefix' => 'family-types'], function () {
        Route::get('/', ['uses' => 'FamilyTypesController@index', 'as' => 'family-type.index']);
        Route::post('store', ['uses' => 'FamilyTypesController@store', 'as' => 'family-type.store']);
        Route::post('{id}/update', ['uses' => 'FamilyTypesController@update', 'as' => 'family-type.update']);
        Route::get('{id}/edit', ['uses' => 'FamilyTypesController@edit', 'as' => 'family-type.edit']);
        Route::delete('{id}/delete', ['uses' => 'FamilyTypesController@destroy', 'as' => 'family-type.destroy']);
    });

    Route::group(['prefix' => 'employees/positions'], function () {
        Route::get('/', ['uses' => 'PositionsController@index', 'as' => 'position.index']);
        Route::post('store', ['uses' => 'PositionsController@store', 'as' => 'position.store']);
        Route::post('{id}/update', ['uses' => 'PositionsController@update', 'as' => 'position.update']);
        Route::get('{id}/edit', ['uses' => 'PositionsController@edit', 'as' => 'position.edit']);
        Route::delete('{id}/delete', ['uses' => 'PositionsController@destroy', 'as' => 'position.destroy']);
    });

    Route::group(['prefix' => 'employee-detail'], function () {
        Route::get('/{id}', ['uses' => 'PersonalDetailsController@viewEmployeeDetails', 'as' => 'employee.details'])->middleware('signed');
    });

    Route::group(['prefix' => 'resume'], function () {
        Route::get('{id}', ['uses' => 'PersonalDetailsController@viewResume', 'as' => 'employee.resume']);
    });
});

