@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form method="POST" action="/login">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" id ="login" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let token = localStorage.getItem('token');

            if (token && window.location.pathname === '/login') {
                window.location.href = "/dashboard";
            }

            $('#login').click(function(e) {
                e.preventDefault();

                let email = $('#email').val();
                let password = $('#password').val();

                $.ajax({
                    url: '/login',
                    method: 'POST',
                    data: {
                        email: email,
                        password: password
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Login successful!');
                            localStorage.setItem('token', response.access_token);

                            window.location.href = '/dashboard';
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Login error');
                    }
                });
            });

            // $('#logout').click(function() {
            //     $.ajax({
            //         url: '/api/logout',
            //         method: 'POST',
            //         headers: {
            //             'Authorization': 'Bearer ' + localStorage.getItem('token')
            //         },
            //         success: function() {
            //             alert('Logout successful');
            //             localStorage.removeItem('token');
            //             localStorage.removeItem('refresh_token');
            //         },
            //         error: function(xhr) {
            //             console.log(xhr.responseText);
            //             alert('Logout failed');
            //         }
            //     });
            // });
        });
    </script>
@endsection

