<?php

use App\Http\Controllers\DonViController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });


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
        Route::get('{id}/', [DonViController::class, 'show'])->name('donvi.show');
        Route::get('{id}/edit', [DonViController::class, 'edit'])->name('usdonvier.edit');
        Route::post('{id}/update', [DonViController::class, 'update'])->name('donvi.update');
        Route::get('{id}/delete', [DonViController::class, 'destroy'])->name('donvi.delete');
        Route::get('{id}/restore', [DonViController::class, 'restore'])->name('user.restore');
    });
});

// Route::get('/dashboard', function () {
//     return view('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
