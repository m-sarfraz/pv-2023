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

Route::get('admin/redirect/{cid}/{uid}', 'Admin\UserController@redirectThankyou')->name('redirect');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('candidate_detail/{id}/{endoID}', 'CandidateController@QRCodeDetail')->name('QRCodeDetail');
});
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {

    //Search User data route
    Route::get('SearchUserData', 'CandidateController@SearchUserData')->name('searchUser');
    Route::get('QRCode/{id}', 'CandidateController@QRCodeGenerator')->name('QRCode');
    // Route::get('redirectQrCode/{cid}/{uid}', 'UserController@redirectQrCode')->name('redirectQrCode');
    Route::get('checkIfQRScanned', 'UserController@checkIfQRScanned')->name('checkIfQRScanned');

    Route::get('save_user_CurrTimeStamp', 'UserController@saveActivity')->name('save_user_CurrTimeStamp');

    // companies routes
    Route::get('companies', 'CompanyController@show')->name('companies');
    Route::match (['get', 'post'], 'add-company', 'CompanyController@add_company')->name('add_company');
    Route::match (['get', 'post'], 'company-detail/{id}', 'CompanyController@view_company')->name('view_company');
    Route::post('update_company/{id}', 'CompanyController@update_company')->name('update_company');
    //JDL Routes
    Route::get('jdl', 'JdlController@index')->name("jdl");
    Route::match (['get', 'post'], 'add-jdl', 'JdlController@addJDLEntry')->name("add-jdl");

    Route::get('view-jdl-table', 'JdlController@view_jdl_table')->name('view-jdl-table');
    Route::get('view-jdl-filter-table', 'JdlController@view_jdl_filter_table')->name('view-jdl-filter-table');
    Route::get('jdl_filter_records_detail/{id}', 'JdlController@Filter')->name('filterRecordJDLDetail');
    Route::post('update-jdl', 'JdlController@updateJDL')->name('update-jdl');
    Route::post('delete-jdl', 'JdlController@deleteJDL')->name('delete-jdl');
    Route::post('jdl-bulk-update', 'JdlController@bulkUpdateRecords')->name('jdl-bulk-update');
    Route::get('filter_records_jdl', 'JdlController@Filter_user_table')->name('filter_records_jdl');
    Route::post('filter_records_jdl_getclient', 'JdlController@filter_records_jdl_getclient')->name('filter_records_jdl_getclient');
    Route::get('append_filter_data', 'JdlController@append_filter_data')->name('append_filter_data');
    Route::get('appendJdlOptions', 'JdlController@appendJdlOptions')->name('appendJdlOptions');
    Route::post('get-positionTtitle-data', 'JdlController@getDataAgainstPTitle')->name('get-positionTtitle-data');
    // Record routes
    Route::get('record', 'RecordController@index')->name('record');
    Route::get('filter_records', 'RecordController@filter')->name('filterRecord');
    Route::get('filter_records_detail', 'RecordController@UserDetails')->name('filterRecordDetail');
    Route::match (['get', 'post'], 'update_records_detail', 'RecordController@updateDetails')->name('updateRecordDetail');
    Route::match (['get', 'post'], 'deleteCandidateData', 'RecordController@deleteCandidateData')->name('deleteCandidateData');
    Route::get('view-record-table', 'RecordController@view_record_table')->name('view-record-table');
    Route::post('view-record-filter-table', 'RecordController@view_record_filter_table')->name('view-record-filter-table');
    Route::get('appendFilterOptions', 'RecordController@appendFilterOptions')->name('appendFilterOptions');
    Route::get('showCandidateDropDown', 'RecordController@showCandidate_nameDrpDown')->name('showCandidate_nameDrpDown');

    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    Route::post('change-user-status', 'UserController@changeStatus')->name('change-user-status');
    Route::match (['get', 'post'], 'update_password', 'UserController@updatePassword')->name('updatePassword');

    // Route::resource('team', 'TeamController')->name('*', 'team');
    //
    // data entry route
    Route::get('get_remarksForFinance_options', 'CandidateController@get_remarksForFinance_options')->name('get_remarksForFinance_options');
    Route::post('save_permission', 'CandidateController@abc')->name('save_permission');
    Route::get('data-entry', 'CandidateController@data_entry')->name('data-entry');
    Route::get('Get_Position_title', 'CandidateController@Get_Position_title')->name('Get_Position_title');
    Route::get('get_candidateList', 'CandidateController@get_candidateList')->name('get_candidateList');
    Route::post('traveseDataByClientProfile', 'CandidateController@traveseDataByClientProfile')->name('traveseDataByClientProfile');
    Route::match (['get', 'post'], 'save-data-entry', 'CandidateController@save_data_entry')->name('save-data-entry');
    Route::match (['get', 'post'], 'update-data-entry/{id}', 'CandidateController@update_data_entry');
    Route::match (['get', 'post'], 'download_cv', 'CandidateController@downloadCv');

    // multiple endorsements view routes
    Route::post('endorsements_detail_view', 'CandidateController@endorsementDetailView')->name('endorsements_detail_view');

    // log routes
    Route::get('log', 'LogController@index')->name('log');

    // Profile route
    Route::get('profile', 'ProfileController@view_profile')->name('profile');
    // Route::get('testtest', 'ProfileController@test')->name('testest');
    Route::post('connect-to-sheet', 'ProfileController@readsheet')->name('connect-to-sheet');
    Route::post('save-profile', 'ProfileController@save_profile')->name('save-profile');
    Route::post('save-excel', 'ProfileController@readLocalAcceess')->name('save-excel');
    Route::post('connect_to_jdl_sheet', 'ProfileController@connect_to_jdl_sheet')->name('connect_to_jdl_sheet');
    Route::post('uploadJdlSheet', 'ProfileController@uploadJdlSheet')->name('uploadJdlSheet');
    // Route::post('uploadJdlSheet', 'ProfileController@uploadDropDownSheet')->name('uploadJdlSheet');

    // finance route
    Route::get('finance', 'FinanceController@index')->name('finance');
    Route::get('finance_records_detail', 'FinanceController@recordDetail')->name('financeRecordDetail');
    Route::get('view-finance-search-table', 'FinanceController@view_finance_search_table')->name('view-finance-search-table');
    Route::match (['get', 'post'], 'filter_records_finance', 'FinanceController@recordFilter')->name('financeRecordFilter');
    Route::match (['get', 'post'], 'filterView', 'FinanceController@filterView')->name('filterView');
    Route::match (['get', 'post'], 'save_finance-reference', 'FinanceController@SavefinanceReference')->name('SavefinanceReference');
    Route::get('summaryAppend_finance', 'FinanceController@summaryAppend')->name('summaryAppend_finance');
    Route::get('appendFinanceOptions', 'FinanceController@appendFinanceOptions')->name('appendFinanceOptions');
    Route::any('financeserachforsummary', 'FinanceController@FinanceSearchForSummary')->name('financeserachforsummary');
    Route::get('/finance-details/{id}', 'FinanceController@financeDetails')->name('details.finance');

    // Smart search controllers summaryAppend
    Route::get('search', 'SmartSearchController@index')->name('search');
    Route::get('/details/{id}', 'SmartSearchController@candidateDetails')->name('details.candidate');
    Route::get('filter_search', 'SmartSearchController@filterSearch')->name('filterSearch');
    Route::post('summaryAppend', 'SmartSearchController@summaryAppend')->name('summaryAppend');
    Route::get('view-smart-search-table', 'SmartSearchController@smartTOYajra')->name('view-smart-search-table');
    Route::get('appendSmartFilters', 'SmartSearchController@appendSmartFilters')->name('appendSmartFilters');
    Route::post('searchsummary', 'SmartSearchController@searchsummary')->name('searchsummary');

    // SDB Data extract routes
    Route::get('sdb-extract-data', 'DataExtractController@index')->name('sdb-extract-data');
    Route::get('append-extract-option', 'DataExtractController@appendFilterOptions')->name('append-extract-option');
    Route::get('extract-search-filter', 'DataExtractController@extractData')->name('extract-search-filter');
    Route::get('get-report-history', 'DataExtractController@getReportHistory')->name('get-report-history');
    Route::get('download-report', 'DataExtractController@downloadReport')->name('download-report');

    // jdl Data extract routes
    Route::get('jdl-extract-data', 'DataExtractController@jdl')->name('jdl-extract-data');
    Route::get('appendJdlOptionsDataExtract', 'DataExtractController@appendJdlOptionsDataExtract')->name('appendJdlOptionsDataExtract');
    Route::post('extract-search-filter-jdl', 'DataExtractController@extractDataJDL')->name('extract-search-filter-jdl');
    Route::get('get-report-history-jdl', 'DataExtractController@getReportHistoryJDL')->name('get-report-history-jdl');

    // dropdown routes
    Route::get('dropdown', 'DropDownController@view_dropdown')->name('dropdown');
    Route::get('add-dropdown', 'DropDownController@show_dropdown_form')->name('add-dropdown');

    Route::post('save-dropdown', 'DropDownController@save_dropdown')->name('save-dropdown');
    Route::get('view-dropdown', 'DropDownController@ajax_view_dropdown')->name('view-dropdown');
    Route::post('save-options', 'DropDownController@save_options')->name('save-options');
    Route::match (['get', 'post'], 'view-options', 'DropDownController@view_options')->name('view-options');
    Route::post('delete-option', 'DropDownController@delete_option')->name('delete-option');
    Route::post('update-option', 'DropDownController@update_option')->name('update-option');
    Route::post('change-option-status', 'DropDownController@change_status')->name('change-option-status');

    // domain/segmnet routes
    Route::get('domain', 'DomainController@domain')->name('domain');
    Route::post('add-domains', 'DomainController@add_domains')->name('add-domains');
    Route::get('append-filters', 'DomainController@appendFilters')->name('append-filters-domain');
    Route::post('add-segments', 'DomainController@add_segments')->name('add-segments');
    Route::get('view-sub-segments', 'DomainController@view_sub_segments')->name('view-sub-segments');
    Route::post('add-sub-segments', 'DomainController@add_sub_segments')->name('add-sub-segments');
    Route::post('add-profile', 'DomainController@add_profile')->name('add-profiles');
    Route::post('delete-option-domain', 'DomainController@deleteOption')->name('delete-option-domain');
    Route::post('delete-sub-segment', 'DomainController@delete_sub_segment')->name('delete-sub-segment');
    Route::post('add-position-title', 'DomainController@addPositionTitle')->name('add-position-title');
    // client dropdown management routes
    Route::match (['get', 'post'], 'load-client-table', 'DomainController@view_client_table')->name('load-client-table');
    Route::post('delete-client-spiel', 'DomainController@deleteClientSpiel')->name('delete-client-spiel');
    Route::post('edit-client-spiel', 'DomainController@editClientSpiel')->name('edit-client-spiel');
    Route::post('add-client-spiel', 'DomainController@saveClientSpiel')->name('add-client-spiel');
    Route::post('add-client', 'DomainController@add_client')->name('add-client');
    Route::post('add-classification', 'DomainController@add_classification')->name('add-classification');

    // testing link fro entring or testing data
    Route::get('testinglink', 'DomainController@testinglink')->name('testinglink');
});
Route::get('uploadSegments', 'HomeController@uploadSegments')->name('uploadSegments');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@addtest')->name('addtest');
Route::get('/testsheet', 'HomeController@testsheet');
Route::post('/testsheet', 'HomeController@addtest_store')->name("addtest_store");
//filter-dashboard-by-date
Route::post("filter-dashboard-by-date", "HomeController@filterByDate");
