<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuoteController;


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
Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
});

// 見積作成画面表示
Route::group(['prefix' => 'quotes', 'as' => 'quote.'], function () {
    // Route::get('index', [QuoteController::class, 'index'])->name('index');
    Route::get('create', [QuoteController::class, 'create'])->name('create');
    Route::post('/', [QuoteController::class, 'store'])->name('store');
    // Route::get('{quote}', [QuoteController::class, 'show'])->name('show');
    // Route::get('{quote}/edit', [QuoteController::class, 'edit'])->name('edit');
    // Route::patch('{quote}', [QuoteController::class, 'update'])->name('update');
    // Route::delete('{quote}', [QuoteController::class, 'destroy'])->name('destroy');

    // 確認画面を表示するルートを追加
    Route::get('confirm', [QuoteController::class, 'confirm'])->name('confirm');

    // 確認画面からデータを登録するルートを追加
    Route::post('store-confirmed', [QuoteController::class, 'storeConfirmed'])->name('storeConfirmed');

});

Route::get('quotes/index', [QuoteController::class, 'index'])->name('quote.index');
Route::get('quotes/advancedSearch', [QuoteController::class, 'advancedSearch'])->name('quote.advancedSearch');
