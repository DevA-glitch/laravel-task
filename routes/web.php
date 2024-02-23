<?php

use App\Http\Controllers\StudentDetailController;
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


Route::prefix('/')->group(function () {
    Route::get('/', [StudentDetailController::class, 'index'])->name('index');
    Route::post('/store', [StudentDetailController::class, 'store'])->name('student.store');
    Route::post('/data-table', [StudentDetailController::class, 'dataTable'])->name('student.datatable');
    Route::get('/edit/{id}', [StudentDetailController::class, 'edit'])->name('student.edit');
    Route::put('/update', [StudentDetailController::class, 'update'])->name('student.update');
    Route::delete('/delete/{id}', [StudentDetailController::class, 'delete'])->name('student.delete');
});

