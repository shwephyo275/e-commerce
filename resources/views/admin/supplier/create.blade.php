@extends('admin.layout.master')

@section('content')
<div class="">
    <a href="{{ route('admin.supplier.index') }}" class="btn btn-dark">Back</a>
</div>
<hr>
<div>
    <form action="{{ route('admin.supplier.store') }}" method="POST">
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
            <label for="">Enter Address</label>
            <textarea name="address" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="">Enter Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <input type="submit" value="Create" class="btn btn-primary">
    </form>
</div>
@endsection