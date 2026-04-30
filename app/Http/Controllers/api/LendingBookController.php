<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\LendingBook;
use Illuminate\Http\Request;

class LendingBookController extends Controller
{
    public function indexApi()
    {
        $lendings = LendingBook::with(['book', 'user'])->get();
        return response()->json($lendings);
    }

    public function showApi(LendingBook $lendingBook)
    {
        $lendingBook->load(['book', 'user']);
        return response()->json($lendingBook);
    }

    public function storeApi(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $lending = LendingBook::create(array_merge($validated, ['status' => 'borrowed']));
        Book::where('id', $validated['book_id'])->update(['is_lend' => true]);

        return response()->json(['message' => 'Created successfully', 'lending' => $lending], 201);
    }

    public function updateApi(Request $request, LendingBook $lendingBook)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'nullable|string',
        ]);

        if ($request->filled('status') && $request->status === 'returned') {
            Book::where('id', $lendingBook->book_id)->update(['is_lend' => false]);
        }

        $lendingBook->update($validated);

        return response()->json(['message' => 'Updated successfully', 'lending' => $lendingBook]);
    }

    public function destroyApi(LendingBook $lendingBook)
    {
        if ($lendingBook->status === 'borrowed') {
            Book::where('id', $lendingBook->book_id)->update(['is_lend' => false]);
        }

        $lendingBook->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
