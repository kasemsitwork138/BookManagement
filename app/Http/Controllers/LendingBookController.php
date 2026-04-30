<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\LendingBook;
use App\Models\User;
use Illuminate\Http\Request;

class LendingBookController extends Controller
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
        $lendingBook = new LendingBook();

        $users = User::whereDoesntHave('lendings', function ($q) {
            $q->where('status', 'borrowed');
        })->get();

        $books = Book::whereDoesntHave('lendings', function ($q) {
            $q->where('status', 'borrowed');
        })->get();

        return view('lendingbook.lendingpage', compact('lendingBook', 'users', 'books'));
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
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'lending_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:lending_date',
        ]);

        LendingBook::create([
            'user_id' => $validated['user_id'],
            'book_id' => $validated['book_id'],
            'start_date' => $validated['lending_date'],
            'end_date' => $validated['return_date'],
            'status' => 'borrowed',
        ]);

        // Mark the book as lent
        Book::where('id', $validated['book_id'])->update(['is_lend' => true]);

        return redirect()->route('lendingbooks.index')->with('success', 'Created successfully');
    }
    public function showlendinglist()
    {
        $lendingBooks = LendingBook::with(['book', 'user'])->get();

        return view('lendingbook.lendinglist', compact('lendingBooks'));
    }
    public function returnBook($id)
    {
        $lendingBook = LendingBook::findOrFail($id);

        $lendingBook->update([
            'status' => 'returned',
            'end_date' => now(),
        ]);

        // Mark the book as not lent
        Book::where('id', $lendingBook->book_id)->update(['is_lend' => false]);

        return redirect()->route('lendingbooks.index')->with('success', 'Returned successfully');
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $lendingBooks = LendingBook::with(['book', 'user'])
            ->whereHas('book', function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%');
            })
            ->get();

        return view('lendingbook.lendinglist', compact('lendingBooks'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LendingBook  $lendingBook
     * @return \Illuminate\Http\Response
     */
    public function show(LendingBook $lendingBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LendingBook  $lendingBook
     * @return \Illuminate\Http\Response
     */
    public function edit(LendingBook $lendingBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LendingBook  $lendingBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LendingBook $lendingBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LendingBook  $lendingBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(LendingBook $lendingbook)
    {
        // if ($lendingbook->status === 'borrowed') {
        //     Book::where('id', $lendingbook->book_id)->update(['is_lend' => false]);
        // }

        $lendingbook->delete();

        return redirect()->route('lendingbooks.index')->with('success', 'Deleted');
    }
}
