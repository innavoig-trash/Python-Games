<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/scanner', [HomeController::class, 'scanner'])->name('scanner');
Route::get('/plants', [HomeController::class, 'index'])->name('plants.index');
Route::get('/plants/{plant}', [HomeController::class, 'show'])->name('plants.show');
Route::get('/plants/{plant}/download', [HomeController::class, 'download'])->name('plants.download');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('index');
    Route::get('/scanner', [HomeController::class, 'scanner'])->name('scanner');
    Route::resource('plants', PlantController::class);
});

require __DIR__ . '/auth.php';
