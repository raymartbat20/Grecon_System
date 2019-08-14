<?php

 Route::namespace('Backend')->name('backend.')->group(function(){

    Route::namespace('Admin')->name('admin.')->prefix('admin')->middleware('auth','role:ADMIN')->group(function(){
        Route::get('/dashboard','DashboardController@index')->name('dashboard');

        //Password Controller
        Route::name('password.')->group(function(){
            Route::get('/change_password','PasswordController@index')->name('index');
            Route::patch('/change_password/reset','PasswordController@update')->name('update');
        });

        //Users Controller
        Route::resource('users','UsersController')->except([
            'edit','show',
        ]);
        
        //Suppliers Controller
        Route::resource('suppliers','SuppliersController')->except([
            'edit','show',
        ]);
    });
 });