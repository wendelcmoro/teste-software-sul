<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookReserveController;


Route::get('/', function () {
    return view('auth/login');
});

Route::get('/register',  [RegisteredUserController::class, 'create'])->name('register');;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas - Livros
    Route::get('/book-listing', [BookController::class, 'getBooks'])->name('books.book-listing');
    
    // Rotas - Reserva de Livros
    Route::get('/reserve-listing', [BookReserveController::class, 'getBookReservations'])->name('reserves.reserve-listing');
    Route::post('/reserve-book/{book_id}', [BookReserveController::class, 'postReserveBook'])->name('reserves.reserve-book');
    Route::post('/delete-reserve/{reserve_id}', [BookReserveController::class, 'postCancelReserve'])->name('reserves.cancel-reserve');

    // Rotas descritas a partir daqui são apenas acessíveis por ADMINs
    Route::middleware('auth:admin')->group(
        function() {
            // Rotas - Livros
            Route::get('/edit-book/{book_id?}', [BookController::class, 'getEditBook'])->name('books.edit-book');
            Route::post('/edit-book/{book_id?}', [BookController::class, 'postStoreBook'])->name('books.edit-book');
            Route::post('/delete/{book_id?}', [BookController::class, 'postDeleteBook'])->name('books.delete-book');
        }
    );
});

require __DIR__.'/auth.php';
