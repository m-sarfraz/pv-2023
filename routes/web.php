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

/*Route::get('dataEntry', function () {
    return view('dataEntry.main');
});
Route::get('jdl', function () {
    return view('JDL.index');
});*/

Route::view('dataEntry','dataEntry.main');
Route::view('jdl','JDL.index');
Route::view('dropdown','dropdowns.add_dropdowns');
Route::view('domain','domains.add_domain');
Route::view('record','record.view_record');
Route::view('finance','finance.finance');


Route::group(['prefix' =>'admin','namespace' => 'Admin','middleware' => 'auth'],function(){

    Route::resource('role','RoleController')->name('*','role');
    Route::resource('user','UserController')->name('*','user');
    Route::resource('team', 'TeamController')->name('*','team');

    Route::get('profile', 'ProfileController@view_profile')->name('profile');
    Route::post('save-profile', 'ProfileController@save_profile')->name('save-profile');
    Route::get('dropdown', 'DropDownController@view_dropdown')->name('dropdown');

});

Route::get('/home', 'HomeController@index')->name('home');
