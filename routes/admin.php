<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::resource('posts', 'PostController');
Route::resource('categories', 'CategoryController');
Route::resource('users', 'UserController');

