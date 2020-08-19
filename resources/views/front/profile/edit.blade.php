@extends('front.layouts.master')

@section('content')

<div class="card">
    <div class="header">
        <h4 class="title">Edit Profile</h4>
    </div>
    <div class="content">
        {!! Form::open(['url' => ['/user/profile/edit', $user->id], 'method' => 'PUT']) !!}
        <div class="row">
            <div class="col-md-12">

                <div class="form-group {{$errors->has('name') ? 'invalid' : ''}}">
                    {!! Form::label('userName', 'User Name:') !!}
                    {!! Form::text('name', $user->name, ['class' => 'form-control border-input']) !!}
                    <span class="invalid-feedback">
                        {{$errors->has('name') ? $errors->first('name') : ''}}
                    </span>
                </div>

                <div class="form-group {{$errors->has('email') ? 'invalid' : ''}}">
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::email('email', $user->email, ['class' => 'form-control border-input']) !!}
                    <span class="invalid-feedback">
                        {{$errors->has('email') ? $errors->first('email') : ''}}
                    </span>
                </div>

            </div>

        </div>
        <div class="">
            <button type="submit" class="btn btn-info btn-fill btn-wd">Update Profile</button>
        </div>
        <div class="clearfix"></div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
