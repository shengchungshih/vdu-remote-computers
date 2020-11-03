<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomepageController@getHomepage')->middleware(['auth', 'locale'])->name('getHomepage');


Route::middleware(['auth', 'locale'])->group(function(){
    Route::get('/room/{room}', 'HomepageController@getComputerList')->name('getComputerList');

    Route::get('reserve_computer/{computer}', 'HomepageController@reserveComputer')->name('reserveComputer');

    Route::post('cancel_reservation/{computer}', 'HomepageController@cancelComputerReservation')->name('cancelReservation');

    Route::get('set_language/{lang}', 'HomepageController@setLanguage')->name('setLanguage');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('logout', 'Auth\LoginController@logout');

