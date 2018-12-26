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
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', 'DashboardController@index')->name("dashboard");

    Route::group(['namespace' => 'System'], function() {
        Route::resource('roles', 'RoleResourceController');
        Route::resource('tracking-numbers', 'TrackingNumberResourceController');
    });    

    Route::group(['namespace' => 'CRM', 'prefix' => 'crm'], function() {
        Route::resource('client-companies', 'ClientCompanyResourceController');
        Route::resource('quotations', 'QuotationResourceController');
    });

    Route::group(['namespace' => 'PLD', 'prefix' => 'pld'], function() {
        Route::resource('stock-inquiries', 'StockInquiryResourceController');        
    });
});