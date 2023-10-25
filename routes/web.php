<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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


// 通常の認証ルート（ログイン、ホームなど）
Auth::routes();

// 認証済みユーザー向けのルート
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 認証済みユーザー向けのルート
Route::middleware(['auth'])->group(function () {
  Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // 管理用ユーザー画面（ミドルウェア制限あり）
    Route::middleware(['auth', 'can:admin'])->group(function () {
      Route::group(['prefix' => 'profiles', 'as' => 'profile.'], function () {
        Route::get('index', [ProfileController::class, 'index'])->name('index');
        Route::get('show/{user}', [ProfileController::class, 'show'])->name('show');
        Route::get('edit/{user}', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('update/{user}',[ProfileController::class, 'update'])->name('update');
        // Route::delete('destroy/{user}', [ProfileController::class, 'destroy'])->name('destroy');
      });
    });

    // 権限付与ルート（ミドルウェア制限あり）
    Route::middleware(['auth', 'can:admin'])->group(function () {
      Route::group(['prefix' => 'roles', 'as' => 'role.'], function () {
        Route::patch('{user}/attach', [RoleController::class, 'attach'])->name('attach');
        Route::patch('{user}/detach', [RoleController::class, 'detach'])->name('detach');
      });
    });

    // ユーザー画面
    Route::group(['prefix' => 'users', 'as' => 'user.'], function () {
      Route::get('show', [UserController::class, 'show'])->name('show');
      Route::get('edit', [UserController::class, 'edit'])->name('edit');
      Route::get('passwordEdit', [UserController::class, 'passwordEdit'])->name('passwordEdit');
      Route::patch('update', [UserController::class, 'update'])->name('update');
      Route::patch('passwordUpdate', [UserController::class, 'passwordUpdate'])->name('passwordUpdate');
      // Route::delete('destroy', [UserController::class, 'destroy'])->name('destroy');
    });

    // 商品画面（ミドルウェア制限あり）
    Route::middleware(['auth', 'can:admin'])->group(function () {
      Route::group(['prefix' => 'items', 'as' => 'item.'], function () {
        Route::get('index', [ItemController::class, 'index'])->name('index');
        Route::get('create', [ItemController::class, 'create'])->name('create');
        Route::get('confirm', [ItemController::class, 'confirm'])->name('confirm');
        Route::get('editConfirm', [ItemController::class, 'editConfirm'])->name('editConfirm');
        Route::post('store', [ItemController::class, 'store'])->name('store');
        Route::get('show/{item}', [ItemController::class, 'show'])->name('show');
        Route::get('edit/{item}', [ItemController::class, 'edit'])->name('edit');
        Route::patch('update/{item}', [ItemController::class, 'update'])->name('update');
        Route::delete('destroy/{item}', [ItemController::class, 'destroy'])->name('destroy');
      });
    });

    // 単価画面
    Route::group(['prefix' => 'prices', 'as' => 'price.'], function () {
      Route::get('index', [PriceController::class, 'index'])->name('index');
      Route::get('create', [PriceController::class, 'create'])->name('create');
      Route::post('store', [PriceController::class, 'store'])->name('store');
      Route::get('confirm', [PriceController::class, 'confirm'])->name('confirm');
      Route::get('show/{price}', [PriceController::class, 'show'])->middleware('can:view,price')->name('show');
      Route::get('edit/{price}', [PriceController::class, 'edit'])->name('edit');
      Route::get('editConfirm/{price}', [PriceController::class, 'editConfirm'])->name('editConfirm');
      Route::patch('update/{price}', [PriceController::class, 'update'])->name('update');
      Route::delete('destroy/{price}', [PriceController::class, 'destroy'])->name('destroy');
    });

    // 見積作成画面
    Route::group(['prefix' => 'quotes', 'as' => 'quote.'], function () {
      Route::get('index', [QuoteController::class, 'index'])->name('index');
      Route::get('ambiguousSearch', [QuoteController::class, 'ambiguousSearch'])->name('ambiguousSearch');
      Route::get('advancedSearch', [QuoteController::class, 'advancedSearch'])->name('advancedSearch');
      Route::get('create', [QuoteController::class, 'create'])->name('create');
      Route::get('confirm', [QuoteController::class, 'confirm'])->name('confirm');
      Route::post('store', [QuoteController::class, 'store'])->name('store');
      Route::get('show/{quote}', [QuoteController::class, 'show'])->middleware('can:view,quote')->name('show');
      // Route::get('edit/{quote}', [QuoteController::class, 'edit'])->name('edit');
      // Route::patch('update/{quote}', [QuoteController::class, 'update'])->name('update');
      // Route::delete('destroy/{quote}', [QuoteController::class, 'destroy'])->name('destroy');
    });

    // 発注画面
    Route::group(['prefix' => 'orders', 'as' => 'order.'], function () {
      Route::get('index', [OrderController::class, 'index'])->name('index');
      Route::get('create/{price}', [OrderController::class, 'create'])->name('create');
      Route::get('quoteCreate/{quote}', [OrderController::class, 'quoteCreate'])->name('quoteCreate');
      Route::get('confirm', [OrderController::class, 'confirm'])->name('confirm');
      Route::get('quoteConfirm', [OrderController::class, 'quoteConfirm'])->name('quoteConfirm');
      Route::post('store', [OrderController::class, 'store'])->name('store');
      Route::post('quoteStore', [OrderController::class, 'quoteStore'])->name('quoteStore');
      Route::get('{order}', [OrderController::class, 'show'])->middleware('can:view,order')->name('show');
      // Route::get('edit/{order}', [OrderController::class, 'edit'])->name('edit');
      // Route::patch('update/{order}', [OrderController::class, 'update'])->name('update');
      // Route::delete('destroy/{order}', [OrderController::class, 'destroy'])->name('destroy');
    });

});