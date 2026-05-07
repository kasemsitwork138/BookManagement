<?php

use App\Http\Controllers\api\AuthenController;
use App\Http\Controllers\api\BookController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\LendingBookController;
use App\Http\Controllers\api\UserController;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthenController::class, 'login'])->name('api.login')->middleware('throttle:5,1');
// Route::middleware('auth:sanctum')->group(function () {


Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'indexApi'])->name('index');
    Route::get('/{user}', [UserController::class, 'showApi'])->name('show');
    Route::delete('/{user}', [UserController::class , 'destroy'])->name('delete');
});

Route::prefix('books')->name('books.')->group(function () {
    Route::get('/', [BookController::class, 'indexApi'])->name('index');
    Route::get('/showinfo', [BookController::class , 'showinfo']);
    Route::get('/search', [BookController::class , 'showbooklist']);
    Route::post('/', [BookController::class, 'storeApi'])->name('store');
    Route::get('/{book}', [BookController::class, 'showApi'])->name('show');
    Route::put('/{book}', [BookController::class, 'updateApi'])->name('update');
    Route::delete('/{book}', [BookController::class, 'destroyApi'])->name('destroy');
});

Route::prefix('category')->name('category.')->group(function () {
    Route::get('/', [CategoryController::class, 'indexApi'])->name('index');
    Route::post('/', [CategoryController::class, 'storeApi'])->name('store');
    Route::get('/{category}', [CategoryController::class, 'showApi'])->name('show');
    Route::put('/{category}', [CategoryController::class, 'updateApi'])->name('update');
    Route::delete('/{category}', [CategoryController::class, 'destroyApi'])->name('destroy');
});

Route::prefix('lendingbooks')->name('lendingbooks.')->group(function () {
    Route::get('/', [LendingBookController::class, 'indexApi'])->name('index');
    Route::post('/', [LendingBookController::class, 'storeApi'])->name('store');
    Route::get('/{lendingBook}', [LendingBookController::class, 'showApi'])->name('show');
    Route::put('/{lendingBook}', [LendingBookController::class, 'updateApi'])->name('update');
    Route::delete('/{lendingBook}', [LendingBookController::class, 'destroyApi'])->name('destroy');
});

// });
