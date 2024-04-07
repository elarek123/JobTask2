<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\TaskController::class, 'index'])->name('home');

Route::post('/store', [\App\Http\Controllers\TaskController::class, 'store'])->name('store');

Route::get('/tasks', [\App\Http\Controllers\TaskController::class, 'show'])->name('tasks');

Route::get('/task/{task}', [\App\Http\Controllers\TaskController::class, 'showOne'])->name('task.show');

Route::delete('/task/{task}', [\App\Http\Controllers\TaskController::class, 'destroy'])->name('task.delete'); 

Route::put('/task/{task}', [\App\Http\Controllers\TaskController::class, 'update'])->name('task.update');

Route::post('/task/{task}/status', [\App\Http\Controllers\TaskController::class, 'updateStatus'])->name('status');


