<?php

use App\Http\Controllers\SystemSettings\ModuleController;
use App\Http\Controllers\SystemSettings\SubModuleController;
use Illuminate\Support\Facades\Route;

// MODULE ROUTES
Route::group(['prefix' => 'system-modules', 'as' => 'module.'], function () {
    Route::get('/', [ModuleController::class, 'index'])->name('index')->middleware(['module:manage_module']);
    Route::post('/store', [ModuleController::class, 'store'])->name('store')->middleware(['module:store_module']);

    Route::post('/data-table', [ModuleController::class, 'dataTable'])->name('datatable')->middleware(['module:show_module']);

    Route::get('/edit/{id}', [ModuleController::class, 'edit'])->name('edit')->middleware(['module:edit_module']);
    Route::patch('/update', [ModuleController::class, 'update'])->name('update')->middleware(['module:update_module']);
});
// END MODULE ROUTES

// SUB MODULE ROUTES
Route::group(['prefix' => 'system-modules/sub-modules', 'as' => 'sub_module.'], function () {
    Route::get('/', [SubModuleController::class, 'index'])->name('index')->middleware(['module:manage_sub_module']);
    Route::post('/store', [SubModuleController::class, 'store'])->name('store')->middleware(['module:store_sub_module']);

    Route::post('/data-table', [SubModuleController::class, 'dataTable'])->name('datatable')->middleware(['module:show_sub_module']);

    Route::get('/edit/{id}', [SubModuleController::class, 'edit'])->name('edit')->middleware(['module:edit_sub_module']);
    Route::patch('/update', [SubModuleController::class, 'update'])->name('update')->middleware(['module:update_sub_module']);
});
// END SUB MODULE ROUTES