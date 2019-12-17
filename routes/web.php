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

Route::get('/', function () {
    return view('welcome');
});
//tasks
//Route::get('/tasks/data1', 'TasksController@data1');
Route::resource('tasks', 'TasksController');
//
Route::resource('books', 'BooksController');
Route::resource('members', 'MembersController');
Route::resource('depts', 'DeptsController');
Route::resource('todos', 'TodosController');

//
Auth::routes();
//
Route::get('/home', 'HomeController@index')->name('home');

