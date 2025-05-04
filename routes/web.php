<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FilerCategoryController;
use Illuminate\Support\Facades\Route;


//  Web Routes

// Public Route
Route::get('/', function () {
    return view('welcome');
});


//  Admin Routes
Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('admin/products/approve/{id}', [AdminController::class, 'approve'])->name('products.approve');
    Route::resource('admin/categories', CategoryController::class);
});


//  Vendor Routes

Route::middleware(['auth', 'verified', 'rolemanager:vendor'])->group(function () {
    Route::get('vendor/dashboard', function () {
        return view('vendor.vendor');
    })->name('vendor');

    Route::resource('vendor/products', ProductController::class);
});

//  Customer/User Routes

Route::middleware(['auth', 'verified', 'rolemanager:customer'])->group(function () {
    Route::get('/dashboard', CustomerController::class)->name('dashboard');
    Route::get('/dashboard/category/{category}', FilerCategoryController::class)->name('dashboard.filter');
});

//  Profile Routes

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Routes
require __DIR__.'/auth.php';
