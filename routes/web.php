<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;

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

// Home Page Route 
Route::get('/', [StudentController::class, 'index'])->name('home');
// Student Data Store & update
Route::post('/student/store', [StudentController::class, 'storeOrUpdate'])->name('students.store');
// Student Data Delete one by one
Route::post('/form-data/delete/{id}', [StudentController::class, 'deleteFormData'])->name('deleteFormData');
// Student all Data Delete in single click
Route::post('/delete-all-data-with-password/delete', [StudentController::class, 'deleteAllData'])->name('deleteAllDataWithPassword');
// Student file one by one Delete Route 
Route::delete('/students/delete/{id}/file/{fileIndex}', [StudentController::class, 'deleteFile'])->name('student.file.delete');