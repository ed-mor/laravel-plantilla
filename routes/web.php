<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('dashboard', function () {
    return Inertia::render('Dashboard/Dashboard' , [
    	'logo' => env('APP_URL', 'Logo en el:') . env('APP_LOGO', '.env')
    ]);
})->name('dashboard');

// Users
Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('remember', 'auth');
Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');
Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');
Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');
Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');
Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');
Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');

