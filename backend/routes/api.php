<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProgramAuthorController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\ResearchAuthorController;
use App\Http\Controllers\SalesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// User routes
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
})->name('user');

Route::prefix('user')->group(function () {
    Route::get('/{username}/username', [RegisteredUserController::class, 'fetchUserByUsername'])
        ->name('user.byUsername');
    Route::get('/{role}/role', [RegisteredUserController::class, 'fetchUserByRole'])
        ->name('user.byRole');
    Route::put('/{id}', [RegisteredUserController::class, 'update'])
        ->name('user.update');
});

// Department routes
Route::prefix('departments')->group(function () {
    Route::get('/', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/{id}', [DepartmentController::class, 'getDepartmentById'])->name('departments.byId');
    Route::get('/{username}/username', [DepartmentController::class, 'getDepartmentByUsername'])
        ->name('departments.byUsername');
    Route::get('/{level}/level', [DepartmentController::class, 'getDepartmentsByLevel'])
        ->name('departments.byLevel');
});

// News routes
Route::prefix('news')->group(function () {
    Route::get('/{news?}/{newsId?}', [NewsController::class, 'index'])->name('news.index');
    Route::post('/', [NewsController::class, 'store'])->name('news.store');
    Route::put('/{newsId}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/{newsId}', [NewsController::class, 'destroy'])->name('news.destroy');
});

// Program routes
Route::prefix('programs')->group(function () {
    Route::get('/{identifier?}/{type?}', [ProgramController::class, 'index'])->name('programs.index');
    Route::post('/', [ProgramController::class, 'store'])->name('programs.store');
    Route::put('/{programId}', [ProgramController::class, 'update'])->name('programs.update');
    Route::delete('/{programId}', [ProgramController::class, 'destroy'])->name('programs.destroy');
});

// ProgramAuthor routes
Route::prefix('program-authors')->group(function () {
    Route::get('/{programId}', [ProgramAuthorController::class, 'index'])->name('program.authors.index');
    Route::post('/{programId}', [ProgramAuthorController::class, 'store'])->name('program.authors.store');
    Route::delete('/{program}/{programAuthor}', [ProgramAuthorController::class, 'destroy'])
        ->name('program.authors.destroy');
});

// Research routes
Route::prefix('researches')->group(function () {
    Route::get('/{identifier?}/{type?}', [ResearchController::class, 'index'])->name('researches.index');
    Route::post('/', [ResearchController::class, 'store'])->name('researches.store');
    Route::put('/{researchId}', [ResearchController::class, 'update'])->name('researches.update');
    Route::delete('/{researchId}', [ResearchController::class, 'destroy'])->name('researches.destroy');
});

// ResearchAuthor routes
Route::prefix('research-authors')->group(function () {
    Route::get('/{researchId}', [ResearchAuthorController::class, 'index'])->name('research.authors.index');
    Route::post('/{researchId}', [ResearchAuthorController::class, 'store'])->name('research.authors.store');
    Route::delete('/{research}/{researchAuthor}', [ResearchAuthorController::class, 'destroy'])
        ->name('research.authors.destroy');
});

// Product routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/{id}', [ProductController::class, 'getProductById'])->name('products.byId');
    Route::get('/{category}/category', [ProductController::class, 'getProductsByCategory'])
        ->name('products.byCategory');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::put('/{productId}', [ProductController::class, 'update'])->name('products.update');
    Route::put('/{productId}/kilos', [ProductController::class, 'updateKilos'])->name('products.updateKilos');
    Route::delete('/{productId}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// Customer routes
Route::prefix('customers')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
    Route::post('/', [CustomerController::class, 'store'])->name('customers.store');
    Route::put('/{customerId}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/{customerId}', [CustomerController::class, 'destroy'])->name('customers.destroy');
});

// Order routes
Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/', [OrderController::class, 'store'])->name('orders.store');
    Route::put('/{orderId}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/{orderId}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

// Sales routes
Route::prefix('sales')->group(function () {
    Route::get('/', [SalesController::class, 'index'])->name('sales.index');
    Route::get('/search/{searchTerm}', [SalesController::class, 'search'])->name('sales.search');
    Route::get('/salesData', [SalesController::class, 'salesData'])->name('sales.salesData');
    Route::get('/notificationData', [SalesController::class, 'notificationData'])->name('sales.notificationData');
    Route::get('/topSales', [SalesController::class, 'topSales'])->name('sales.topSales');
    Route::get('/overviewSales', [SalesController::class, 'overviewSales'])->name('sales.overviewSales');
    Route::get('/overviewOrders', [SalesController::class, 'overviewOrders'])->name('sales.overviewOrders');
    Route::get('/overviewCustomers', [SalesController::class, 'overviewCustomers'])->name('sales.overviewCustomers');
    Route::get('/overviewKilos', [SalesController::class, 'overviewKilos'])->name('sales.overviewKilos');
    Route::post('/', [SalesController::class, 'store'])->name('sales.store');
    Route::put('/{salesId}', [SalesController::class, 'update'])->name('sales.update');
    Route::delete('/{salesId}', [SalesController::class, 'destroy'])->name('sales.destroy');
});

Route::post('/image-compress', [ImageController::class, 'compressImage']);