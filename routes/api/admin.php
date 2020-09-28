<?php

Route::apiResource('blogs', 'BlogApiController');


// Only Admin Access

Route::group(['middleware' => ['auth:admin_api']], function () {
    Route::get('users', 'UserApiController@index');
});
