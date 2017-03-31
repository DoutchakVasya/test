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

Route::get('/', function () {
	return view('home');
});

/**
 * Show all of tasks
 */
Route::get('/all', function () {
	$tasks = Task::orderBy('created_at', 'asc')->get();

	return view('tasks', [
		'tasks' => $tasks
	]);
});