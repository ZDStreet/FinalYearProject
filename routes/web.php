<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ChairController;
use App\Http\Controllers\AbstractController;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\AdminController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [AbstractController::class, 'index'])->name('abstracts');
    Route::get('/abstracts/{abstract}', [AbstractController::class, 'show'])->name('abstracts.show');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin|author',
])->group(function () {
    Route::get('/author', [AuthorController::class, 'index'])->name('author.index');
    Route::post('/upload', [AuthorController::class, 'upload'])->name('upload');
    Route::post('/author/reupload/{id}', [AuthorController::class, 'reupload'])->name('reupload');
    Route::delete('/author/delete/{id}', [AuthorController::class, 'delete'])->name('delete');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin|reviewer',
])->group(function () {
    Route::get('/reviewer', [ReviewerController::class, 'index'])->name('reviewer.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin|chair',
])->group(function () {
    Route::get('/chair', [ChairController::class, 'index'])->name('chair.index');
    Route::get('/chair/assignAbstracts', [ChairController::class, 'assignAbstracts'])->name('chair.assignAbstracts');
    Route::get('/chair/reviewCriteria', [ChairController::class, 'reviewCriteria'])->name('chair.reviewCriteria');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin',
])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});