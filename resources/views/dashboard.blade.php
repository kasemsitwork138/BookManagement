@extends('layouts.master')
@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Books</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $books_total }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Lent Books</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $books_lend }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Total Users</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $user_total }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class = "d-flex justify-content-end gap-2">
            <a href="/books" class="btn btn-secondary">จัดการหนังสือ</a>
            <a href="/category" class="btn btn-secondary">จัดการประเภท</a>
            <a href="/lendingbooks" class="btn btn-secondary">ดูการยืม</a>

        </div>
    </div>
@endsection
