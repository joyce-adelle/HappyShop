<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>HappyShop Admin</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    {{Html::style('assets/css/bootstrap.min.css')}}
    {{Html::style('assets/css/animate.min.css')}}
    {{Html::style('assets/css/paper-dashboard.css')}}
    {{Html::style('assets/style.css')}}
    {{Html::style('http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css')}}
    {{Html::style('https://fonts.googleapis.com/css?family=Muli:400,300')}}
    {{Html::style('assets/css/themify-icons.css')}}

</head>

<body>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{url('/admin/login')}}">
                    HappyShop Admin
                </a>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        <div class="container" style="margin-top: 50px">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Sign In</strong></h3>
                        </div>

                        <div class="panel-body">

                            @include('message')

                            @if ($errors->has('message'))
                                <div class='alert alert-danger'>{{$errors->first('message')}} </div>
                            @endif

                            <form method="POST">
                                @csrf
                                <div class="form-group {{$errors->has('email') ? 'invalid' : ''}}">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" id="email" placeholder="Email"
                                        class="form-control border-input" />
                                    <span class="invalid-feedback">
                                        {{$errors->has('email') ? $errors->first('email') : ''}}
                                    </span>
                                </div>

                                <div class="form-group {{$errors->has('password') ? 'invalid' : ''}}">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" id="password" placeholder="Password"
                                        class="form-control border-input" />
                                    <span class="invalid-feedback">
                                        {{$errors->has('password') ? $errors->first('password') : ''}}
                                    </span>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Sign In</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
