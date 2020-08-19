@extends('front.layouts.master')

@section('content')

<div class="container">

    <div class="row">

        <div class="col-md-12" id="register">

            <div class="card col-md-8">
                <div class="card-body">

                    <h2 class="card-title">Login</h2>
                    <hr>

                    @include('front.layouts.errors')

                    <form action="/login" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" placeholder="Email" id="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" placeholder="Password" id="passowrd"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-outline-info col-md-2">Login</button>
                        </div>

                    </form>

                </div>
            </div>


        </div>

    </div>

</div>

@endsection
