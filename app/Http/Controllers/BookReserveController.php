<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\Book;
use App\Models\BookReservation;

/**
 * Controlador responsável pela busca, edição, criação e cancelamento de reservas de Livros
 *
 * @package App\Http\Controllers
 */
class BookReserveController extends Controller
{
    /**
     * Exibe uma tela com a lista todas as reservas feitas pelo usuário
     *
     * @return View
     */
    public function getBookReservations(Request $request): View
    {   
        $reserves = BookReservation::with(['book', 'user'])->where('user_id', auth()->User()->id);

        // Filtros
        if ($request->search) {
            $books = $books->whereHas('book', function ($query) use($request) {
                $query->where('title', 'LIKE', "%{$request->search}%");
                $query->orWhere('author', 'LIKE', "%{$request->search}%");
                $query->orWhere('isbn', 'LIKE', "%{$request->search}%");
            });
        }

        return view('dashboard/reserves', [
            'reserves' => $reserves->get()
        ]);
    }

     /**
     * Interação do usuário, cria uma reserva
     *
     * @return RedirectResponse
     */
    public function postReserveBook($bookId) : RedirectResponse 
    {
		$book = Book::findOrFail($bookId);
        if ($book->quantity_available > 0) {
            $book->quantity_available--;
            $book->save();

            $reservation = new BookReservation;
            $reservation->user_id  = auth()->User()->id;
            $reservation->book_id  = $book->id;
            $reservation->save();
        }

        return redirect()->back();
	}

      /**
     * Interação do usuário, cancela uma reserva
     *
     * @return RedirectResponse
     */
    public function postCancelReserve($reserveId) : RedirectResponse 
    {
		$reserve = BookReservation::findOrFail($reserveId);

        // Atualiza valor de quantidade disponível
        $book = Book::find($reserve->book_id);
        $book->quantity_available++;
        $book->save();

        // Excluí reserva
        $reserve->delete();

        return redirect()->back();
	}
}
