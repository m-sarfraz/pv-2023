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

use App\Http\Controllers\HomeController;

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
    return redirect('login');
});
Auth::routes(['register' => false]);
// Route::get('pageNotFound', 'ErrorController@pageNotFound')->name('pageNotFound');

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
// Route::view('search', 'smartSearch.smart_search')->name('search');
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
    Route::get('view-jdl-table', 'JdlController@view_jdl_table')->name('view-jdl-table');
    Route::get('view-jdl-filter-table', 'JdlController@view_jdl_filter_table')->name('view-jdl-filter-table');
    Route::get('jdl_filter_records_detail', 'JdlController@Filter')->name('filterRecordJDLDetail');
    Route::get('filter_records_jdl', 'JdlController@Filter_user_table')->name('filter_records_jdl');
    Route::post('filter_records_jdl_getclient', 'JdlController@filter_records_jdl_getclient')->name('filter_records_jdl_getclient');
    Route::get('append_filter_data', 'JdlController@append_filter_data')->name('append_filter_data');

    //Search User data route
    Route::get('SearchUserData/{id}', 'CandidateController@SearchUserData')->name('searchUser');
    Route::get('QRCode/{id}', 'CandidateController@QRCodeGenerator')->name('QRCode');

    // Record routes
    Route::get('record', 'RecordController@index')->name('record');
    Route::get('filter_records', 'RecordController@filter')->name('filterRecord');
    Route::get('filter_records_detail', 'RecordController@UserDetails')->name('filterRecordDetail');
    Route::match(['get', 'post'], 'update_records_detail', 'RecordController@updateDetails')->name('updateRecordDetail');
    Route::get('view-record-table', 'RecordController@view_record_table')->name('view-record-table');
    Route::get('view-record-filter-table', 'RecordController@view_record_filter_table')->name('view-record-filter-table');

    Route::resource('role', 'RoleController')->name('*', 'role');
    Route::resource('user', 'UserController')->name('*', 'user');
    Route::match(['get', 'post'], 'update_password', 'UserController@updatePassword')->name('updatePassword');

    // Route::resource('team', 'TeamController')->name('*', 'team');
    //
    // data entry route

    Route::post('save_permission', 'CandidateController@abc')->name('save_permission');
    Route::get('data-entry', 'CandidateController@data_entry')->name('data-entry');
    Route::post('traveseDataByClientProfile', 'CandidateController@traveseDataByClientProfile')->name('traveseDataByClientProfile');
    Route::match(['get', 'post'], 'save-data-entry', 'CandidateController@save_data_entry')->name('save-data-entry');
    Route::match(['get', 'post'], 'update-data-entry/{id}', 'CandidateController@update_data_entry');
    Route::match(['get', 'post'], 'download_cv', 'CandidateController@downloadCv');

    // log routes
    Route::get('log', 'LogController@index')->name('log');

    // Profile route
    Route::get('profile', 'ProfileController@view_profile')->name('profile');
    Route::post('connect-to-sheet', 'ProfileController@readsheet')->name('connect-to-sheet');
    Route::post('save-profile', 'ProfileController@save_profile')->name('save-profile');
    Route::post('save-excel', 'ProfileController@readLocalAcceess')->name('save-excel');
    Route::post('connect_to_jdl_sheet', 'ProfileController@connect_to_jdl_sheet')->name('connect_to_jdl_sheet');
    Route::post('uploadJdlSheet', 'ProfileController@uploadJdlSheet')->name('uploadJdlSheet');

    // finance route
    Route::get('finance', 'FinanceController@index')->name('finance');
    Route::get('finance_records_detail', 'FinanceController@recordDetail')->name('financeRecordDetail');
    Route::get('view-finance-search-table', 'FinanceController@view_finance_search_table')->name('view-finance-search-table');
    Route::match(['get', 'post'], 'filter_records_finance', 'FinanceController@recordFilter')->name('financeRecordFilter');
    Route::match(['get', 'post'], 'filterView', 'FinanceController@filterView')->name('filterView');
    Route::match(['get', 'post'], 'save_finance-reference', 'FinanceController@SavefinanceReference')->name('SavefinanceReference');

    // Smart search controllers
    Route::get('search', 'SmartSearchController@index')->name('search');
    Route::get('filter_search', 'SmartSearchController@filterSearch')->name('filterSearch');
    Route::get('view-smart-search-table', 'SmartSearchController@smartTOYajra')->name('view-smart-search-table');

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
Route::get('/test', 'HomeController@addtest')->name('addtest');
Route::get('/testsheet', 'HomeController@testsheet');
Route::post('/testsheet', 'HomeController@addtest_store')->name("addtest_store");
//filter-dashboard-by-date
Route::post("filter-dashboard-by-date", "HomeController@filterByDate");
