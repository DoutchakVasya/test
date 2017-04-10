<?php

use App\Task;
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

/**
 * Home page [Create task]
 */

Route::get('/','BaseController@create');

/**
 * Send API request to ZohoCRM
 */
Route::post('/store', 'BaseController@storePotential');