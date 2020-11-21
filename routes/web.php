<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

// Home画面
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

// 一覧画面
Route::get('/folders/{id}/tasks', 'App\Http\Controllers\TaskController@index')->name('tasks.index');

// フォルダ作成
Route::get('/folders/create', 'App\Http\Controllers\FolderController@showCreateForm')->name('folders.create');
Route::post('/folders/create', 'App\Http\Controllers\FolderController@create');

// タスク作成
Route::get('/folders/{id}/tasks/create', 'App\Http\Controllers\TaskController@showCreateForm')->name('tasks.create');
Route::post('/folders/{id}/tasks/create', 'App\Http\Controllers\TaskController@create');
// タスク編集
Route::get('/folders/{id}/tasks/{task_id}/edit', 'App\Http\Controllers\TaskController@showEditForm')->name('tasks.edit');
Route::post('/folders/{id}/tasks/{task_id}/edit', 'App\Http\Controllers\TaskController@edit');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
