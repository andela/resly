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
Route::get('restaurants/add', 'RestaurantController@add');
Route::post('restaurants/add', 'RestaurantController@createAdd');
Route::get('restaurants/edit/{restaurant_id}', 'RestaurantController@edit');
Route::post('restaurants/edit/{restaurant_id}', 'RestaurantController@createEdit');
Route::post('restaurants/{restaurant_id}/rate', 'RestaurantController@rateRestaurant');

/*
 * Tables Routes
 */
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

Route::resource('gallery', 'RestaurantGalleryController');

/*
 * Restaurant Profile
 */
Route::get('/rest/{id}', [
    'uses' => 'ProfileController@getProfile',
    'as' => 'restprofile',
]);

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
