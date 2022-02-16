<?php

use Illuminate\Support\Facades\Route;

// Home
Route::get('/', 'Properties@index')->name('home');

// Property Detail
Route::get('/property/{name}', 'Properties@property');

// Ajax request
Route::get('/properties', 'ApiController@getProperties');