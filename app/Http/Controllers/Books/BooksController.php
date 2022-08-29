<?php

namespace App\Http\Controllers\Books;

use Validator;
use Carbon\Carbon;
use App\Models\Books;
use Illuminate\Http\Request;
use App\Http\Resources\BooksResource;
use App\Http\Controllers\BaseController;

class BooksController extends BaseController
{
    /**
     * Display list of all books resources
     *
     * @return \Illuminate\Http\Response
     */
    public function listBooks() {
        $books = Books::with('rented')->get();

        return $this->sendResponse(BooksResource::collection($books), 'Books retrieved successfully.');
    }

    /**
     * Get a book resources
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getBook($id) {
        $book = Books::where('id', $id)->with('rented')->firstOrFail();

        return $this->sendResponse(new BooksResource($book), 'Book data retrieved successfully.');
    }

    /**
     * Create a new book resource in storage
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'author' => 'required|string',
            'category' => 'nullable|string',
            'color' => 'nullable|string',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $input = $request->all();
        $book = Books::create($input);

        return $this->sendResponse(new BooksResource($book), 'Book created successfully.', 201);
    }

    /**
     * Update a book resource in storage
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Books $book, $id) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'author' => 'required|string',
            'category' => 'nullable|string',
            'color' => 'nullable|string',
            'is_rented' => 'nullable|boolean',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $input = $request->all();
        $book = Books::find($id);

        $book->title = $input['title'];
        $book->description = $input['description'];
        $book->author = $input['author'];
        $book->category = $input['category'] ? $input['category'] : $book->category;
        $book->color = $input['color'] ? $input['color'] : $book->color;
        $book->is_rented = $input['is_rented'] ? $input['is_rented'] : $book->is_rented;
        $book->updated_at = Carbon::now();
        $book->save();

        return $this->sendResponse(new BooksResource($book), 'Book updated successfully.');
    }

    /**
     * Remove the specified book resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Books $book, $id)
    {
        $book::where('id', $id)->delete();

        return $this->sendResponse([], 'Book deleted successfully.');
    }
}
