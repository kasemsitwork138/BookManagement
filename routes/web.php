<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
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
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/dashboard', [BookController::class, 'showinfo']);
Route::get('/edit', [UserController::class, 'showedit'])->name('show.edit');


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

Route::get('/books', [BookController::class, 'showbooklist'])->name('books.index');







