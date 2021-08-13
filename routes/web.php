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
Route::view('editProfile','profile.editProfile');
Route::view('addUser','profile.addUser');
Auth::routes(['register' => false]);

//Route::get('/home', 'HomeController@index')->name('home');
