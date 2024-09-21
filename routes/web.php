<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\UserController;

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

require __DIR__.'/auth.php';

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin'], function () {
    Route::get('home', [Admin\HomeController::class, 'index'])->name('home');
    Route::get('admin/users', [Admin\UserController::class, 'index'])->middleware(['auth', 'verified'])->name('users.index');
    Route::get('admin/users/{post}', [Admin\UserController::class, 'show'])->middleware(['auth', 'verified'])->name('users.show');
});
