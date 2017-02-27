@extends('layouts.dashboard')
@section('content-header')
    <h1>
        {{trans('site.streams')}}
        <small>
            {{trans('stream.new')}}
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {{ trans('site.dashboard') }}</a></li>
        <li><a href="{{ action('Streams@index') }}">{{ trans('site.streams') }}</a></li>
        <li class="active">{{ trans('stream.new') }}</li>
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
                <form method="POST" action="{{action('Streams@store')}}" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">
                                {{trans('stream.name')}}
                            </label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" class="form-control col-md-6" id="name" name="name" placeholder="{{trans('stream.name')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="project" class="col-sm-2 control-label">{{trans('stream.project')}}</label>
                            <div class="col-md-6">
                                <select name="project" class="form-control select2">
                                    <option value="" selected="selected">
                                        {{ trans('stream.select_project') }}
                                    </option>
                                    @foreach($projects as $project)
                                        <option value="{{$project->id}}">{{$project->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="project" class="col-sm-2 control-label">{{trans('stream.active')}}</label>
                            <div class="col-md-6">
                                <input class="switch-b" type="checkbox" name="active">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{action('Streams@index')}}"  class="btn btn-default">{{trans('site.cancel')}}</a>
                        <button type="submit" class="btn btn-success pull-right">
                            {{trans('site.save')}}
                        </button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
<script>
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
    });
</script>
@endsection
