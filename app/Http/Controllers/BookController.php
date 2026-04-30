<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('books.create' , compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'published_date' => 'required',
            'category_id' => 'nullable|exists:category,id',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $book = Book::create($validated);

        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('covers', 'public');
            $book->update(['cover_image' => $imagePath]);
        }

        Log::info('Created book: ' . $validated['title']);

        return redirect('/books')->with('success', 'Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book) {}

    public function showinfo()
    {
        $books_total = Book::count();
        $books_lend  = Book::where('is_lend', true)->count();
        $user_total = User::count();

        Log::info('Books total: ' . $books_total);
        Log::info('Books lend: ' . $books_lend);
        Log::info('User total: ' . $user_total);

        return view('dashboard', compact('books_total', 'books_lend', 'user_total'));
    }

    public function showbooklist(Request $request)
    {
        $query = Book::query();
        $category = Category::all();


        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $books = $query->get();

        return view('books.booklist', compact('books', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $category = Category::all();
        Log::info('Editing book: ' . $book->title);


        return view('books.edit', compact('book' , 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
public function update(Request $request, Book $book)
{
    $validated = $request->validate([
        'title' => 'required',
        'author' => 'required',
        'published_date' => 'required',
        'category_id' => 'nullable|exists:category,id',
    ]);

    // ถ้ามีไฟล์ใหม่ค่อยอัปเดต
    if ($request->hasFile('cover_image')) {
        $imagePath = $request->file('cover_image')->store('covers', 'public');
        $validated['cover_image'] = $imagePath;
    }

    $book->update($validated);

    Log::info('Updated book: ' . $book->title);

    return redirect('/books')->with('success', 'Updated successfully');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        Log::info('Deleting book: ' . $book->title);

        $book->delete();

        return redirect('/books')->with('success', 'Deleted successfully');
    }
    public function showdesc(Book $book)
    {
        Log::info('Showing description for book: ' . $book->title);

        $book = Book::find($book->id);


        return view('books.bookdesc', compact('book'));
    }


        public function storeApi(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'published_date' => 'required',
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

}
