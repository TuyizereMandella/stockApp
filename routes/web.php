<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockinpurchaseController;
use App\Http\Controllers\StockoutController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
Route::post('/login', [AdminController::class, 'login']);
Route::get('/signup', [AdminController::class, 'showSignup']);
Route::post('/signup', [AdminController::class, 'signup']);
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

Route::middleware('auth.admin')->group(function () {
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
    Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

    Route::get('/stockinpurchases', [StockinpurchaseController::class, 'index'])->name('stockinpurchases.index');
    Route::get('/stockinpurchases/create', [StockinpurchaseController::class, 'create'])->name('stockinpurchases.create');
    Route::post('/stockinpurchases', [StockinpurchaseController::class, 'store'])->name('stockinpurchases.store');
    Route::get('/stockinpurchases/{stockinpurchase}', [StockinpurchaseController::class, 'show'])->name('stockinpurchases.show');
    Route::get('/stockinpurchases/{stockinpurchase}/edit', [StockinpurchaseController::class, 'edit'])->name('stockinpurchases.edit');
    Route::put('/stockinpurchases/{stockinpurchase}', [StockinpurchaseController::class, 'update'])->name('stockinpurchases.update');
    Route::delete('/stockinpurchases/{stockinpurchase}', [StockinpurchaseController::class, 'destroy'])->name('stockinpurchases.destroy');

    Route::get('/stockouts', [StockoutController::class, 'index'])->name('stockouts.index');
    Route::get('/stockouts/create', [StockoutController::class, 'create'])->name('stockouts.create');
    Route::post('/stockouts', [StockoutController::class, 'store'])->name('stockouts.store');
    Route::get('/stockouts/{stockout}', [StockoutController::class, 'show'])->name('stockouts.show');
    Route::get('/stockouts/{stockout}/edit', [StockoutController::class, 'edit'])->name('stockouts.edit');
    Route::put('/stockouts/{stockout}', [StockoutController::class, 'update'])->name('stockouts.update');
    Route::delete('/stockouts/{stockout}', [StockoutController::class, 'destroy'])->name('stockouts.destroy');
});

Route::get('/', function () {
    return redirect('/login');
});