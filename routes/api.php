<?php

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::get('/user', 'AuthController@user');
Route::post('/logout', 'AuthController@logout');

Route::prefix('topics')
    ->group(function(){
    Route::post('/', 'TopicsController@store')->middleware('auth:api');
    Route::get('/', 'TopicsController@index');
    Route::get('/{topic}', 'TopicsController@show');
    Route::patch('/{topic}', 'TopicsController@update')->middleware('auth:api');
    Route::delete('/{topic}', 'TopicsController@destroy')->middleware('auth:api');
});

