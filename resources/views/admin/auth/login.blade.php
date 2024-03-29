<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/argon.css?v=1.2.0') }}" type="text/css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-4 offset-4">
                <div class="card">
                    <div class="card-header text-white bg-dark">
                        <span>Admin Login Form</span>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form action="{{ url('/admin/login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Enter Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Enter Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <input type="submit" value="Login" class="btn btn-dark">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>