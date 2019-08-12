<?php

 Route::namespace('Backend')->name('backend.')->group(function(){

    Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function(){
        Route::get('/dashboard','DashboardController@index')->name('dashboard');

        //Users Controller
        Route::resource('users','UsersController');
    });
 });