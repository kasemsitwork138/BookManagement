@extends('layouts.master')
@section('content')
<div class="container">
    <div class = 'card'>
        <div class = 'card-header'>
            <h1>Edit User</h1>
        </div>
        <div class = 'card-body'>
            <form method="POST" action="/edit">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>


</div>



@endsection
