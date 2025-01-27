<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\BookReservation;

class BookReservationTest extends TestCase
{
    public function test_book_reservations()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();
        $booksReservation = BookReservation::create([
                                                'user_id' => $user->id, 
                                                'book_id' => $book->id]
                                            );
    
        $this->assertDatabaseHas('book_reservations', [
            'id' => $booksReservation->id,
            'user_id' => $user->id,
            'book_id' => $book->id,
        ]);
    }

    // Reserva de livro pela rota
    public function test_book_reservation(): void
    {
        $user = User::factory()->admin()->create();
        auth()->guard('web')->login($user);
            
        $this->assertTrue(auth()->check());

        $book = Book::factory()->create();
        $response = $this->actingAs($user)->post(route('reserves.reserve-book', [$book->id]));

        $this->assertDatabaseHas('book_reservations', [
            'book_id' => $book->id,
            'user_id' => $user->id,
        ]);
    }

     // Cancelamento de reserta pela rota
     public function test_book_reservation_cancelation(): void
     {
         $user = User::factory()->admin()->create();
         auth()->guard('web')->login($user);
             
         $this->assertTrue(auth()->check());
 
         $book = Book::factory()->create();
         $booksReservation = BookReservation::create([
            'user_id' => $user->id, 
            'book_id' => $book->id]
        );
         $response = $this->actingAs($user)->post(route('reserves.cancel-reserve', [$booksReservation->id]));
 
         $this->assertDatabaseMissing('book_reservations', [
             'id' => $booksReservation->id,
         ]);
     }
}
