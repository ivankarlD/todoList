<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/home')->middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/task/addform', [TaskController::class, 'addform'])->name('task.addform');
    Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/task/index/{category}', [TaskController::class, 'index'])->name('task.index');
    Route::post('/task/status', [TaskController::class, 'status'])->name('task.status');
    Route::get('/task/edit/{task}', [TaskController::class, 'edit'])->name('task.edit');
    Route::post('/task/update', [TaskController::class, 'update'])->name('task.update');
    Route::get('/category', [CategoryController::class, 'getCategories'])->name('category.categories');
});

Auth::routes();

