<?php

use App\Http\Controllers\Central\Auth\LoginController;
use App\Http\Controllers\Central\Dashboard\DashboardController;
use App\Http\Controllers\Central\Relatorio\RelatorioController;
use App\Http\Controllers\Central\Tenant\TenantController;
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

Route::middleware('web')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Welcome', ['isTenant' => false]);
    });
});

Route::middleware('web')->prefix('admin')->group(function () {

    Route::get('/', [LoginController::class, 'loginForm'])->name('central.login');
    Route::get('/login', [LoginController::class, 'loginForm'])->name('central.login');
    Route::post('/login', [LoginController::class, 'login'])->name('central.login.post');
    Route::post('/logout', [LoginController::class, 'logout'])->name('central.logout');

    Route::middleware('auth')->prefix('dashboard')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('central.dashboard.index');

    });

    Route::middleware('auth')->prefix('tenants')->group(function () {

        Route::get('/', [TenantController::class, 'index'])->name('central.tenants.index');

        Route::get('/create', [TenantController::class, 'create'])->name('central.tenants.create');
        Route::post('/', [TenantController::class, 'store'])->name('central.tenants.store');

        Route::get('/{tenant}', [TenantController::class, 'show'])->name('central.tenants.show');

        Route::get('/{tenant}/edit', [TenantController::class, 'edit'])->name('central.tenants.edit');
        Route::put('/{tenant}', [TenantController::class, 'update'])->name('central.tenants.update');

        Route::delete('/{tenant}', [TenantController::class, 'destroy'])->name('central.tenants.destroy');
    });

    Route::middleware('auth')->prefix('relatorio')->group(function () {
        Route::get('/', [RelatorioController::class, 'index'])
            ->name('central.relatorio.index');

        Route::post('/filtrar', [RelatorioController::class, 'filtrar'])
            ->name('central.relatorio.filtrar');
    });
});

Route::fallback(function() {
    return Inertia::render('Welcome');
});

require __DIR__.'/auth.php';
