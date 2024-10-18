<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\ApiJsonResource;
use App\Http\Resources\ApiPaginatedResponse;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books = Book::query()->paginate(request('length'));

        return new ApiPaginatedResponse($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        //
        $book = Book::create($request->validated());

        return new ApiJsonResource(
            data: $book,
            message: 'Book created successfully',
            status: 201,
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
        return new ApiJsonResource($book->load('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
        //
        $book->update($request->validated());
        $book->refresh();

        return new ApiJsonResource($book, 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
        $book->delete();
        return new ApiJsonResource($book, 'Book deleted successfully');
    }
}
