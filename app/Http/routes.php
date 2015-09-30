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

Route::get('/', function () {
    return view('welcome');

});

Route::controller('restaurants', 'RestaurantController');

Route::controller('tables', 'TableController');

/*
 *  Restaurateur routes
 */
Route::get('/rest', [
    'uses' => '\Resly\Http\Controllers\HomeController@resthome',
    'as' => 'resthome',
]);

Route::get('/rest/signup', [
    'uses' => '\Resly\Http\Controllers\RestAuthController@getRestSignup',
    'as' => 'restsignup',
]);

Route::post('/rest/signup', [
    'uses' => '\Resly\Http\Controllers\RestAuthController@postRestSignup',
]);

Route::get('/rest/login', [
    'uses' => '\Resly\Http\Controllers\RestAuthController@getRestSignin',
    'as' => 'restsignin',
]);

Route::post('/rest/login', [
    'uses' => '\Resly\Http\Controllers\RestAuthController@postRestSignin',
]);

Route::get('/rest/logout', [
    'uses' => '\Resly\Http\Controllers\RestAuthController@getRestSignout',
    'as' => 'restsignout',
]);

/*
 *  Diner Routes
 */
Route::get('/diner', [
    'uses' => '\Resly\Http\Controllers\HomeController@dinerhome',
    'as' => 'dinerhome',
]);

Route::get('/diner/signup', [
    'uses' => '\Resly\Http\Controllers\DinerAuthController@getDinerSignup',
    'as' => 'dinersignup',
]);

Route::post('/diner/signup', [
    'uses' => '\Resly\Http\Controllers\DinerAuthController@postDinerSignup',
]);

Route::get('/diner/login', [
    'uses' => '\Resly\Http\Controllers\DinerAuthController@getDinerSignin',
    'as' => 'dinersignin',
]);

Route::post('/diner/login', [
    'uses' => '\Resly\Http\Controllers\DinerAuthController@postDinerSignin',
]);

Route::get('/diner/logout', [
    'uses' => '\Resly\Http\Controllers\DinerAuthController@getDinerSignout',
    'as' => 'dinersignout',
]);

/*
 *  Search
 */
Route::get('/diner/search', [
    'uses' => '\Resly\Http\Controllers\SearchController@getResults',
    'as' => 'dinersearch',
]);
