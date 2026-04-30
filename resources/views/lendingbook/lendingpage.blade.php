@extends('layouts.master')

@section('content')
    <div class="container">
        <h2 class="mb-4">เพิ่มรายการยืมหนังสือ</h2>

        <form method="POST" action="{{ route('lendingbooks.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- <div class="mb-3">
            <label>ชื่อหนังสือ</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}">
        </div>

        <div class="mb-3">
            <label>ผู้แต่ง</label>
            <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}">
        </div>

        <div class="mb-3">
            <label>ปีที่พิมพ์</label>
            <input type="date" name="published_date" class="form-control"
                value="{{ old('published_date', $book->published_date) }}">
        </div> --}}

            <div class="mb-3">
                <label>เลือกผู้ยืม</label>
                <select name="user_id" class="form-control">
                    <option value="">เลือกผู้ยืม</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            {{ old('user_id', $lendingBook->user_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>เลือกหนังสือ</label>
                <select name="book_id" class="form-control">
                    <option value="">เลือกหนังสือ</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}"
                            {{ old('book_id', $lendingBook->book_id) == $book->id ? 'selected' : '' }}>
                            {{ $book->title }}
                        </option>
                    @endforeach
                </select>
            </div>



            <div class="mb-3">
                <label>วันที่ยืม</label>
                <input type="date" name="lending_date" class="form-control"
                    value="{{ old('lending_date', $lendingBook->lending_date) }}">
            </div>
            <div class="mb-3">
                <label>วันที่คืน</label>
                <input type="date" name="return_date" class="form-control"
                    value="{{ old('return_date', $lendingBook->return_date) }}">
            </div>


            {{-- <div class="mb-3">
                <label>อัปโหลดปกหนังสือ</label>
                <input type="file" name="cover_image" class="form-control">
            </div> --}}

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">บันทึก</button>
                <a href="{{ route('lendingbooks.index') }}" class="btn btn-secondary">ยกเลิก</a>
            </div>
        </form>
    </div>
@endsection
