<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\PriceController;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 商品画面表示
Route::group(['prefix' => 'items', 'as' => 'item.'], function () {
    Route::get('/', [ItemController::class, 'index'])->name('index');
    Route::get('/add', [ItemController::class, 'add'])->name('get_add');
    Route::post('/add', [ItemController::class, 'add'])->name('post_add');
    Route::get('{item}', [ItemController::class, 'show'])->name('show');
    // Route::get('{item}/edit', [ItemController::class, 'edit'])->name('edit');
    // Route::patch('{item}', [ItemController::class, 'update'])->name('update');
    // Route::delete('{item}', [ItemController::class, 'destroy'])->name('destroy');
});


// 単価画面表示
Route::group(['prefix' => 'prices', 'as' => 'price.'], function () {
    Route::get('index', [PriceController::class, 'index'])->name('index');
    Route::get('create', [PriceController::class, 'create'])->name('create');
    Route::post('/', [PriceController::class, 'store'])->name('store');
    // 確認画面を表示するルートを追加
    Route::get('confirm', [PriceController::class, 'confirm'])->name('confirm');
    // 確認画面からデータを登録するルートを追加
    Route::post('store-confirmed', [PriceController::class, 'storeConfirmed'])->name('storeConfirmed');
    Route::get('{price}', [PriceController::class, 'show'])->name('show');
    Route::get('{price}/edit', [PriceController::class, 'edit'])->name('edit');
    Route::post('{price}/update-confirmed', [PriceController::class, 'updateConfirmed'])->name('updateConfirmed'); // 編集確認画面を表示
    Route::patch('{price}', [PriceController::class, 'update'])->name('update');
    Route::delete('{price}', [PriceController::class, 'destroy'])->name('destroy');
});


// 見積作成画面表示
Route::group(['prefix' => 'quotes', 'as' => 'quote.'], function () {
    Route::get('index', [QuoteController::class, 'index'])->name('index');
    Route::get('ambiguousSearch', [QuoteController::class, 'ambiguousSearch'])->name('ambiguousSearch');
    Route::get('advancedSearch', [QuoteController::class, 'advancedSearch'])->name('advancedSearch');
    Route::get('create', [QuoteController::class, 'create'])->name('create');
    Route::post('/', [QuoteController::class, 'store'])->name('store');
    // 確認画面を表示するルートを追加
    Route::get('confirm', [QuoteController::class, 'confirm'])->name('confirm');
    // 確認画面からデータを登録するルートを追加
    Route::post('store-confirmed', [QuoteController::class, 'storeConfirmed'])->name('storeConfirmed');
    // Route::get('{quote}', [QuoteController::class, 'show'])->name('show');
    // Route::get('{quote}/edit', [QuoteController::class, 'edit'])->name('edit');
    // Route::patch('{quote}', [QuoteController::class, 'update'])->name('update');
    // Route::delete('{quote}', [QuoteController::class, 'destroy'])->name('destroy');
});

// 発注作成画面表示
Route::group(['prefix' => 'orders', 'as' => 'order.'], function () {
    Route::get('index', [PriceController::class, 'index'])->name('index');
    Route::get('create', [PriceController::class, 'create'])->name('create');
    Route::post('/', [PriceController::class, 'store'])->name('store');
    // 確認画面を表示するルートを追加
    // Route::get('confirm', [PriceController::class, 'confirm'])->name('confirm');
    // 確認画面からデータを登録するルートを追加
    // Route::post('store-confirmed', [PriceController::class, 'storeConfirmed'])->name('storeConfirmed');
    Route::get('{price}', [PriceController::class, 'show'])->name('show');
    Route::get('{price}/edit', [PriceController::class, 'edit'])->name('edit');
    // Route::post('{price}/update-confirmed', [PriceController::class, 'updateConfirmed'])->name('updateConfirmed'); // 編集確認画面を表示
    Route::patch('{price}', [PriceController::class, 'update'])->name('update');
    Route::delete('{price}', [PriceController::class, 'destroy'])->name('destroy');
});
