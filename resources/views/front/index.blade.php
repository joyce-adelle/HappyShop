@extends('front.layouts.master')

@section('content')

<!-- Jumbotron Header -->
<header class="jumbotron my-4">
    <h5 class="display-3"><strong>Welcome,</strong></h5>
    <p class="display-4"><strong>SALE UPTO 50%</strong></p>
    <p class="display-4">&nbsp;</p>
    <a href="#" class="btn btn-warning btn-lg float-right">SHOP NOW!</a>
</header>

@include('message')

<div class="row text-center">
    @foreach ($products as $product)

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card">
            <img class="card-img-top" src="{{ url('uploads').'/'.$product->image}}" alt="{{$product->image}}">
            <div class="card-body">
                <h5 class="card-title">{{$product->name}}</h5>
                <p class="card-text">
                    {{$product->description}}
                </p>
            </div>
            <div class="card-footer">
                <strong>${{$product->price}}</strong> &nbsp;
                <form action="{{url('/user/cart')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$product->id}}" name="id" />
                    <button type="submit" class="btn btn-primary btn-outline-dark">
                        <i class="fa fa-cart-plus "></i> Add To Cart
                    </button>
                </form>
                <form action="{{url('/user/wishlist')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$product->id}}" name="id" />
                    <button type="submit" class="btn btn-primary btn-outline-dark">
                        <i class="fa fa-cart-plus "></i> Add To Wishlist
                    </button>
                </form>
            </div>
        </div>
    </div>

    @endforeach

</div>
<!-- /.row -->

@endsection
