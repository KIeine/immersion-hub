<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBookRequest;
use App\Models\Book;

class BooksSubmitController extends Controller
{
    public function index()
    {
        $formatOptions = [
            ['value' => null, 'name' => 'Select a format'],
            ['value' => 'light_novel', 'name' => 'Light Novel'],
            ['value' => 'novel', 'name' => 'Novel'],
            ['value' => 'audiobook', 'name' => 'Audiobook'],
            ['value' => 'other', 'name' => 'Other'],
        ];

        return inertia('BooksNewIndex', [
            'formatOptions' => $formatOptions,
        ]);
    }

    public function create(AddBookRequest $request)
    {
        $validated = $request->validated();
        $validated['published_at'] = date('Y-m-d H:i:s', strtotime($validated['published_at']));

        $book = Book::create($validated);

        return redirect()->route('app.books.show', [$book->id]);
    }
}
