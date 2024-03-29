<?php

 Route::namespace('Backend')->name('backend.')->group(function(){

    //Admin Controller
    Route::namespace('Admin')->name('admin.')->prefix('admin')->middleware('auth','role:1')->group(function(){
        Route::get('/dashboard','DashboardController@index')->name('dashboard');

        //profile Controller
        Route::name('profile.')->group(function(){
            Route::get('/profile','ProfileController@index')->name('index');
            Route::patch('/profile/update','ProfileController@update')->name('update');
        });

        //Password Controller
        Route::name('password.')->group(function(){
            Route::get('/change_password','PasswordController@index')->name('index');
            Route::patch('/change_password/reset','PasswordController@update')->name('update');
            Route::get('/change_password/forgot','PasswordController@showForgot')->name('showForgot');
            Route::patch('/change_password/forgot','PasswordController@forgot')->name('forgot');
        });

        //Users Controller
        Route::resource('users','UsersController')->except([
            'edit','show',
        ]);
        
        //Suppliers Controller
        Route::get('/suppliers/archive','SuppliersController@archive')->name('suppliers.archive');
        Route::post('/suppliers/restore','SuppliersController@restore')->name('suppliers.restore');
        Route::resource('suppliers','SuppliersController')->except([
            'edit','show',
        ]);

        //Category Controller
        Route::get('category/archives','CategoriesController@archives')->name('category.archives');
        Route::post('category/restore','CategoriesController@restore')->name('category.restore');
        Route::resource('category','CategoriesController');

        //Products Controller
        Route::get('/products/archive', 'ProductsController@archiveProducts')->name('products.archiveProducts');
        Route::post('/products/restore', 'ProductsController@restoreProduct')->name('products.restoreProduct');
        Route::get('/products/{product}/log','ProductsController@productLog')->name('products.log');
        Route::get('/products/requirements', 'ProductsController@requirements')->name('products.requirementsView');
        Route::post('/products/requirements', 'ProductsController@requirementsStore')->name('products.requirementsStore');
        Route::get('/products/stocks', 'ProductsController@index')->name('products.index');
        Route::match(['put','patch'],'/products/addStocks','ProductsController@addStocks')->name('products.addStocks');
        Route::match(['put','patch'],'/products/removeDefectives','ProductsController@removeDefectives')->name('products.removeDefectives');
        Route::resource('products','ProductsController');

        //Cart Controller
        Route::name('ordercart.')->prefix('cart')->group(function(){
            Route::get('/addToCart', 'OrderCartController@addToCart')->name('addToCart');
            Route::get('/cart_items','OrderCartController@index')->name('index');
            Route::get('/reduce_qty', 'OrderCartController@reduceQty')->name('reduceqty');
            Route::get('/check_out', 'OrderCartController@checkout')->name('checkout');
            Route::get('/remove_item', 'OrderCartController@removeItem')->name('removeitem');
            Route::post('/check_out', 'OrderCartController@store')->name('cartstore');
        });

        //Create Product Controller
        Route::name('createproduct.')->prefix('product/new-product')->group(function(){
            Route::get('', 'CreateProductController@index')->name('index');
            Route::get('/addMaterial', 'CreateProductController@addMaterial')->name('addMaterial');
            Route::get('/materials', 'CreateProductController@materials')->name('materials');
            Route::get('/reduceMaterial', 'CreateProductController@reduceMaterial')->name('reduceMaterial');
            Route::get('/removeMaterial', 'CreateProductController@removeMaterial')->name('removeMaterial');
            Route::get('/registerproduct', 'CreateProductController@registerProduct')->name('registerProduct');
            Route::post('/registerproduct', 'CreateProductController@store')->name('store');
        });
        
        //Transaction Controller
        Route::get('/transaction/records', 'TransactionsController@records')->name('transaction.records');
        Route::get('/transaction/{id}/printInvoice', 'TransactionsController@printInvoice')->name('transaction.printInvoice');
        Route::get('/transaction/new-transaction' , 'TransactionsController@index');
        Route::resource('transaction','TransactionsController');

        //Reports Controller
        Route::get('/reports/top_selling', 'ReportsController@topSelling')->name('reports.topSelling');
        Route::get('/reports/critical_products', 'ReportsController@critical')->name('reports.critical');
        Route::get('/reports/print_top_Selling', 'ReportsController@printTopSelling')->name('reports.printTopSelling');
        Route::get('/reports/print_critical_products','ReportsController@printCritical')->name('reports.printCriticalProducts');

        //Notification Controller
        Route::get('/notification/allRead', 'NotificationController@markAllRead')->name('notification.markAllRead');
        Route::get('/notification/{id}', 'NotificationController@markAsRead')->name('notification.mark');
    });


    //Cashier Controller
    Route::namespace('Cashier')->name('cashier.')->prefix('cashier')->middleware('auth','role:2')->group(function(){

        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        //profile Controller
        Route::name('profile.')->group(function(){
            Route::get('/profile','ProfileController@index')->name('index');
            Route::patch('/profile/update','ProfileController@update')->name('update');
        });

        //Password Controller
        Route::name('password.')->group(function(){
            Route::get('/change_password','PasswordController@index')->name('index');
            Route::patch('/change_password/reset','PasswordController@update')->name('update');
        });

        //Product Controller
        Route::get('/products', 'ProductsController@index')->name('products.index');

        //Cart Controller
        Route::name('ordercart.')->prefix('cart')->group(function(){
            Route::get('/addToCart', 'OrderCartController@addToCart')->name('addToCart');
            Route::get('/cart_items','OrderCartController@index')->name('index');
            Route::get('/reduce_qty', 'OrderCartController@reduceQty')->name('reduceqty');
            Route::get('/check_out', 'OrderCartController@checkout')->name('checkout');
            Route::get('/remove_item', 'OrderCartController@removeItem')->name('removeitem');
            Route::post('/check_out', 'OrderCartController@store')->name('cartstore');
        });

        //Transaction Controller
        Route::get('/transaction/records', 'TransactionsController@records')->name('transaction.records');
        Route::get('/transaction/{id}/printInvoice', 'TransactionsController@printInvoice')->name('transaction.printInvoice');
        Route::resource('transaction','TransactionsController');
    });


    //Inventory Controller
    Route::namespace('Inventory')->name('inventory.')->prefix('inventory_clerk')->middleware('auth','role:3')->group(function(){

        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        //profile Controller
        Route::name('profile.')->group(function(){
            Route::get('/profile','ProfileController@index')->name('index');
            Route::patch('/profile/update','ProfileController@update')->name('update');
        });

        //Password Controller
        Route::name('password.')->group(function(){
            Route::get('/change_password','PasswordController@index')->name('index');
            Route::patch('/change_password/reset','PasswordController@update')->name('update');
        });

        //Suppliers Controller
        Route::resource('suppliers','SuppliersController')->except([
            'edit','show',
        ]);

        //Category Controller
        Route::resource('category','CategoriesController');

        //Products Controller
        Route::get('/products/archive', 'ProductsController@archiveProducts')->name('products.archiveProducts');
        Route::post('/products/restore', 'ProductsController@restoreProduct')->name('products.restoreProduct');
        Route::get('/products/{product}/log','ProductsController@productLog')->name('products.log');
        Route::get('/products/requirements', 'ProductsController@requirements')->name('products.requirementsView');
        Route::post('/products/requirements', 'ProductsController@requirementsStore')->name('products.requirementsStore');
        Route::match(['put','patch'],'/products/addStocks','ProductsController@addStocks')->name('products.addStocks');
        Route::match(['put','patch'],'/products/removeDefectives','ProductsController@removeDefectives')->name('products.removeDefectives');
        Route::resource('products','ProductsController');

        //Create Product Controller
        Route::name('createproduct.')->prefix('createProduct')->group(function(){
            Route::get('', 'CreateProductController@index')->name('index');
            Route::get('/addMaterial', 'CreateProductController@addMaterial')->name('addMaterial');
            Route::get('/materials', 'CreateProductController@materials')->name('materials');
            Route::get('/reduceMaterial', 'CreateProductController@reduceMaterial')->name('reduceMaterial');
            Route::get('/removeMaterial', 'CreateProductController@removeMaterial')->name('removeMaterial');
            Route::get('/registerProduct', 'CreateProductController@registerProduct')->name('registerProduct');
            Route::post('/registerProduct', 'CreateProductController@store')->name('store');
        });

        //Notification Controller
        Route::get('/notification/allRead', 'NotificationController@markAllRead')->name('notification.markAllRead');
        Route::get('/notification/{id}', 'NotificationController@markAsRead')->name('notification.mark');
        
        //Reports Controller
        Route::get('/reports/critical_products', 'ReportsController@critical')->name('reports.critical');
        Route::get('/reports/print_critical_products','ReportsController@printCritical')->name('reports.printCriticalProducts');
    });
    
 });