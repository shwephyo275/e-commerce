@extends('admin.layout.master')

@section('content')
<div class="">
    <a href="{{ route('admin.supplier.index') }}" class="btn btn-dark">Back</a>
</div>
<hr>
<div>
    <form action="{{ route('admin.supplier.update',$data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">Enter Name</label>
            <input type="text" name="name" class="form-control" value="{{ $data->name }}">
        </div>
        <div class="form-group">
            <label for="">Enter Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $data->phone }}">
        </div>
        <div class="form-group">
            <label for="">Enter Address</label>
            <textarea name="address" class="form-control">{{ $data->address }}</textarea>
        </div>
        <div class="form-group">
            <label for="">Enter Description</label>
            <textarea name="description" class="form-control">{{ $data->description }}</textarea>
        </div>
        <input type="submit" value="Update" class="btn btn-primary">
    </form>
</div>
@endsection