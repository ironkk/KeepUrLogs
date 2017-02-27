@extends('layouts.dashboard')
@section('content-header')
    <h1>
        {{trans('site.projects')}}
        <small>
            {{trans('project.new')}}
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {{ trans('site.dashboard') }}</a></li>
        <li><a href="{{ action('Projects@index') }}">{{ trans('site.projects') }}</a></li>
        <li class="active">{{ trans('project.create_new') }}</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('project.create_new')}}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="{{action('Projects@store')}}" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">
                                {{trans('project.name')}}
                            </label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" class="form-control col-md-6" id="name" name="name" placeholder="{{trans('project.name')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">
                                {{trans('project.description')}}
                            </label>

                            <div class="col-sm-10 col-md-6">
                                <input type="text" class="form-control" id="description" name="description" placeholder="{{trans('project.description')}}">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{action('Projects@index')}}"  class="btn btn-default">{{trans('site.cancel')}}</a>
                        <button type="submit" class="btn btn-success pull-right">
                            {{trans('site.save')}}
                        </button>
                    </div>
                    <!-- /.box-footer -->
                </form>
        </div>
    </div>
@endsection
