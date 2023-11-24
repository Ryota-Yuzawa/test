<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\homeController::class, 'home'])->name('home');
Route::get('/vending_machine', [App\Http\Controllers\ProductController::class, 'index'])->name('index');

Route::get('/vending_machine/create', [App\Http\Controllers\ProductController::class, 'create'])->name('create');
Route::post('/vending_machine/store/', [App\Http\Controllers\ProductController::class, 'store'])->name('store');

Route::get('/vending_machine/show/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('show');

Route::get('/vending_machine/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('edit');
Route::put('/vending_machine/edit/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('update');

Route::delete('/destroy/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('destroy');