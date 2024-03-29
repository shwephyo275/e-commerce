@extends('admin.layout.master')

@section('content')
<div>
    <a href="" class="btn btn-warning">pending</a>
    <a href="" class="btn btn-success">success</a>
    <a href="" class="btn btn-danger">reject</a>

    <form action="" class="d-inline">
        <input type="text" name="voucher_id" class="btn bg-secondary border border-dark" id="">
        <input type="submit" value="Search" class="btn btn-dark">
    </form>
</div>
<table class="table table-striped">
    <tr>
        <th>Payment</th>
        <th>Bank</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Status</th>
        <th>option</th>
    </tr>
    @foreach ($data as $d)
    <tr>
        <td>
            <img src="{{ $d->image_url }}" style="width: 100px">
        </td>
        <td>{{ $d->bank_name }}</td>
        <td>
            {{ $d->user->delivery_address }}
        </td>
        <td>
            {{ $d->user->phone }}
        </td>
        <td>
            @if($d->status=='pending')
            <span class="badge badge-warning">Pending</span>
            @endif
            @if($d->status=='deliver')
            <span class="badge badge-success">Success</span>
            @endif
            @if($d->status=='reject')
            <span class="badge badge-danger">Reject</span>
            @endif

        </td>
        <td>
            <button class="btn btn-dark">
                <i class="fas fa-eye"></i>
            </button>
            |
            @if($d->status!='deliver')
            <a href="{{ url('/admin/order-status?voucher_id='.$d->voucher_id.'&status=deliver') }}"
                class="btn btn-success">Set Success</a>
            @endif
            <a href="{{ url('/admin/order-status?voucher_id='.$d->voucher_id.'&status=reject') }}"
                class="btn btn-danger">Set Reject</a>
        </td>
    </tr>
    @endforeach

</table>

{{ $data->links() }}
@endsection