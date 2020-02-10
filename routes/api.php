<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->group(function () {
    Route::get('/', 'Api\UserController@index')->name('users');
    Route::post('/', 'Api\UserController@store')->name('users.store');
    Route::get('/{id}', 'Api\UserController@show')->name('users.store');
    Route::put('/{id}', 'Api\UserController@update')->name('users.store');
    Route::delete('/{id}', 'Api\UserController@delete')->name('users.delete');
});

Route::prefix('tasks')->group(function () {
    Route::get('/', 'Api\TaskController@index')->name('tasks');
    Route::post('/', 'Api\TaskController@store')->name('tasks.store');
    Route::get('/{id}', 'Api\TaskController@show')->name('tasks.show');
    Route::put('/{id}', 'Api\TaskController@update')->name('tasks.update');
    Route::delete('/{id}', 'Api\TaskController@index')->name('tasks.delete');
});
