@extends('front.layouts.master')

@section('content')

<div class="container">

    <h2 class="mt-5"><i class="fa fa-shopping-cart"></i> Shopping Cart</h2>
    <hr>

    @include('message')

    @if ( session()->has('errors') )
        <div class="alert alert-warning">{{ session()->get('errors') }}</div>
    @endif

    @if (Cart::count() == 0)
    <h4 class="mt-5">No products in Shopping Cart</h4>

    @else
    <h4 class="mt-5">{{Cart::count()}} product(s) in Shopping Cart</h4>

    <div class="cart-products">

        <div class="row">

            <div class="col-md-12">

                <table class="table">

                    <tbody>

                        @foreach (Cart::content() as $cartItem)
                        <tr>
                            <td><img class="card-img-top" src="{{ url('uploads').'/'.$cartItem->model->image}}"
                                    alt="{{$cartItem->model->image}}" style="width: 5em"> </td>
                            <td>
                                <strong>{{$cartItem->model->name}}</strong><br> {{$cartItem->model->description}}
                            </td>

                            <td>
                                {!! Form::open(['route' => ['userCart.remove', $cartItem->rowId], 'method' =>
                                'DELETE'])!!}
                                {!! Form::button('Remove From Cart', ['type'=> 'submit', 'class'=>'btn
                                btn-link', 'onclick'=> 'return confirm("Are you sure?")']) !!}
                                {!! Form::close() !!}
                                {!! Form::open(['route' => ['userCart.addToWishlist', $cartItem->rowId], 'method' =>
                                'PUT'])!!}
                                {!! Form::button('Add To Wishlist', ['type'=> 'submit', 'class'=>'btn
                                btn-link']) !!}
                                {!! Form::close() !!}

                            </td>

                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        {{$cartItem->qty}}
                                    </button>
                                    <div class="dropdown-menu">
                                        @for ($i = 1; $i <= 5; $i++) <form
                                            action="{{route('userCart.updateQuantity', $cartItem->rowId)}}"
                                            method="POST">
                                            @csrf
                                            @method('patch')
                                            <input type="hidden" name="quantity" value="{{$i}}">
                                            <button class="dropdown-item {{$i == $cartItem->qty ? 'active' : ''}}"
                                                type="submit">{{$i}}</button>
                                            </form>
                                            @endfor
                                    </div>
                                </div>
                            </td>
                            <td>{{$cartItem->total()}}</td>
                        </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>

            <!-- Price Details -->
            <div class="col-md-6">
                <div class="sub-total">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th colspan="2">Price Details</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>Subtotal </td>
                            <td> {{Cart::subtotal()}}</td>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td>{{Cart::tax()}}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th>{{Cart::total()}}</th>
                        </tr>
                    </table>
                </div>
            </div>
            @endif

            <!-- Wishlist  -->
            <div class="col-md-12">
                <a href="{{url('/')}}" class="btn btn-outline-dark">Continue Shopping</a>
                <a href="{{url('/user/checkout')}}" class="btn btn-outline-info">Proceed to checkout</a>
                <hr>

            </div>

            @if (Cart::instance('wishlist')->count() == 0)
            <h4>No products in Wishlist</h4>

            @else

            <div class="col-md-12">

                <h4>{{Cart::instance('wishlist')->count()}} product(s) in Wishlist</h4>
                <table class="table">

                    <tbody>

                        @foreach (Cart::instance('wishlist')->content() as $cartItem)
                        <tr>
                            <td><img class="card-img-top" src="{{ url('uploads').'/'.$cartItem->model->image}}"
                                    alt="{{$cartItem->model->image}}" style="width: 5em"> </td>
                            <td>
                                <strong>{{$cartItem->model->name}}</strong><br> {{$cartItem->model->description}}
                            </td>

                            <td>

                                {!! Form::open(['route' => ['userWishlist.remove', $cartItem->rowId], 'method' =>
                                'DELETE'])!!}
                                {!! Form::button('Remove From Wishlist', ['type'=> 'submit', 'class'=>'btn
                                btn-link', 'onclick'=> 'return confirm("Are you sure?")']) !!}
                                {!! Form::close() !!}
                                {!! Form::open(['route' => ['userWishlist.moveToCart', $cartItem->rowId], 'method' =>
                                'PUT'])!!}
                                {!! Form::button('Move To Cart', ['type'=> 'submit', 'class'=>'btn
                                btn-link']) !!}
                                {!! Form::close() !!}

                            </td>

                            <td>{{$cartItem->price}}</td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            @endif

        </div>


    </div>
</div>

@endsection
