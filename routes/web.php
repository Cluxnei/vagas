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
    Route::get('/search', 'HomeController@search')->name('search');
    #Users
    Route::name('users.')->prefix('users')->group(function () {
        Route::get('administrators', 'UserController@administratorsIndex')->name('administrators');
        Route::get('approve/{id}', 'UserController@approve')->name('approve');
        Route::get('reject/{id}', 'UserController@reject')->name('reject');
    });
    Route::name('jobs.')->prefix('jobs')->group(function () {
        Route::get('changeStatus/{status}/{id}', 'JobController@changeStatus')->name('changeStatus');
        Route::get('v/{id}', 'JobController@userView')->name('userView');
    });
    Route::get('make/admin/{id}', 'UserController@makeAdmin')->name('users.makeAdmin');
    #General Resources
    Route::resources([
        'cities' => 'CityController',
        'users' => 'UserController',
        'courses' => 'CourseController',
        'companies' => 'CompanyController',
        'jobs' => 'JobController',
    ]);
});
