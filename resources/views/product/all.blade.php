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

        <div class="col-12 col-sm-12 col-md-9 col-lg-9">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card w-100 p-4">
                        <form>
                            <select name="category" class="btn btn-dark" id="">
                                <option value="">Category</option>
                                @foreach ($category as $c)
                                <option value="{{ $c->slug }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            <select name="color" class="btn  btn-dark" id="">
                                <option value="">Color</option>
                                @foreach ($color as $c)
                                <option value="{{ $c->slug }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            <select name="brand" class="btn  btn-dark" id="">
                                <option value="">Brand</option>
                                @foreach ($brand as $c)
                                <option value="{{ $c->slug }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            <select name="size" class="btn  btn-dark" id="">
                                <option value="">Size</option>
                                @foreach ($size as $c)
                                <option value="{{ $c->slug }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            <input type="text" class="btn  btn-white" placeholder="enter search" name="search" id="">
                            <input type="submit" class="btn  bg-primary" value="search" name="" id="">
                            @if(request()->has('category') || request()->has('brand') || request()->has('search'))
                            <a href="{{ url('/product') }}" class="btn  btn-danger">Clear</a>
                            @endif
                        </form>
                    </div>
                </div>


                <!-- products -->
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-3 product">
                    <div class="row">
                        <!-- loop product -->
                        @foreach ($data as $d)
                        <div class="col-12 col-md-4 text-center mt-2">
                            <a href="{{ url('/product/'.$d->slug) }}">
                                <div class="card p-2">
                                    <img src="{{ $d->image_url }}" alt="" class="w-100">
                                    <b>{{ $d->name }}</b>
                                    <div>
                                        <small class=" badge badge-danger"> <strike>{{ $d->discounted_price
                                                }}ks</strike> </small>
                                        <small class="badge bg-primary">{{ $d->sale_price
                                            }}ks</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-3 product">
                    {{ $data->links() }}
                </div>
            </div>
            <div class="row">
                <div class="col-12"></div>
            </div>
        </div>
    </div>
</div>

@endsection