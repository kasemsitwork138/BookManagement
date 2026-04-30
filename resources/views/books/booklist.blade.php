@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Book Lists</h1>

            <a href="{{ route('books.create') }}" class="btn btn-success">
                เพิ่มหนังสือใหม่
            </a>
        </div>

        <form method="GET" action="{{ route('books.index') }}" class="row mb-3">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="ค้นหาชื่อหนังสือ"
                    value="{{ request('search') }}">
            </div>

            <div class="col-md-4">
                <select name="category" class="form-control">
                    <option value="">-- เลือกหมวดหมู่ --</option>

                    @forelse($category as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @empty
                        <option disabled selected>ยังไม่มีหมวดหมู่</option>
                    @endforelse
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    ค้นหา
                </button>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ชื่อหนังสือ</th>
                    <th>ปีที่พิมพ์</th>
                    <th>หมวดหมู่</th>
                    <th>สถานะ</th>
                    <th>รูปปก</th>
                    <th>จัดการ</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->published_date }}</td>
                        <td>{{ optional($book->category)->name }}</td>
                        <td>
                            @if ($book->is_lend)
                                <span class="text-danger">ถูกยืม</span>
                            @else
                                <span class="text-success">ว่าง</span>
                            @endif
                        </td>
                        <td>
                            @if ($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Image"
                                    style="width: 50px; height: auto;">
                            @else
                                ไม่มีรูปปก
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('books.showdesc', $book->id) }}" class="btn btn-primary btn-sm">
                                ดูรายละเอียด
                            </a>

                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-sm">
                                แก้ไข
                            </a>

                            <form method="POST" action="{{ route('books.destroy', $book->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">ลบ</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @foreach ($books as $book)
            <div class="modal fade" id="editBook{{ $book->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form method="POST" action="{{ route('books.update', $book->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title">แก้ไขหนังสือ</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <input class="form-control mb-2" name="title" value="{{ $book->title }}">
                                <input class="form-control mb-2" name="published_date" value="{{ $book->published_date }}">
                                <select class="form-control mb-2" name="category_id">
                                    <option value="">เลือกหมวดหมู่</option>
                                    @foreach($category as $cat)
                                        <option value="{{ $cat->id }}" {{ $book->category_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
