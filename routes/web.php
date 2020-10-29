<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomepageController@getHomepage')->middleware('auth')->name('getHomepage');


Route::middleware('auth')->group(function(){
    Route::get('/room/{room}', 'HomepageController@getComputerList')->name('getComputerList');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('logout', 'Auth\LoginController@logout');

