<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function indexApi()
    {
        $books = Book::with('category')->get();
        $books->transform(function ($book) {
            $book->cover_image = $book->cover_image
                ? asset('storage/' . $book->cover_image)
                : null;

            return $book;
        });
        return response()->json($books);
    }

    public function showApi(Book $book)
    {
        $book->load('category');
        $book->cover_image = $book->cover_image
            ? asset('storage/' . $book->cover_image)
            : null;

        return response()->json($book);
    }

    public function storeApi(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'published_date' => 'required|date',
            'category_id' => 'nullable|exists:category,id',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $book = Book::create($validated);

        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('covers', 'public');
            $book->update(['cover_image' => $imagePath]);
        }

        Log::info('Created book: ' . $validated['title']);

        return response()->json(['message' => 'Created successfully', 'book' => $book], 201);
    }

    public function updateApi(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'published_date' => 'required|date',
            'category_id' => 'nullable|exists:category,id',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('covers', 'public');
            $validated['cover_image'] = $imagePath;
        }

        $book->update($validated);

        return response()->json(['message' => 'Updated successfully', 'book' => $book]);
    }

    public function destroyApi(Book $book)
    {
        $book->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }

    public function showinfo()
    {
        $books_total = Book::count();
        $books_lend  = Book::where('is_lend', true)->count();
        $user_total = User::count();

        return response()->json([
            'books_total' => $books_total,
            'books_lend' => $books_lend,
            'user_total' => $user_total,
        ]);
    }
}
