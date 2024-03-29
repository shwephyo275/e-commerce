@extends('admin.layout.master')

@section('content')
<div class="">
    <a href="{{ route('admin.supplier.index') }}" class="btn btn-primary">Create</a>
</div>
<hr>
<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Description</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
            <tr>
                <td>{{ $d->name }}</td>
                <td>{{ $d->phone }}</td>
                <td>{{ $d->address }}</td>
                <td>{{ $d->description }}</td>
                <td>
                    <a href="{{ route('admin.supplier.edit',$d->id) }}" class="btn btn-primary">Edit</a>
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