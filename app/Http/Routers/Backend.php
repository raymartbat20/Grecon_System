<?php

 Route::namespace('Backend')->name('backend.')->group(function(){

    Route::namespace('Admin')->names('admin.')->prefix('admin')->group(function(){
        Route::get('/dashboard','DashboardController@index')->name('dashboard');
    });
 });