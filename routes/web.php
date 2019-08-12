<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

<<<<<<< HEAD
Route::get('/', function () {
    return view('backend.admin.dashboard.dashboard');
});
=======
// Route::get('/', function () {
//     return view('backend.admin.dashboard.dashboard');
// });

include_once app_path('Http\Routers\Backend.php');
include_once app_path('Http\Routers\Root.php');
>>>>>>> 2ce7d968c0d71d605fc807dcc8275f0bafeec62b
