<?php

Route::get('/', 'WelcomeController@index');

Route::get('dashboard', [
    'as' => 'dashboard',
    'uses' => 'DashboardController@index',
]);

Route::group([
    'prefix' => 'auth',
], function ()
{
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');
});

Route::get('oauth/{service}', [
    'as' => 'oauth',
    'uses' => 'Auth\OAuthController@callback'
]);

Route::get('oauth/{service}/trigger', [
    'as' => 'oauth.trigger',
    'uses' => 'Auth\OAuthController@trigger',
]);

Route::resource('goals', 'GoalsController', [
    'only' => ['index', 'update'],
]);

Route::group([
    'prefix' => 'log'
], function ()
{
    Route::get('exercise/{sport}/create', [
        'as' => 'log.exercise.create',
        'uses' => 'Log\LogExerciseController@create',
    ]);

    Route::post('exercise/{sport}', [
        'as' => 'log.exercise.store',
        'uses' => 'Log\LogExerciseController@store',
    ]);

    Route::resource('weight', 'Log\LogWeightController', [
        'only' => ['create', 'store'],
    ]);

    Route::get('achievement/{label}/create', [
        'as' => 'log.achievement.create',
        'uses' => 'Log\LogAchievementController@create',
    ]);

    Route::post('achievement/{label}', [
        'as' => 'log.achievement.store',
        'uses' => 'Log\LogAchievementController@store',
    ]);

    Route::resource('albums', 'Log\LogAlbumsController', [
        'only' => ['create', 'store'],
    ]);

    Route::get('ranged-achievement/{label}/create', [
        'as' => 'log.rangedachievement.create',
        'uses' => 'Log\LogRangedAchievementController@create',
    ]);

    Route::post('ranged-achievement/{label}', [
        'as' => 'log.rangedachievement.store',
        'uses' => 'Log\LogRangedAchievementController@store',
    ]);

    Route::resource('words', 'Log\LogWordsController', [
        'only' => ['create', 'store'],
    ]);
});

Route::get('records', [
    'as' => 'records',
    'uses' => 'DashboardController@records',
]);

Route::group([
    'prefix' => 'records'
], function ()
{
    Route::get('exercise/{sport}', [
        'as' => 'records.exercise',
        'uses' => 'Records\ExerciseController@index',
    ]);
});
