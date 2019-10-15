@extends('layouts.auth')

@section('content')
    <div class="login-box">
        <div class="login-logo">
        <div>
        <img src={{asset('public/img/e2logo.png')}} alt="Logo" style="width:70px; align=center;"></a>
        </div>
            e2 <b>Management</b> System
            
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to access the database</p>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group has-feedback">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" value="{{ old('email') }}" required autofocus>
                    <span class="fa fa-envelope form-control-feedback"></span>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input id="password" type="password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                           required>
                    <span class="fa fa-lock form-control-feedback"></span>
                    

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <!--<div class="alert alert-warning alert-dismissible" style="padding: 3px; padding-left: 15px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="padding-right: 32px; padding-top: 9px;">&times;</button>
                <h5><i class="icon fa fa-info"></i>Login details can be found in the report!</h5>
              </div>-->

                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input class="form-check-input" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>



                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-danger btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        {{--<div class="social-auth-links text-center">--}}
        {{--<p>- OR -</p>--}}
        {{--<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using--}}
        {{--Facebook</a>--}}
        {{--<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using--}}
        {{--Google+</a>--}}
        {{--</div>--}}
        <!-- /.social-auth-links -->

            {{--<a href="{{ route('password.request') }}">I forgot my password</a><br>--}}
            <!--<a href="{{ route('register') }}" class="text-center">Register a new membership</a>-->

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->


@endsection