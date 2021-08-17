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

/* =================== */
/* Route for clear cache */
Route::get('/clear-all', function () {
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:cache');
    Artisan::call('view:clear');
    $homeURL = url('/');
    return 'Views Cleared, Routes Cleared, Cache Cleared, and Config Cleared Successfully ! <a href="' . $homeURL . '">Go Back To Home</a>';
});
/* Route for clear cache */
/* ===================*/


Route::get('/', function () {
    return redirect()->route('login');
});
Auth::routes(['register' => false]);

Route::view('editProfile','profile.editProfile');
Route::view('team','profile.team');
Route::view('addUser','user.addUser');
Route::view('userList','user.userList');
Route::view('dataEntry','dataEntry.main');
Route::view('jdl','JDL.index');


Route::group(['prefix' =>'admin','namespace' => 'Admin'],function(){
    Route::get('/profile', 'ProfileController@view_profile')->name('profile');
});

Route::get('/home', 'HomeController@index')->name('home');
