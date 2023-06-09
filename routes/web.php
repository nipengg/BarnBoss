<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SellerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register/seller', [SellerController::class, 'create'])->name('seller.create');
Route::post('/store/seller', [SellerController::class, 'store'])->name('seller.store');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [CartController::class, 'shop'])->name('dashboard');
    Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.store');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/store', [CartController::class, 'store'])->name('cart.checkout');
    Route::get('/pdf/{in}', [InvoiceController::class, 'genPDF']);
    Route::get('/allpdf', [InvoiceController::class, 'genAllPDF']);
    Route::get('/product/{id}', [DashboardController::class, 'productDetail'])->name('product.detail');
});

Route::prefix('/transaction')->group(function () {
    Route::get('/', [TransactionController::class, 'index'])->name('transaction');
    Route::get('/detail/{id}', [TransactionController::class, 'detail'])->name('transaction.detail');
    Route::get('/rating/{id}', [TransactionController::class, 'rating'])->name('transaction.rating');
    Route::post('/store/rating/{id}', [TransactionController::class, 'storeRating'])->name('store.rating');
    Route::post('/update/rating/{id}', [TransactionController::class, 'updateRating'])->name('update.rating');
});

Route::prefix('/order')->group(function () {
    Route::get('/', [TransactionController::class, 'order'])->name('order');
    Route::post('/update/status/{id}', [TransactionController::class, 'updateStatus'])->name('order.status.update');
});

Route::prefix('/products')
    ->middleware(['auth', 'seller'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin');
        Route::get('/create', [DashboardController::class, 'create'])->name('product.create');
        Route::post('/store', [DashboardController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [DashboardController::class, 'edit'])->name('product.edit');
        Route::post('/update/{id}', [DashboardController::class, 'update'])->name('product.update');
        Route::post('/delete/{id}', [DashboardController::class, 'destroy'])->name('product.destroy');
    });

Route::prefix('/chat')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/seller', [ChatController::class, 'indexSeller'])->name('chat.seller');
        Route::get('/{id}', [ChatController::class, 'index'])->name('chat');
        Route::get('/room/{id}', [ChatController::class, 'room'])->name('room');
        Route::post('/send/{id}', [ChatController::class, 'send'])->name('send');
    });

Route::prefix('/category')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::post('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

Route::prefix('/seller')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [SellerController::class, 'index'])->name('seller');
        Route::get('/edit/{id}', [SellerController::class, 'edit'])->name('seller.edit');
        Route::post('/update/{id}', [SellerController::class, 'update'])->name('seller.update');
        Route::post('/delete/{id}', [SellerController::class, 'destroy'])->name('seller.destroy');
    });

Route::prefix('/news')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('news');
        Route::get('/create', [NewsController::class, 'create'])->name('news.create');
        Route::post('/store', [NewsController::class, 'store'])->name('news.store');
        Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
        Route::post('/update/{id}', [NewsController::class, 'update'])->name('news.update');
        Route::post('/delete/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
    });
