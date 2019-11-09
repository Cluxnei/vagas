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

Route::redirect('/', '/home');

Auth::routes();

Route::middleware(['auth', 'approved'])->group(function () {
    #Home
    Route::get('/home', 'HomeController@index')->name('home');
    #Users
    Route::name('users.')->prefix('users')->group(function () {
        Route::get('administrators', 'UserController@administratorsIndex')->name('administrators');
        Route::get('approve/{id}', 'UserController@approve')->name('approve');
        Route::get('reject/{id}', 'UserController@reject')->name('reject');
    });
    #General Resources
    Route::resources([
        'cities' => 'CityController',
        'users' => 'UserController',
    ]);
});
