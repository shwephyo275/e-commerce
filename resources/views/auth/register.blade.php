@extends('layout.master')

@section('content')
<div class="row">
    <div class="col-4 offset-4">
        <div class="card">
            <div class="card-header bg-dark text-white">Register</div>
            <div class="card-body">

                @if($errors->any())
                @foreach ($errors->all() as $e)
                <div class="alert alert-danger">{{ $e }}</div>
                @endforeach
                @endif
                <form action="{{ url('/register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Enter Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Delivery Address</label>
                        <textarea name="delivery_address" class="form-control"></textarea>
                    </div>
                    <input type="submit" value="Login" class="btn btn-dark">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection