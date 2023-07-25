<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('product')->group(function(){
    Route::get('/', [ProductController::class, 'index'])->name('product');
    // Route::get('/{id}', [ProductController::class, 'index']);
    Route::get('create', [ProductController::class, 'create']);
    Route::post('create', [ProductController::class, 'store']);
    Route::get('edit/{id}', [ProductController::class, 'edit']);
    Route::post('edit/{id}', [ProductController::class, 'update']);
    Route::get('delete/{id}', [ProductController::class, 'delete']);
});

Route::prefix('transaction')->group(function(){
    Route::get('/', [TransactionController::class, 'index'])->name('transaction');
    // Route::get('/{id}', [ProductController::class, 'index']);
    Route::get('create', [TransactionController::class, 'create']);
    Route::post('create', [TransactionController::class, 'store']);
    Route::get('edit/{id}', [TransactionController::class, 'edit']);
    Route::post('edit/{id}', [TransactionController::class, 'update']);
    Route::get('delete/{id}', [TransactionController::class, 'delete']);
});