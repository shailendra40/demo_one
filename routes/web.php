<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Auth;

// Other routes...

// Auth::routes();

// Other routes...

// use App\Http\Controllers\UserController;
// use App\Http\Controllers\ProductController;
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
    return view('resume.create');
});
// Auth::routes();

Route::get('/index', [ResumeController::class, 'index'])->name('resume.index');
Route::get('/create', [ResumeController::class, 'create'])->name('resume.create');
Route::post('/store', [ResumeController::class, 'store'])->name('resume.store');
Route::get('/deleteRecord/{id}', [ResumeController::class, 'delete'])->name('resume.delete');

Route::get('/update/{id}', [ResumeController::class, 'edit'])->name('resume.edit');
Route::get('/preview/{id}', [ResumeController::class, 'preview'])->name('resume.preview');
Route::post('/update/{id}', [ResumeController::class, 'update'])->name('resume.update');

Route::post('/upload', [ResumeController::class, 'upload'])->name('upload');

