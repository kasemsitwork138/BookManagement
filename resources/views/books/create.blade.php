@extends('layouts.master')

@section('content')
    <div class="container">
        <h2 class="mb-4">เพิ่มหนังสือใหม่</h2>

        <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>ชื่อหนังสือ</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>ผู้แต่ง</label>
                <input type="text" name="author" class="form-control" value="{{ old('author') }}">
                @error('author')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>ปีที่พิมพ์</label>
                <input type="date" name="published_date" class="form-control" value="{{ old('published_date') }}">
                @error('published_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>หมวดหมู่</label>
                <select name="category_id" class="form-control">
                    <option value="">-- เลือกหมวดหมู่ --</option>
                    @foreach ($category as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $book->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label>อัปโหลดหน้าปก</label>
                <input type="file" name="cover_image" class="form-control">
                @error('cover_image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">บันทึก</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">ยกเลิก</a>
            </div>
        </form>
    </div>
@endsection
