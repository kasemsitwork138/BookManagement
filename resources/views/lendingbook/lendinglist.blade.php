@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>รายการยืมหนังสือ</h1>

            <a href="{{ route('lendingbooks.create') }}" class="btn btn-success">
                เพิ่มการยืมหนังสือใหม่
            </a>
        </div>

        <form method="GET" action="{{ route('lendingbooks.search') }}" class="row mb-3">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="ค้นหาชื่อหนังสือ"
                    value="{{ request('search') }}">
            </div>

            {{-- <div class="col-md-4">
                <select name="category" class="form-control">

                    @forelse($category as $cat)
                        <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @empty
                        <option disabled selected>ยังไม่มีหมวดหมู่</option>
                    @endforelse

                </select>
            </div> --}}

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
                    <th>ชื่อผู้ยืม</th>
                    <th>วันที่เริ่มยืม</th>
                    <th>วันที่คืน</th>
                    <th>สถานะ</th>
                    <th>จัดการ</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($lendingBooks as $lendingBook)
                    <tr>
                        <td>{{ $lendingBook->book->title }}</td>
                        <td>{{ $lendingBook->user->name }}</td>
                        <td>{{ $lendingBook->start_date }}</td>
                        <td>{{ $lendingBook->end_date }}</td>
                        <td>{{ $lendingBook->status }}</td>
                        <td>
                            <form action="{{ route('lendingbooks.update', $lendingBook) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('คุณแน่ใจหรือไม่ที่จะคืนหนังสือ')"
                                     {{ $lendingBook->status == 'returned' ? 'disabled' : '' }}>
                                    คืนหนังสือ</button>
                            </form>
                            <form action="{{ route('lendingbooks.destroy', $lendingBook) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบรายการนี้?')"?>
                                    ลบ
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
