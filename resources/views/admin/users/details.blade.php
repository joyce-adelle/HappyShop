@extends('admin.layouts.master')

@section('page')
 Order Details
@endsection

@section('content')

<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">{{$orders[0]->user->name}} Orders Details</h4>
                <p class="category">Order Details</p>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Address</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Date</th>
                            <th>Order Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            @for ($i = 0; $i < $order->orderItems->count(); $i++)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->products[$i]->name}}</td>
                                    <td>{{$order->address}}</td>
                                    <td>{{$order->orderItems[$i]->quantity}}</td>
                                    <td>{{$order->orderItems[$i]->price}}</td>
                                    <td>{{$order->date}}</td>
                                    <td>{{$order->orderItems[$i]->created_at->diffForHumans()}}</td>
                                    <td>
                                        @if ($order->status)
                                            <span class="label label-success">Confirmed</span>
                                        @else
                                            <span class="label label-warning">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @endfor
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
