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

Route::get('/', 'IndexController@getAction')->name('home');
Route::get('downloads', 'DownloadsController@getAction')->name('downloads');

Route::group([
    'as' => 'auth.',
    'namespace' => 'Auth'
], function () {
    Route::get('login', 'LoginController@getAction')->name('login');
    Route::post('login', 'LoginController@postAction');

    Route::post('logout', 'LogoutController@postAction')->name('logout');
});

Route::group([
    'as' => 'account.',
    'prefix' => 'account',
    'namespace' => 'Account',
    'middleware' => ['auth']
], function () {
    Route::get('/', 'DashboardController@getAction')->name('dashboard');
    Route::get('accounts', 'SubAccountController@getAction')->name('sub_accounts');
    Route::get('password', 'PasswordController@getAction')->name('change_password');

    Route::post('password', 'PasswordController@postAction');

    Route::group([
        'prefix' => 'accounts',
        'as' => 'accounts.'
    ], function () {


        Route::post('/', 'SubAccountController@store');
        Route::post('update/{id}', 'SubAccountController@update')->name('update');
        Route::post('remove', 'SubAccountController@destroy')->name('delete');
    });

    Route::group([
        'prefix' => 'favorites',
        'as' => 'favorites::'
    ], function () {
        Route::get('/', 'FavoritesController@view')->name('view');

        Route::post('check', 'FavoritesController@check')->name('check');
        Route::post('add', 'FavoritesController@add')->name('add');
        Route::post('delete', 'FavoritesController@delete')->name('delete');
    });

    Route::group([
        'prefix' => 'history',
        'as' => 'history.'
    ], function () {
        Route::get('/', 'OrderHistoryController@view')->name('view');

        Route::get('{order}', 'OrderHistoryController@addOrderToCart')->name('reorder');
    });

    Route::group([
        'prefix' => 'addresses',
        'as' => 'addresses.'
    ], function () {
        Route::get('/', 'AddressController@view')->name('view');

        Route::post('add', 'AddressController@add')->name('add');
        Route::post('delete/{id}', 'AddressController@delete')->name('delete');
    });

    Route::group([
        'prefix' => 'discountfile',
        'as' => 'discountfile.'
    ], function () {
        Route::get('/', 'DiscountfileController@view')->name('view');
        Route::get('generate/{type}/{method}', 'DiscountfileController@generate')->name('generate');
    });
});