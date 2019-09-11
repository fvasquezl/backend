<?php

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::get('/user', 'AuthController@user');
Route::post('/logout', 'AuthController@logout');

Route::prefix('topics')
    ->middleware('auth:api')
    ->group(function(){
    Route::post('/', 'TopicController@store');
});

