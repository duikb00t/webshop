<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// GET Requests will be handled here
Route::get('/', 'HomeController@home');                                 // Homepage
Route::get('/about', 'HomeController@about');                           // About us
Route::get('/contact', 'HomeController@contact');                       // Contact
Route::get('/downloads', 'HomeController@downloads');                   // Downloads

Route::get('/login', 'WebshopController@loginPage');                    // Login page
Route::get('/logout', 'WebshopController@logout');                      // Logout the current user
Route::get('/forgotpassword', 'WebshopController@forgotPassword');      // Forgot password page
Route::get('/webshop', 'WebshopController@main');                       // Main webshop page
Route::get('/product/{product_id}', 'WebshopController@showProduct');   // Product page
Route::get('/search', 'WebshopController@search');                      // Page with the search results
Route::get('/specials', 'WebshopController@specials');                  // Show only the specials
Route::get('/clearance', 'WebshopController@clearance');                // Show only the clearance products

Route::get('/account', 'AccountController@overview');                   // Account overview
Route::get('/account/changepassword', 'AccountController@changePass');  // Change password page
Route::get('/account/favorites', 'AccountController@favorites');        // Favorites
Route::get('/account/orderhistory', 'AccountController@orderhistory');  // Order history
Route::get('/account/addresslist', 'AccountController@addresslist');    // Addresslist
Route::get('/account/discountfile', 'AccountController@discountfile');  // ICC/CSV Discount generation page

Route::get('/cart', 'CartController@view');                             // Show the cart

// POST Requests will be handled here
Route::post('/login', 'WebshopController@login');                       // Login handler
Route::post('/forgotpassword', 'WebshopController@resetPassword');      // Password reset handler