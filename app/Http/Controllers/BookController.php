<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\Book;

/**
 * Controlador responsável pela busca, edição, criação e exclusão de livros
 *
 * @package App\Http\Controllers
 */
class BookController extends Controller
{
    /**
     * Exibe uma tela com a listagem de  todos os livros cadastrados
     *
     * @return View
     */
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


    /**
     * Acessa página de edição de um livro
     *
     * @return View
     */
    public function getEditBook(Request $request, $bookId = null): View
    {   
        return view(
            'books/edit-book',
            [
                'book'   => Book::find($bookId),
            ]
        );
    }

    /**
     * Salva/Edita um livro
     *
     * @return RedirectResponse
     */
    public function postStoreBook(Request $request, $bookId = null) : RedirectResponse 
    {
		$book = Book::find($bookId);

        $request->validate(
			[
				'title'              => 'required|max:255',
				'author'             => 'required|max:255',
				'description'        => 'required|max:255',
				'isbn'               => 'required|digits:13',
				'quantity_available' => 'required|integer',
			]
		);

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

     /**
     * Exclui um livro
     *
     * @return RedirectResponse
     */
    public function postDeleteBook($bookId) : RedirectResponse 
    {
		$book = Book::findOrFail($bookId);
        $book->delete();

		return redirect()->back();
	}
}
