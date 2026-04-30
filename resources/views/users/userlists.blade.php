@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>รายการผู้ใช้</h1>

            {{-- <a href="{{ route('lendingbooks.create') }}" class="btn btn-success">
                พิ่มการยืมหนังสือใหม่
            </a> --}}
        </div>

        {{-- <form method="GET" action="{{ route('users.index') }}" class="row mb-3"> --}}
            {{-- <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="ค้นหาชื่อหนังสือ"
                    value="{{ request('search') }}">
            </div> --}}

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
                    <th>ชื่อ</th>
                    <th>อีเมล</th>
                    <th>เบอร์โทร</th>
                    <th>จัดการ</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <div class="d-flex">
                                {{-- <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info me-2">
                                    ดูรายละเอียด
                                </a> --}}
                                <a href="#" class="btn btn-sm btn-warning me-2">
                                    แก้ไข
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบผู้ใช้นี้?')">
                                        ลบ
                                    </button>
                                </form>
                            </div>

                            {{-- <form action="{{ route('lendingbooks.update', $lendingBook) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('คุณแน่ใจหรือไม่ที่จะคืนหนังสือ')">คืนหนังสือ</button>
                            </form> --}}
                            {{-- <form action="{{ route('lendingbooks.destroy', $lendingBook) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบรายการนี้?')">
                                    ลบ
                                </button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
