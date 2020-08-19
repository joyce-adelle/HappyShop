@extends('front.layouts.master')

@section('content')

<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Orders</h4>
                <p class="category">Order Details</p>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Quantity</th>
                            <th>Address</th>
                            <th>Order Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$order->date}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$item->created_at->diffForHumans()}}</td>
                                <td>
                                    @if ($order->status)
                                    <span class="label label-success">Confirmed</span>
                                    @else
                                    <span class="label label-warning">Pending</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <h4 class="title">User Details</h4>
                <p class="category">User Details</p>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-striped">

                    <tbody>
                        <tr>
                            <th>
                                ID
                            </th>
                            <td>
                                {{$order->user->id}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Name
                            </th>
                            <td>
                                {{$order->user->name}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Email
                            </th>
                            <td>
                                {{$order->user->email}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Registered At
                            </th>
                            <td>
                                {{$order->user->created_at}}
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <h4 class="title">Product Details</h4>
                <p class="category">Product Details</p>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-striped">
                    <tbody>
                        @foreach ($order->products as $product)
                        <tr>
                            <th>ID</th>
                            <td>{{$product->id}}</td>
                        </tr>

                        <tr>
                            <th>Name</th>
                            <td>{{$product->name}}</td>
                        </tr>

                        <tr>
                            <th>Price</th>
                            <td>{{$product->price}}</td>
                        </tr>

                        <tr>
                            <th>Image</th>
                            <td><img src="{{ url('uploads').'/'.$product->image}}" alt="" class="img-thumbnail"
                                    style="width: 150px;"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a href="{{url('/user/profile')}}" class="btn btn-default">Back to Profile</a>
</div>

@endsection
