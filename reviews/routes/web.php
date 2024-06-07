<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

//user routes
Route::middleware(['auth', 'userMiddleware'])->group(function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('order', [UserController::class, 'order'])->name('user.order');
    Route::get('favorite', [FavoriteController::class, 'favorite'])->name('user.favorite');
});

//admin
Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/product', [AdminController::class, 'product'])->name('admin.product');
    Route::get('/admin/category', [AdminController::class, 'category'])->name('admin.category');
    Route::get('/admin/user', [AdminController::class, 'user'])->name('admin.user');
    // Admin only book routes
    Route::get('books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('books', [BookController::class, 'store'])->name('books.store');
    Route::delete('books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
});
Route::resource('books', BookController::class)
    ->only(['index', 'show']);

// Reviews routes
Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::resource('books.reviews', ReviewController::class)->only(['create', 'store', 'destroy']);
});
