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
    'as' => 'logout'
]);

Route::get('auth/register', [
    'uses' => 'HomeController@register',
    'as' => 'register',
]);

Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::get('auth/social/register', [
    'uses' => 'Auth\SocialRegistrationController@getRegistration',
    'as' => 'getSocialRegister',
]);

Route::post('auth/social/register', [
    'uses' => 'Auth\SocialRegistrationController@postRegistration',
    'as' => 'postSocialRegister',
]);

Route::controller('restaurants', 'RestaurantController');

Route::controller('tables', 'TableController');

/*
 *  Search
 */
Route::get('/search', [
    'uses' => 'SearchController@getResults',
    'as' => 'searchsite',
]);

Route::controller('menus', 'MenuController');

Route::controller('bookings', 'BookingController');

/*
 * Restaurant Profile
 */
Route::get('/rest/{id}', [
    'uses' => 'ProfileController@getProfile',
    'as' => 'restprofile',
]);

/*
 * Diner Profile
 */

Route::resource(
    'profile',
    'DinerProfileController',
    ['only' => ['show', 'edit', 'update']]
);

/*
 * Upload the diner's profile picture
 */
Route::post(
    '/profile/{username}/photo', [
    'uses' => 'DinerProfileController@uploadPhoto',
    'as' => 'diner_upload_photo',
]);

/*
 * Restaurateur Profile
 */
Route::controller('restaurateur', 'RestaurateurProfileController', [
    'getProfile' => 'restaurateur.profile',
]);
