<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    public function index()
    {
        return Book::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Book
     */
    public function store(Request $request): Book
    {
        $request->validate([
           'title'=>'required'
        ]);
        $book = new Book;
        $book->title = $request->get('title');
        $book->save();

        return $book;
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return Book
     */
    public function show(Book $book): Book
    {
        return $book;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Book $book
     * @return Book
     */
    public function update(Request $request, Book $book): Book
    {
        $request->validate([
            'title'=>'required'
        ]);
        $book->title = $request->get('title');
        $book->save();

        return $book;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->noContent();
    }
}
