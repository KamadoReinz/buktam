<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Middleware;

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
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');

// User
Route::get('/user', [UserController::class, 'index'])->name('users.index')->middleware('checkUserRole:1');
Route::get('/delete_user/{id}', [UserController::class, 'delete'])->name('users.delete')->middleware('checkUserRole:1');
Route::get('add_user', [UserController::class, 'AddUser'])->name('users.add')->middleware('checkUserRole:1');
Route::post('add_user', [UserController::class, 'store'])->name('addUser.perform')->middleware('checkUserRole:1');