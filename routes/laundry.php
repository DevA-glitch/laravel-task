<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaundryService\LaundryTypeController;
use App\Http\Controllers\LaundryService\LaundryItemController;




// LAUNDRY TYPE ROUTES
Route::group(['prefix' => 'laundry-type', 'as' => 'laundry.type.'], function () {
    Route::get('/', [LaundryTypeController::class, 'index'])->name('index')->middleware(['module:manage_laundry_type']);
    Route::post('/store', [LaundryTypeController::class, 'store'])->name('store')->middleware(['module:store_laundry_type']);

    Route::post('/data-table', [LaundryTypeController::class, 'dataTable'])->name('datatable')->middleware(['module:show_laundry_type']);

    Route::get('/edit/{id}', [LaundryTypeController::class, 'edit'])->name('edit')->middleware(['module:edit_laundry_type']);
    Route::patch('/update', [LaundryTypeController::class, 'update'])->name('update')->middleware(['module:update_laundry_type']);
    Route::delete('/delete/{id}', [LaundryTypeController::class, 'delete'])->name('delete')->middleware(['module:delete_laundry_type']);

});
// END LAUNDRY TYPE ROUTES

// LAUNDRY ITEM ROUTES
Route::group(['prefix' => 'laundry-item', 'as' => 'laundry.item.'], function () {
    Route::get('/', [LaundryItemController::class, 'index'])->name('index')->middleware(['module:manage_laundry_item']);
    Route::post('/store', [LaundryItemController::class, 'store'])->name('store')->middleware(['module:store_laundry_item']);

    Route::post('/data-table', [LaundryItemController::class, 'dataTable'])->name('datatable')->middleware(['module:show_laundry_item']);

    Route::get('/edit/{id}', [LaundryItemController::class, 'edit'])->name('edit')->middleware(['module:edit_laundry_item']);
    Route::patch('/update', [LaundryItemController::class, 'update'])->name('update')->middleware(['module:update_laundry_item']);
    Route::delete('/delete/{id}', [LaundryItemController::class, 'delete'])->name('delete')->middleware(['module:delete_laundry_item']);

});
// END LAUNDRY ITEM ROUTES
