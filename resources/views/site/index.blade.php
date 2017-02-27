@extends('layouts.site')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{action('Dashboard@index')}}"><b>LOG</b>Central</a>
        </div>
        @if(session('fail_login'))
                <p class="text-red text-center">
                    {{ session('fail_login') }}
                </p>
        @endif
        @foreach($errors->all() as $message)
            <p class="text-red text-center">
                {{ $message }}
            </p>
        @endforeach
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form id="loginform" action="{{ action('Login@login') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group">
                    {!! app('captcha')->display(); !!}
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember_me"> {{ trans('site.remember_me') }}
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            {{ trans('site.sign_in') }}
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="#">
                I forgot my password
            </a>
            <br>
            <!-- <a href="" class="text-center">Register a new membership</a> -->

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@endsection
@section('scripts')
@endsection