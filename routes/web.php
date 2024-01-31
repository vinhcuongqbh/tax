<?php

use App\Http\Controllers\DonViController;
use App\Http\Controllers\PhongController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ProfileController;
// use Illuminate\Foundation\Application;
// use Inertia\Inertia;

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

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'donvi'], function () {
        Route::get('', [DonViController::class, 'index'])->name('donvi');
        Route::get('create', [DonViController::class, 'create'])->name('donvi.create');
        Route::post('store', [DonViController::class, 'store'])->name('donvi.store');
        //Route::get('{id}/', [DonViController::class, 'show'])->name('donvi.show');
        Route::get('{id}/edit', [DonViController::class, 'edit'])->name('donvi.edit');
        Route::post('{id}/update', [DonViController::class, 'update'])->name('donvi.update');
        Route::get('{id}/delete', [DonViController::class, 'destroy'])->name('donvi.delete');
        Route::get('{id}/restore', [DonViController::class, 'restore'])->name('donvi.restore');
    });

    Route::group(['prefix' => 'phong'], function () {
        Route::get('', [PhongController::class, 'index'])->name('phong');
        Route::get('create', [PhongController::class, 'create'])->name('phong.create');
        Route::post('store', [PhongController::class, 'store'])->name('phong.store');
        //Route::get('{id}/', [PhongController::class, 'show'])->name('phong.show');
        Route::get('{id}/edit', [PhongController::class, 'edit'])->name('phong.edit');
        Route::post('{id}/update', [PhongController::class, 'update'])->name('phong.update');
        Route::get('{id}/delete', [PhongController::class, 'destroy'])->name('phong.delete');
        Route::get('{id}/restore', [PhongController::class, 'restore'])->name('phong.restore');
    });

    Route::group(['prefix' => 'congchuc'], function () {
        Route::get('', [UserController::class, 'index'])->name('congchuc');
        Route::get('create', [UserController::class, 'create'])->name('congchuc.create');
        Route::post('store', [UserController::class, 'store'])->name('congchuc.store');
        //Route::get('{id}/', [UserController::class, 'show'])->name('congchuc.show');
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('congchuc.edit');
        Route::post('{id}/update', [UserController::class, 'update'])->name('congchuc.update');
        Route::get('{id}/delete', [UserController::class, 'destroy'])->name('congchuc.delete');
        Route::get('{id}/restore', [UserController::class, 'restore'])->name('congchuc.restore');
    });
});

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return view('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
