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

//Route::view('dataEntry','data_entry.main')->name('dataEntry');
// Route::view('jdl', 'JDL.index')->name('jdl');

//Route::view('dropdown','dropdown.add_dropdown')->name('dropdown');

// Route::view('record', 'record.view_record')->name('record');
// Route::view('finance', 'finance.finance')->name('finance');
// Route::view('log', 'logs.log')->name('log');
Route::view('search', 'smartSearch.smart_search')->name('search');
// Route::view('company','companies.company_profile');
// Route::view('add_company','companies.add_company_profile');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {

    // companies routes
    Route::get('companies', 'CompanyController@show')->name('companies');
    Route::match(['get', 'post'], 'add-company', 'CompanyController@add_company')->name('add_company');
    Route::match(['get', 'post'], 'company-detail/{id}', 'CompanyController@view_company')->name('view_company');
    Route::post('update_company/{id}', 'CompanyController@update_company')->name('update_company');
    //JDL Routes
    Route::get('jdl', 'JdlController@index')->name("jdl");
    Route::get('jdl_filter_records_detail', 'JdlController@Filter')->name('filterRecordJDLDetail');
    Route::get('filter_records_jdl', 'JdlController@Filter_user_table')->name('filter_records_jdl');
    
    //Search User data route
    Route::get('SearchUserData/{id}', 'CandidateController@SearchUserData')->name('searchUser');

    // Record routes
    Route::get('record', 'RecordController@index')->name('record');
    Route::get('filter_records', 'RecordController@filter')->name('filterRecord');
    Route::get('filter_records_detail', 'RecordController@UserDetails')->name('filterRecordDetail');
    Route::match(['get', 'post'], 'update_records_detail', 'RecordController@updateDetails')->name('updateRecordDetail');

    Route::resource('role', 'RoleController')->name('*', 'role');
    Route::resource('user', 'UserController')->name('*', 'user');
    Route::resource('team', 'TeamController')->name('*', 'team');

    // data entry route
    Route::get('data-entry', 'CandidateController@data_entry')->name('data-entry');
    Route::match(['get', 'post'], 'save-data-entry', 'CandidateController@save_data_entry')->name('save-data-entry');
    Route::match(['get', 'post'], 'update-data-entry/{id}', 'CandidateController@update_data_entry');
    Route::match(['get', 'post'], 'download_cv', 'CandidateController@downloadCv');

    // log routes
    Route::get('log', 'logController@index')->name('log');

    // Profile route
    Route::get('profile', 'ProfileController@view_profile')->name('profile');
    Route::post('connect-to-sheet', 'ProfileController@readsheet')->name('connect-to-sheet');
    Route::post('save-profile', 'ProfileController@save_profile')->name('save-profile');
    Route::post('save-excel', 'ProfileController@readLocalAcceess')->name('save-excel');

    // finance route
    Route::get('finance', 'financeController@index')->name('finance');
    Route::get('finance_records_detail', 'financeController@recordDetail')->name('financeRecordDetail');
    Route::match(['get', 'post'], 'filter_records_finance', 'financeController@recordFilter')->name('financeRecordFilter');

    // dropdown routes
    Route::get('dropdown', 'DropDownController@view_dropdown')->name('dropdown');
    Route::get('add-dropdown', 'DropDownController@show_dropdown_form')->name('add-dropdown');
    Route::post('save-dropdown', 'DropDownController@save_dropdown')->name('save-dropdown');
    Route::get('view-dropdown', 'DropDownController@ajax_view_dropdown')->name('view-dropdown');
    Route::post('save-options', 'DropDownController@save_options')->name('save-options');
    Route::post('view-options', 'DropDownController@view_options')->name('view-options');
    Route::post('delete-option', 'DropDownController@delete_option')->name('delete-option');
    Route::post('change-option-status', 'DropDownController@change_status')->name('change-option-status');

    // domain/segmnet routes
    Route::get('domain', 'DomainController@domain')->name('domain');
    Route::post('add-domains', 'DomainController@add_domains')->name('add-domains');
    Route::post('add-segments', 'DomainController@add_segments')->name('add-segments');
    Route::get('view-sub-segments', 'DomainController@view_sub_segments')->name('view-sub-segments');
    Route::post('add-sub-segments', 'DomainController@add_sub_segments')->name('add-sub-segments');
    Route::post('delete-sub-segment', 'DomainController@delete_sub_segment')->name('delete-sub-segment');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/testsheet', 'HomeController@testsheet');
