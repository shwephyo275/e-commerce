@extends('layout.master')

@section('content')
<div class="row">
    <div class="col-4 offset-4">
        <div class="card">
            <div class="card-header bg-dark text-white">Login</div>
            <div class="card-body">
                <form action="{{ url('/login') }}" method="POST">
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
@endsection