@extends('layouts.master')

@section('content')
    <div class="container">
        <h2 class="mb-4">เพิ่มประเภทหนังสือใหม่</h2>

        <form method="POST" action="{{ route('category.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name">ชื่อประเภท</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">บันทึก</button>
                <a href="{{ route('category.index') }}" class="btn btn-secondary">ยกเลิก</a>
            </div>
        </form>
    </div>
@endsection
