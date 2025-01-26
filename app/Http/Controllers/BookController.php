<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\Book;

class BookController extends Controller
{
    public function getBooks(Request $request): View
    {   
        $books = Book::query();

        // Filtros
        if ($request->search) {
            $books = $books->where(function ($query) use($request) {
                $query->where('title', 'LIKE', "%{$request->search}%");
                $query->orWhere('author', 'LIKE', "%{$request->search}%");
                $query->orWhere('isbn', 'LIKE', "%{$request->search}%");
            });
        }

        return view('dashboard/books', [
            'books' => $books->get()
        ]);
    }

    public function getEditBook($bookId = null): View
    {   
        $request->validate(
			[
				'title'              => 'required|max:255',
				'author'             => 'required|max:255',
				'description'        => 'required|max:255',
				'isbn'               => 'required|max:13',
				'quantity_available' => 'required|integer',
			]
		);

        return view(
            'books/edit-book',
            [
                'book'   => Book::find($bookId),
            ]
        );
    }

    public function postStoreBook(Request $request, $bookId = null) : RedirectResponse 
    {
		$book = Book::find($bookId);

        if (!$book) {
            $book = new Book;
        }
		$book->title              = $request->title;
		$book->author             = $request->author;
		$book->description        = $request->description;
		$book->isbn               = $request->isbn;
		$book->quantity_available = $request->quantity_available;
        $book->save();

		return redirect()->route('books.book-listing');
	}
}
