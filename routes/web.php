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

// Route::get('/', function () {
//     return view('welcome');
// });

route::view('/demo', 'welcome');


Route::get('/', [StudentController::class, 'index'])->name('home');

Route::post('/student/store', [StudentController::class, 'storeOrUpdate'])->name('students.store');

Route::post('/student/save/{id}', [StudentController::class, 'update'])->name('student.update');

//Route::delete('/form-data/{id}', [StudentController::class, 'deleteFormData'])->name('deleteFormData');

Route::post('/form-data/delete/{id}', [StudentController::class, 'deleteFormData'])->name('deleteFormData');