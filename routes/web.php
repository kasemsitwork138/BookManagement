<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LendingBookController;
use Illuminate\Support\Facades\Route;

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
    //return view('app');
    return redirect('/login');
});

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/login', [UserController::class, 'showlogin'])->name('show.login');
Route::get('/register', [UserController::class, 'showregister'])->name('show.register');
Route::post('/register', [UserController::class, 'register'])->name('register');

// Protected routes - require authentication
Route::middleware('auth')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [BookController::class, 'showinfo']);
    Route::get('/edit', [UserController::class, 'showedit'])->name('show.edit');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        // Route::get('/create', [UserController::class, 'create'])->name('create');
        // Route::get('/show/{user}', [UserController::class, 'showdesc'])->name('showdesc');
        // Route::post('/', [UserController::class, 'store'])->name('store');
        // Route::get('/{user}', [UserController::class, 'show'])->name('show');
        // Route::get('/{book}/edit', [BookController::class, 'edit'])->name('edit');
        // Route::put('/{book}', [BookController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('books')->name('books.')->group(function () {
        Route::get('/', [BookController::class, 'showbooklist'])->name('index');
        Route::get('/create', [BookController::class, 'create'])->name('create');
        Route::get('/show/{book}', [BookController::class, 'showdesc'])->name('showdesc');
        Route::post('/', [BookController::class, 'store'])->name('store');
        Route::get('/{book}', [BookController::class, 'show'])->name('show');
        Route::get('/{book}/edit', [BookController::class, 'edit'])->name('edit');
        Route::put('/{book}', [BookController::class, 'update'])->name('update');
        Route::delete('/{book}', [BookController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'showcategorylist'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::get('/show/{category}', [CategoryController::class, 'showdesc'])->name('showdesc');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('lendingbooks')->name('lendingbooks.')->group(function () {
        Route::get('/', [LendingBookController::class, 'showlendinglist'])->name('index');
        Route::get('/create', [LendingBookController::class, 'create'])->name('create');
        Route::get('/search', [LendingBookController::class, 'search'])->name('search');
        Route::post('/', [LendingBookController::class, 'store'])->name('store');
        Route::get('/{lendingbook}/edit', [LendingBookController::class, 'edit'])->name('edit');
        Route::delete('/{lendingbook}', [LendingBookController::class, 'destroy'])->name('destroy');
        Route::put('/{lendingbook}', [LendingBookController::class, 'returnBook'])->name('update');
        Route::put('/{id}', [LendingBookController::class, 'returnBook'])->name('return');
    });

    Route::get('/books', [BookController::class, 'showbooklist'])->name('books.index');
});








