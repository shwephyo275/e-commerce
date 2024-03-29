@extends('admin.layout.master')

@section('css')
<style>
    .modal-dialog {
        max-width: 900px !important;
    }
</style>

@endsection

@section('content')







<div class="">
    <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Create</a>
</div>
<hr>
<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Total Stock</th>
                <th>Sale Price</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
            <tr>

                <td>
                    <img src="{{ $d->image_url }}" width="100" class="img-thumbnail">
                </td>
                <td>
                    {{ $d->name }}
                </td>
                <td>{{ $d->qty }}</td>
                <td>{{ $d->sale_price }}</td>
                <td>
                    <button data-toggle="modal" data-target="#id{{ $d->id }}" href=""
                        class="btn btn-success">View</button>
                    <a href="{{ route('admin.product.edit',$d->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.supplier.destroy',$d->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <input onclick="return confirm('are you sure for delete ? ')" type="submit" value="Delete"
                            class="btn btn-danger">
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection

@section('js')

@foreach ($data as $d)
<!-- Modal -->
<div class="modal fade" id="id{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <img src="{{ $d->image_url }}" class="w-100">

                    </div>
                    <div class="col-8">
                        <div>
                            Color:
                            @foreach ($d->color as $c)
                            <span class="badge badge-dark text-white">{{ $c->name }}</span>
                            @endforeach
                            |
                            Size: @foreach ($d->size as $c)
                            <span class="badge badge-dark text-white">{{ $c->name }}</span>
                            @endforeach
                            |
                            Category: @foreach ($d->category as $c)
                            <span class="badge badge-dark text-white">{{ $c->name }}</span>
                            @endforeach
                            |
                            Brand:
                            <span class="badge badge-dark text-white">{{ $d->brand->name }}</span>

                            Supplier:
                            <span class="badge badge-dark text-white">{{ $d->supplier->name }}</span>

                        </div>
                        <div>
                            <div class="card card-body mt-2">
                                <div>
                                    <button class="btn btn-outline-dark btn-sm">Sale Price:{{ $d->sale_price }}</button>
                                    <button class="btn btn-outline-dark btn-sm">Buy Price:{{ $d->buy_price }}</button>
                                    <button class="btn btn-outline-dark btn-sm">Stock:{{ $d->qty }}</button>
                                    <button class="btn btn-outline-dark btn-sm">Discounted Price:
                                        <strike>
                                            {{ $d->discounted_price }}
                                        </strike>
                                    </button>

                                </div>
                                <br>
                                <h3 class="text-primary">{{ $d->name }}</h3>
                                {!! $d->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endforeach

@endsection