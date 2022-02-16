<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth
Route::group([], function () {
    Route::post('login', 'ApiController@login');
    Route::post('signup', 'ApiController@signUp');
    
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/properties', 'ApiController@getProperties');
    });
});