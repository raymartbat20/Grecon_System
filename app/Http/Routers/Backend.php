<?php

 Route::namespace('Backend')->name('backend.')->group(function(){

    Route::namespace('Admin')->name('admin.')->prefix('admin')->middleware('auth','role:ADMIN')->group(function(){
        Route::get('/dashboard','DashboardController@index')->name('dashboard');

        //Users Controller
        Route::resource('users','UsersController')->except([
            'edit','show',
        ]);

        Route::resource('suppliers','SuppliersController')->except([
            'edit','show',
        ]);
    });
 });