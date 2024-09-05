<?php

use App\Exports\ProductExport;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});

// auth()->routes();
Auth::routes();


// test view
// Route::get('/transaction/create', function () {
//     return view('admin.transaction.create');
// });
// Route::get('/transaction/store', function () {
//     return view('admin.transaction.store');
// });
// Route::get('/transaction/index', function () {
//     return view('admin.transaction.index');
// });

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // category
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/index', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{id}/show', [CategoryController::class, 'show'])->name('categories.show');
    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // product
    Route::get('product/export', [ProductController::class, 'export'])->name('product.export');
    Route::get('product/lihat', [ProductController::class, 'lihat'])->name('product.lihat');
    Route::resource('product', ProductController::class);


    // transaction
    Route::get('transaction/export', [TransactionController::class, 'export'])->name('transaction.export');
    Route::get('transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
    Route::post('transaction/import', [TransactionController::class, 'import'])->name('transaction.import');

    Route::get('transaction/index', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('transaction/lihat', [TransactionController::class, 'lihat'])->name('transaction.lihat');
});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
