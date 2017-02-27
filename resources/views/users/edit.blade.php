@extends('layouts.dashboard')
@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('admin.users')}}
            <small>
                {{trans('site.edit')}}
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {{ trans('site.dashboard') }}</a></li>
            <li><a href="{{ action('Admin\Users@index') }}">{{ trans('site.users') }}</a></li>
            <li class="active">{{ trans('site.edit') }}</li>
        </ol>
    </section>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('admin.edit')}}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="{{action('Admin\Users@update', $user->id)}}" class="form-horizontal">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">
                                {{trans('admin.name')}}
                            </label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" class="form-control col-md-6" id="name" name="name"
                                       placeholder="{{trans('admin.name')}}" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">
                                {{trans('admin.lastname')}}
                            </label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" class="form-control col-md-6" id="lastname" name="lastname"
                                       placeholder="{{trans('admin.lastname')}}" value="{{ $user->lastname }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">
                                {{trans('admin.email')}}
                            </label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" class="form-control col-md-6" id="email" name="email" placeholder="{{trans('admin.email')}}"
                                       value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">
                                {{trans('admin.password')}}
                            </label>
                            <div class="col-sm-10 col-md-6">
                                <input type="password" class="form-control col-md-6" id="password" name="password" placeholder="{{trans('admin.password')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">
                                {{trans('admin.confirm_password')}}
                            </label>
                            <div class="col-sm-10 col-md-6">
                                <input type="password" class="form-control col-md-6" id="confirm_passwod" name="confirm_password" placeholder="{{trans('admin.confirm_password')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="level" class="col-sm-2 control-label">{{trans('admin.level')}}</label>
                            <div class="col-md-6">
                                <select name="level" class="form-control select2 has-error" style="width: 100%;">
                                    @foreach($levels as $key => $level)
                                        <option value="{{ $key }}"
                                                {{ $user->level_id == $key ? "selected" : "" }}>
                                            {{ $level }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{action('Admin\Users@index')}}"  class="btn btn-default">{{trans('site.cancel')}}</a>
                        <button type="submit" class="btn btn-success pull-right">
                            {{trans('site.save')}}
                        </button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
