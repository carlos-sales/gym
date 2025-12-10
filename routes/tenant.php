<?php

declare(strict_types=1);

use App\Http\Controllers\Tenant\Auth\LoginController;
use App\Http\Controllers\Tenant\Aluno\AlunoController;
use App\Http\Controllers\Tenant\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    \Stancl\Tenancy\Middleware\InitializeTenancyByDomain::class,
    \Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains::class,
])->group(function ()
{
    Route::get('/', [LoginController::class, 'loginForm'])->name('tenant.login');
    Route::get('/login', [LoginController::class, 'loginForm'])->name('tenant.login');
    Route::post('/login', [LoginController::class, 'login'])->name('tenant.login.post');
    Route::post('/logout', [LoginController::class, 'logout'])->name('tenant.logout');

    Route::middleware('auth:tenant')->prefix('dashboard')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('tenant.dashboard.index');

    });

    Route::middleware('auth:tenant')->prefix('alunos')->group(function () {

        Route::get('/', [AlunoController::class, 'index'])->name('tenant.alunos.index');

        Route::get('/create', [AlunoController::class, 'create'])->name('tenant.alunos.create');
        Route::post('/', [AlunoController::class, 'store'])->name('tenant.alunos.store');

        Route::get('/{aluno}', [AlunoController::class, 'show'])->name('tenant.alunos.show');

        Route::get('/{aluno}/edit', [AlunoController::class, 'edit'])->name('tenant.alunos.edit');
        Route::put('/{aluno}', [AlunoController::class, 'update'])->name('tenant.alunos.update');

        Route::delete('/{aluno}', [AlunoController::class, 'destroy'])->name('tenant.alunos.destroy');
    });

    Route::fallback(function() {
        return redirect()->route('tenant.login');
    });
});


