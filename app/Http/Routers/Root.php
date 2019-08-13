<?php

    Route::namespace('Auth')->name('auth.')->group(function(){
        Route::get('/','SessionController@showSignIn')->middleware('guest')->name('showSignIn');
        Route::post('/','SessionController@signIn')->name('signIn');

        Route::get('/logout','SessionController@logout')->middleware('auth')->name('signOut');
    });