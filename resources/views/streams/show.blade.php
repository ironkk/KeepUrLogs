@extends('layouts.dashboard')
@section('content-header')
    <h1>
        {{trans('site.streams')}}
        <small>
            {{ $stream->name }}
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {{ trans('site.dashboard') }}</a></li>
        <li><a href="{{ action('Streams@index') }}">{{ trans('site.streams') }}</a></li>
        <li class="active">{{ $stream->name }}</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('stream.create_new')}}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">
                                {{trans('stream.name')}}
                            </label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" class="form-control col-md-6" id="name" name="name" value="{{$stream->name}}" placeholder="{{trans('stream.name')}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="project" class="col-sm-2 control-label">{{trans('stream.project')}}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="api_key" name="api_key" value="{{$stream->project->name}}"
                                       placeholder="{{trans('stream.project')}}" style="width: 100%" disabled>
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="name" class="col-sm-2 control-label">
                                {{trans('stream.api_key')}}
                            </label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" class="form-control" id="api_key" name="api_key" value="{{$stream->api_key}}"
                                       placeholder="{{trans('stream.api_key')}}" style="width: 100%" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="project" class="col-sm-2 control-label">{{trans('stream.active')}}</label>
                            <div class="col-md-6">
                                <input class="switch-b" type="checkbox" name="active" {{ $stream->active == 1 ? "checked" : "" }} readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
