<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StockController;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Dashboard

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para recursos (usando AJAX para el front)
    Route::resource('clients', ClientController::class)->only(['index', 'store']);
    Route::resource('products', ProductController::class)->only(['index', 'store']);

    // Acciones específicas
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::post('/stock', [StockController::class, 'store'])->name('stock.store');

    // Informes
    Route::get('/reports/client/{client}', [ReportController::class, 'clientStatement'])->name('reports.client');
});

require __DIR__.'/auth.php';

