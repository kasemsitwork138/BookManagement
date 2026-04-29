@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">แก้ไขหนังสือ</h2>

    <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
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
        </div>

        <div class="mb-3">
            <label>หมวดหมู่</label>
            <select name="category" class="form-control">
                <option value="นิยาย" {{ $book->category == 'นิยาย' ? 'selected' : '' }}>นิยาย</option>
                <option value="ความรู้" {{ $book->category == 'ความรู้' ? 'selected' : '' }}>ความรู้</option>
                <option value="การ์ตูน" {{ $book->category == 'การ์ตูน' ? 'selected' : '' }}>การ์ตูน</option>
                <option value="เทคโนโลยี" {{ $book->category == 'เทคโนโลยี' ? 'selected' : '' }}>เทคโนโลยี</option>
            </select>
        </div>
                <div class="mb-3">
            <label>อัปโหลดปกหนังสือ</label>
            <input type="file" name="cover_image" class="form-control">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">ยกเลิก</a>
        </div>
    </form>
</div>
@endsection
