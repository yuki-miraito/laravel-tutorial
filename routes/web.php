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

Route::group(['middleware' => 'auth'], function () {
    // Home画面
    Route::get(
        '/',
        [App\Http\Controllers\HomeController::class, 'index']
    )->name('home');

    // フォルダ作成
    Route::get(
        '/folders/create',
        [App\Http\Controllers\FolderController::class, 'showCreateForm']
    )->name('folders.create');

    Route::post(
        '/folders/create',
        [App\Http\Controllers\FolderController::class, 'create']
    );

    // FolderPolicyを適用
    Route::group(['middleware' => 'can:view,folder'], function () {
        // 一覧画面
        Route::get(
            '/folders/{folder}/tasks',
            [App\Http\Controllers\TaskController::class, 'index']
        )->name('tasks.index');

        // タスク作成
        Route::get(
            '/folders/{folder}/tasks/create',
            [App\Http\Controllers\TaskController::class, 'showCreateForm']
        )->name('tasks.create');

        Route::post(
            '/folders/{folder}/tasks/create',
            [App\Http\Controllers\TaskController::class, 'create']
        );

        // タスク編集
        Route::get(
            '/folders/{folder}/tasks/{task}/edit',
            [App\Http\Controllers\TaskController::class, 'showEditForm']
        )->name('tasks.edit');

        Route::post(
            '/folders/{folder}/tasks/{task}/edit',
            [App\Http\Controllers\TaskController::class, 'edit']
        );
    });
});

Auth::routes();
