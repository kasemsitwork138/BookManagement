@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">รายละเอียดหนังสือ</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $book->title }}</h5>
            <p class="card-text">ผู้แต่ง: {{ $book->author }}</p>
            <p class="card-text">ปีที่พิมพ์: {{ $book->published_date }}</p>
            <p class="card-text">หมวดหมู่: {{ optional($book->category)->name }}</p>
            @if ($book->cover_image)
                <img src="{{ Storage::url($book->cover_image) }}" alt="Cover Image" class="img-fluid">
            @endif
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('books.index') }}" class="btn btn-secondary">กลับไปยังรายการหนังสือ</a>
    </div>
</div>
@endsection
