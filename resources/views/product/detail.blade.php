@extends('layout.master')

@section('content')
<div class="w-80 mt-5">

    <div class="row">

        <div class="col-12 col-sm-12 col-md-3 col-lg-3 ">
            <div class="card">
                <div class="card-header bg-dark text-white">All Category</div>
                @foreach ($category as $c)
                <li class="list-group-item">
                    <a href="{{ url('/product?category='.$c->slug) }}" class="text-dark">
                        {{ $c->name }}
                        <small class="float-right badge badge-dark">{{ $c->product_count }}</small>
                    </a>
                </li>
                @endforeach
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-9 col-lg-9" id="root">

        </div>
    </div>

</div>

@endsection

@section('js')
<script>
    const blade_product= @json($data);
</script>
@vite(['resources/js/Product/ProductDetail.jsx'])
@endsection