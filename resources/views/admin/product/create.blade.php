@extends('admin.layout.master')


@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection


@section('content')
<div class="">
    <a href="{{ route('admin.product.index') }}" class="btn btn-dark">Back</a>
</div>
<hr>
<div>
    <form action="{{ route('admin.product.store') }}" class="row" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="col-8">
            <div class="card card-body">
                <small class="text-muted">Product Entry</small>
                <div class="form-group">
                    <label for="">Choose Supplier</label>
                    <select name="supplier" class="form-control">
                        @foreach ($supplier as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}- {{ $d->phone }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Enter Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Choose Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Enter Description</label>
                    <textarea name="description" id="desc"></textarea>
                </div>
            </div>
            <div class="card card-body">
                <small class="text-muted">Product Pricing</small>
                <div class="form-group">
                    <label for="">Enter Quantity</label>
                    <input type="number" name="qty" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Buy Price</label>
                    <input type="number" name="buy_price" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Sale Price</label>
                    <input type="number" name="sale_price" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Discounted Price</label>
                    <input type="number" name="discounted_price" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-body">
                <div class="form-group">
                    <label for="">Choose Supplier</label>
                    <select name="brand" class="form-control">
                        @foreach ($brand as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Choose category</label>
                    <select name="category[]" multiple id="category" class="form-control">
                        @foreach ($category as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Choose Color</label>
                    <select name="color[]" multiple id="color" class="form-control">
                        @foreach ($color as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Choose Size</label>
                    <select name="size[]" multiple id="size" class="form-control">
                        @foreach ($size as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" value="Create" class="btn btn-dark">
            </div>
        </div>
    </form>
</div>
@endsection


@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $('#desc').summernote();
    $('#category').select2();
    $('#color').select2();
    $('#size').select2();
</script>
@endsection