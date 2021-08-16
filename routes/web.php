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

Route::get('/', function () {
    return redirect()->route('login');
});
Auth::routes(['register' => false]);

Route::view('editProfile','profile.editProfile');
Route::view('addUser','profile.addUser');
Route::view('team','profile.team');
Route::view('userList','profile.userList');

Route::group(['prefix' =>'admin','namespace' => 'Admin'],function(){
    Route::get('/profile', 'ProfileController@view_profile')->name('profile');
});

Route::get('/home', 'HomeController@index')->name('home');
