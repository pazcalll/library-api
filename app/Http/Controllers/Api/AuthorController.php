<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Http\Resources\ApiJsonResource;
use App\Http\Resources\ApiPaginatedResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $authors = Author::query()->paginate(request('length'));

        return new ApiPaginatedResource($authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request)
    {
        //
        $author = Author::create($request->validated());

        return new ApiJsonResource(
            data: $author,
            message: 'Author created successfully',
            status: 201,
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
        return new ApiJsonResource($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorRequest $request, Author $author)
    {
        //
        $author->update($request->validated());
        $author->refresh();

        return new ApiJsonResource($author, 'Author updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        //
        $author->delete();

        return new ApiJsonResource($author, 'Author deleted successfully');
    }

    public function books(Author $author)
    {
        $books = $author->books()->paginate(request('length'));

        return new ApiPaginatedResource($books);
    }
}
