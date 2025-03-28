<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('home');
});

Route::resource('students', StudentController::class);
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::get('/students/search', [StudentController::class, 'search'])->name('students.search');
