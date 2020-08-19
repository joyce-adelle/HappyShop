@extends('front.layouts.master')

@section('content')

<h1> User Profile</h1>

@include('message')

<table class="table table-light">
    <thead >
        <tr>
            <th rowspan="2">
                <h4> User Details </h4>
                <a class="pull-right" href="{{url('/user/profile/edit')}}">Edit User Details</a>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ID</td>
            <td>{{$user->id}}</td>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{$user->name}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <td>Registered At</td>
            <td>{{$user->created_at}}</td>
        </tr>
    </tbody>
</table>

<div class="card">
    <div class="header">
        <h4 class="title">Orders</h4>
        <p class="category">List of all orders</p>
    </div>
    <div class="content table-responsive table-full-width">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Address</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($user->order as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->user->name}}</td>
                    <td>
                        @foreach ($order->products as $item)
                        {{$item->name.','}}
                        @endforeach
                    </td>
                    <td>
                        @foreach ($order->orderItems as $item)
                        {{$item->quantity.','}}
                        @endforeach
                    </td>
                    <td>{{$order->address}}</td>
                    <td>
                        @if ($order->status)
                        <span class="label label-success">Confirmed</span>
                        @else
                        <span class="label label-warning">Pending</span>
                        @endif
                    </td>
                    <td>
                        {!! link_to_route('userOrders.show', 'Show', $order->id, ['class' =>"btn btn-sm btn-primary ti-view-list-alt", 'title' => 'Details']) !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
