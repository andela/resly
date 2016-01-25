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
    'as'   => 'social.login',
]);

Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::get('auth/social/register', [
    'uses' => 'Auth\SocialRegistrationController@getRegistration',
    'as'   => 'social.register',
]);

Route::post('auth/social/register', [
    'uses' => 'Auth\SocialRegistrationController@postRegistration',
    'as'   => 'social.post.register',
]);
/*
 * Restaurants Routes
 */
Route::get('restaurants/add', 'RestaurantController@add');
Route::post('restaurants/add', 'RestaurantController@createAdd');
Route::get('restaurants/edit', 'RestaurantController@edit');
Route::post('restaurants/edit', 'RestaurantController@createEdit');

/*
 * Tables Routes
 */
Route::get('tables/addbulk', 'TableController@addBulk');
Route::post('tables/addbulk', 'TableController@createAddBulk');

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
Route::get('menus/addbulk', 'BookingController@addBulk');
Route::post('menus/begin', 'BookingController@begin');
Route::post('menus/create', 'BookingController@create');
Route::post('menus/cancel', 'BookingController@cancel');

/*
 * Restaurant Profile
 */
Route::get('/rest/{id}', [
    'uses' => 'ProfileController@getProfile',
    'as' => 'restprofile',
]);

Route::get('dashboard', [
    'uses' => 'DashboardController@showDashboard',
    'as'   => 'dashboard',
]);

/*
 * User profile
 */

Route::get('/user/{username}', [
    'uses' => 'UserProfileController@getProfile',
    'as'   => 'userProfile',
    'middleware' => 'auth',
]);
