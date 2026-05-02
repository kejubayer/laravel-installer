<?php

use Illuminate\Support\Facades\Route;
use Kejubayer\Installer\Http\Controllers\InstallerController;

Route::middleware(['web', 'installer.not_installed'])
    ->prefix(config('installer.route_prefix', 'install'))
    ->group(function (): void {
        Route::get('/', [InstallerController::class, 'index'])->name('installer.index');
        Route::get('/requirements', [InstallerController::class, 'requirements'])->name('installer.requirements');
        Route::get('/permissions', [InstallerController::class, 'permissions'])->name('installer.permissions');
        Route::get('/database', [InstallerController::class, 'database'])->name('installer.database');
        Route::post('/database', [InstallerController::class, 'saveDatabase'])->name('installer.database.save');
        Route::post('/migrate', [InstallerController::class, 'migrate'])->name('installer.migrate');
    });

Route::middleware(['web', 'installer.installed'])
    ->prefix(config('installer.route_prefix', 'install'))
    ->group(function (): void {
        Route::get('/finish', [InstallerController::class, 'finish'])->name('installer.finish');
    });