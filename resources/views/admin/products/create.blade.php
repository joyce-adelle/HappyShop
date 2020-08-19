@extends('admin.layouts.master')

@section('page')
 Add Product
@endsection

@section('content')

<div class="row">
    <div class="col-lg-10 col-md-10">
        @include('message')
        <div class="card">
            <div class="header">
                <h4 class="title">Add Product</h4>
            </div>
            <div class="content">
                {!! Form::open(['url' => '/admin/products', 'files' => 'true']) !!}
                <div class="row">
                    <div class="col-md-12">

                        @include('admin.products.fields')

                    </div>

                </div>
                <div class="">
                    <button type="submit" class="btn btn-info btn-fill btn-wd">Add Product</button>
                </div>
                <div class="clearfix"></div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
