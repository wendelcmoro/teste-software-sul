<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\BookReservation;

class BookTest extends TestCase
{
    // Criação de um livro
    public function test_book_creation()
    {
        $book = Book::factory()->create();

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
        ]);
    }

    // Acesso à listagem de livros como usuário comum
    public function test_book_listing_rendering(): void
    {
        $user = User::factory()->user()->create();

        $response = $this
            ->actingAs($user)
            ->get('/book-listing');

        $response->assertOk();
    }

    // Acesso à listagem de livros como usuário ADMIN
    public function test_book_listing_admin_rendering(): void
    {
        $user = User::factory()->admin()->create();

        $response = $this
            ->actingAs($user)
            ->get('/book-listing');

        $response->assertOk();
    }

    // Atualização de info de livro pela rota
    public function test_book_information_can_be_updated(): void
    {
        $user = User::factory()->admin()->create();
        auth()->guard('admin')->login($user);
        auth()->guard('web')->login($user);
            
        $this->assertTrue(auth()->check());

        $book = Book::factory()->create();        
        $response = $this->actingAs($user)->post(route('books.edit-book', $book->id), [
                'title'              => 'test',
                'author'             => 'test',
                'description'        => 'akosdkoadosa',
                'isbn'               => '1234567890123',
                'quantity_available' => 15,
        ]);

        $response
            ->assertSessionHasNoErrors()
                ->assertRedirect('/book-listing');

        $book->refresh();

        $this->assertSame('test', $book->title);
        $this->assertSame('test', $book->author);
        $this->assertSame('akosdkoadosa', $book->description);
        $this->assertSame('1234567890123', $book->isbn);
        $this->assertSame(15, $book->quantity_available);
    }
    
    // Criação de livro pela rota
    public function test_book_information_can_be_created(): void
    {
        $user = User::factory()->admin()->create();
        auth()->guard('admin')->login($user);
        auth()->guard('web')->login($user);
            
        $this->assertTrue(auth()->check());

        $response = $this->actingAs($user)->post(route('books.edit-book'), [
                'title'              => 'test2',
                'author'             => 'test2',
                'description'        => 'akosdkoadosaadasdasd',
                'isbn'               => '1234567890124',
                'quantity_available' => 15,
        ]);

        $response
            ->assertSessionHasNoErrors()
                ->assertRedirect('/book-listing');

        $this->assertDatabaseHas('books', [
            'title'              => 'test2',
            'author'             => 'test2',
            'description'        => 'akosdkoadosaadasdasd',
            'isbn'               => '1234567890124',
            'quantity_available' => 15,
        ]);
    }

    // Exclusão de Livro pela rota
    public function test_book_information_can_be_deleted(): void
    {
        $user = User::factory()->admin()->create();
        auth()->guard('admin')->login($user);
        auth()->guard('web')->login($user);
            
        $this->assertTrue(auth()->check());

        $book = Book::factory()->create();
        $response = $this->actingAs($user)->post(route('books.delete-book', [$book->id]));

        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
    }
}
