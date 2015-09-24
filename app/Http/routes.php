<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// GET Requests will be handled here
Route::get('/', 'HomeController@home');                                 	// Homepage
Route::get('/about', 'HomeController@about');                           	// About us
Route::get('/contact', 'HomeController@contact');                       	// Contact
Route::get('/downloads', 'HomeController@downloads');                   	// Downloads
Route::get('/licenses', 'HomeController@licenses');                     	// Licenses
Route::get('/assortment', 'HomeController@assortment');                         // Assortment
Route::get('/password/email', 'Auth\PasswordController@getEmail');		// Forgot password page
Route::get('/password/reset/{token}', 'Auth\PasswordController@getReset');	// Password reset page

Route::get('/logout', 'WebshopController@logout');                      	// Logout the current user
Route::get('/register', 'WebshopController@register');				// Show the register page
Route::get('/registrationSent', 'WebshopController@registerSent');		// Show the register page
Route::get('/forgotpassword', 'WebshopController@forgotPassword');      	// Forgot password page
Route::get('/webshop', 'WebshopController@main');                       	// Main webshop page
Route::get('/product/{product_id?}', 'WebshopController@showProduct');  	// Product page
Route::get('/search', 'WebshopController@search');                      	// Page with the search results
Route::get('/specials', 'WebshopController@specials');                  	// Show only the specials
Route::get('/clearance', 'WebshopController@clearance');                	// Show only the clearance products
Route::get('/cart', 'WebshopController@viewCart');               		// Show the cart
Route::get('/cart/destroy', 'WebshopController@cartDestroy');           	// Remove all items from the cart
Route::get('/cart/order/finished', 'WebshopController@orderFinished');		// Show the order finished page
Route::get('/reorder/{order_id}', 'WebshopController@reorder');			// Add the items from a previous order to the cart again

Route::get('/admin', 'AdminController@overview');                       	// Admin overview
Route::get('/admin/RAMLoad', 'AdminController@RAMLoad');                	// Get the server ram load
Route::get('/admin/CPULoad', 'AdminController@CPULoad');                	// Get the server cpu load
Route::get('/admin/import', 'AdminController@import');                  	// The page where the user can upload a CSV file with the products
Route::get('/admin/importsuccess', 'AdminController@importSuccess');    	// Import success page
Route::get('/admin/managecontent', 'AdminController@contentManager');   	// Content manager
Route::get('/admin/generate', 'AdminController@generate');			// Generate stuffs
Route::get('/admin/carousel', 'AdminController@carousel');			// Carousel manager
Route::get('/admin/getContent', 'AdminController@getContent');          	// Get the content for a field
Route::get('/admin/removeCarouselSlide/{id}', 'AdminController@removeSlide');	// Try to remove a carousel slide
Route::get('/admin/usermanager', 'AdminController@userManager');		// Simple user manager
Route::get('/admin/getUserData', 'AdminController@getUserData');		// Get the requested user's info
Route::get('/admin/userAdded', 'AdminController@userAdded');			// The user added page

Route::get('/account', 'AccountController@overview');                           // Account overview
Route::get('/account/changepassword', 'AccountController@changePassGET');       // Change password page
Route::get('/account/favorites', 'AccountController@favorites');                // Favorites
Route::get('/account/orderhistory', 'AccountController@orderhistory');          // Order history
Route::get('/account/addresslist', 'AccountController@addresslist');            // Addresslist
Route::get('/account/discountfile', 'AccountController@discountfile');          // ICC/CSV Discount generation page
Route::get('/account/generate_{type}/{method}', [
			'middleware' => 'RemoveTempFile', 			// Middleware to remove the temp css/icc file after download
			'uses' => 'AccountController@generateFile'		// Discount file generation handler
		]);

// POST Requests will be handled here
Route::when('*', 'csrf', array('post', 'put', 'delete'));

Route::post('/login', 'WebshopController@login');                           	// Login handler
Route::post('/register', 'WebshopController@register_check');			// Validate the registration reguest
Route::post('/forgotpassword', 'WebshopController@resetPassword');          	// Password reset handler
Route::post('/cart/add', 'WebshopController@addToCart');                    	// Add product to cart
Route::post('/cart/update', 'WebshopController@updateCart');                	// Update or remove product from cart
Route::post('/cart/order', 'WebshopController@order');				// Send the order

Route::post('password/email', 'Auth\PasswordController@postEmail');		// Reset password handler
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::post('/admin/productimport', 'AdminController@productImport');       	// Handle the product import
Route::post('/admin/discountimport', 'AdminController@discountImport');     	// Handle the discount import
Route::post('/admin/imageimport', 'AdminController@imageImport');     		// Handle the image import
Route::post('/admin/saveContent', 'AdminController@saveContent');           	// Save the page content
Route::post('/admin/generate', 'AdminController@generateCatalog');		// Generate the catalog
Route::post('/admin/addCarouselSlide', 'AdminController@addSlide');		// Try to add a carousel slide
Route::post('/admin/editCarouselSlide/{id}', 'AdminController@editSlide');	// Edit the slide order
Route::post('/admin/updateUser', 'AdminController@updateUser');			// Update/add the user

Route::post('/account/changepassword', 'AccountController@changePassPOST'); 	// Handle the change password request
Route::post('/account/addAddress', 'AccountController@addAddress');         	// Add address to the database
Route::post('/account/removeAddress', 'AccountController@removeAddress');   	// Remove address from the database
Route::post('/account/modFav', 'AccountController@modFav');                 	// Change the favorites
Route::post('/account/isFav', 'AccountController@isFav');                   	// Check the product array

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
