<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_all_books()
    {
        $books = Book::factory(4)->create();

        $response = $this->getJson(route('books.index'));

        $response->assertJsonFragment([
            'title' => $books[0]->title
        ])->assertJsonFragment([
            'title' => $books[1]->title
        ]);
    }

    /** @test */
    public function can_get_one_book()
    {
        $book = Book::factory()->create();

        $response = $this->getJson(route('books.show', $book));

        $response->assertJsonFragment([
            'title' => $book->title
        ]);

    }

    /** @test */
    public function can_create_books()
    {
        $title = 'New book';
        $this->postJson(route('books.store'), [
        ])->assertJsonValidationErrorFor('title');

        $this->postJson(route('books.store'), [
            'title' => $title
        ])->assertJsonFragment([
            'title' => $title
        ]);

        $this->assertDatabaseHas('books', [
            'title' => $title
        ]);
    }

    /** @test */
    public function can_update_on_book()
    {
        $book = Book::factory()->create();
        $title = 'Book updated';

        $this->patchJson(route('books.update', $book), [])
            ->assertJsonValidationErrorFor('title');

        $this->patchJson(route('books.update', $book), [
            'title' => $title
        ])->assertJsonFragment([
            'title' => $title
        ]);

        $this->assertDatabaseHas('books', [
            'title' => $title
        ]);
    }

    /** @test */
    public function can_delete_books()
    {
        $book = Book::factory()->create();

        $this->deleteJson(route('books.destroy', $book))
            ->assertNoContent();

        $this->assertDatabaseCount('books', 0);
    }
}
