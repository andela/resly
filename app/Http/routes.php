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

Route::get('/', 'HomeController@homepage');
Route::get('/aboutus', 'HomeController@aboutus');
Route::get('/contactus', 'HomeController@contactus');

Route::get('auth/login', [
    'uses' => 'HomeController@login',
    'as' => 'login',
]);

Route::post('auth/login', 'Auth\AuthController@postLogin');

Route::get('auth/logout', [
    'uses' => 'Auth\AuthController@getLogout',
    'as' => 'logout',
]);

Route::get('auth/register', [
    'uses' => 'HomeController@register',
    'as' => 'register',
]);

Route::post('changepassword', [
    'uses' => 'PasswordController@changePassword',
    'as' => 'changepassword',
]);

Route::post('auth/register', 'Auth\AuthController@postRegister');

/*
 * Social Authentication
 */
Route::get('auth/{provider}', [
    'uses' => 'Auth\SocialAuthController@redirectToProvider',
    'as' => 'social.login',
]);

Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::get('auth/social/register', [
    'uses' => 'Auth\SocialRegistrationController@getRegistration',
    'as' => 'social.register',
]);

Route::post('auth/social/register', [
    'uses' => 'Auth\SocialRegistrationController@postRegistration',
    'as' => 'social.post.register',
]);
/*
 * Restaurants Routes
 */
Route::get('restaurants/', 'RestaurantController@index');
Route::get('restaurants/create', 'RestaurantController@create');
Route::post('restaurants/add', 'RestaurantController@createAdd');
Route::get('restaurants/search', 'RestaurantController@search');
Route::get('restaurants/{restaurant_id}/tables', 'TableController@create');
Route::get('restaurants/visited', 'RestaurantController@visited');
Route::get('restaurants/{restaurant_id}', 'RestaurantController@show');
Route::get('restaurants/edit/{restaurant_id}', 'RestaurantController@edit');
Route::post('restaurants/edit/{restaurant_id}', 'RestaurantController@createEdit');
Route::post('restaurants/closeby', 'RestaurantController@postCloseBy');
Route::get('restaurants/page/{id}', 'RestaurantController@showRestaurant');
Route::get('restaurant/{id}/gallery', 'RestaurantController@showGallery');
Route::post('restaurants/{restaurant_id}/rate', 'RestaurantController@rateRestaurant');

/*
 * Tables Routes
 */
Route::post('tables/', 'TableController@store');
Route::get('tables/{table_id}/edit', 'TableController@edit');
Route::get('tables/{table_id}', 'TableController@getTable');
Route::get('book/multipletables', 'TableController@getTables');
Route::put('tables/{table_id}/', 'TableController@update');
Route::delete('tables/{table_id}/delete', 'TableController@destroy');
Route::get('tables/add-bulk', 'TableController@addBulk');
Route::post('tables/add-bulk', 'TableController@createAddBulk');

/*
 *  Search
 */
Route::get('/search', [
    'uses' => 'SearchController@getResults',
    'as' => 'searchsite',
]);

/*
 * Menus Routes
 */
Route::get('menus/addbulk', 'MenuController@addBulk');
Route::post('menus/addbulk', 'MenuController@createAddBulk');

/*
 * Booking Routes
 */
Route::get('bookings/', 'BookingController@index');
Route::get('bookings/addbulk', 'BookingController@addBulk');
Route::post('bookings/begin', 'BookingController@begin');
Route::post('bookings/create', 'BookingController@create');
Route::post('bookings/cancel', 'BookingController@cancel');
Route::get('bookings/{table_id}', 'TableController@showBookings');

Route::get('gallery/{rest_id}', 'RestaurantGalleryController@index');
Route::post('/gallery', 'RestaurantGalleryController@store');
Route::delete('/gallery/{id}', 'RestaurantGalleryController@destroy');
Route::post('/multiple/book', 'BookingController@multipleBook');
Route::post('/clear/bookings', 'BookingController@clearTableFromSession');

Route::get('cart/delete/{item_id}', 'BookingController@delteCartItem');
/*
 * Restaurant Profile
 */
Route::get('/restaurant/{restaurant_id}/book/', [
    'uses' => 'BookingController@book',
    'as' => 'bookRestaurantTable',
]);

Route::post('/booking/table/{table_id}/add', 'BookingController@addTable');
Route::post('/booking/tables/add', 'BookingController@addTables');
Route::get('/booking/cart', 'BookingController@cart');
Route::post('/cart/checkout', 'BookingController@checkout');
Route::get('dashboard', [
    'uses' => 'DashboardController@showDashboard',
    'as' => 'dashboard',
]);

/*
 * User profile
 */
Route::get('/user/profile/edit', [
    'uses' => 'UserProfileController@getEdit',
    'as' => 'userProfileEdit',
    'middleware' => 'auth',
]);

Route::post('/user/profile/edit', [
    'uses' => 'UserProfileController@postEdit',
    'as' => 'userProfileEdit',
    'middleware' => 'auth',
]);

Route::get('/user/{username}', [
    'uses' => 'UserProfileController@getProfile',
    'as' => 'userProfile',
    'middleware' => 'auth',
]);

/* User reservations
 *
 */
Route::get('/reservations/current', 'ReservationController@currentReservations');
Route::get('/reservations/past', 'ReservationController@pastReservations');
Route::get('/reservations/cancelled', 'ReservationController@cancelledReservations');
Route::get('/reservations/cancel/{id}', 'ReservationController@cancelReservation');
