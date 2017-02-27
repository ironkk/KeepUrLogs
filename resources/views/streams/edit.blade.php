@extends('layouts.dashboard')
@section('content-header')
    <h1>
        {{trans('site.streams')}}
        <small>
            {{trans('stream.edit')}}
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {{ trans('site.dashboard') }}</a></li>
        <li><a href="{{ action('Streams@index') }}">{{ trans('site.streams') }}</a></li>
        <li class="active">{{ trans('stream.edit') }}</li>
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
                <form method="POST" action="{{action('Streams@update', [$stream->id])}}" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">
                                {{trans('stream.name')}}
                            </label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" class="form-control col-md-6" id="name" name="name" value = "{{$stream->name}}" placeholder="{{trans('stream.name')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="project" class="col-sm-2 control-label">{{trans('stream.project')}}</label>
                            <div class="col-md-6">
                                <select name="project_id" class="form-control select2" style="width: 100%;">
                                    <option value="0" {{$stream->project_id == 0 ? 'selected="selected"' : ''}}>{{trans('stream.select_project')}}</option>
                                    @foreach($projects as $project)
                                        <option value="{{$project->id}}" {{$stream->project_id == $project->id ? 'selected="selected"' : ''}}>{{$project->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="name" class="col-sm-2 control-label">
                                {{trans('stream.api_key')}}
                            </label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" class="form-control" id="api_key" name="api_key" value="{{$stream->api_key}}" placeholder="{{trans('stream.api_key')}}" style="width: 100%">
                                <div id="new_api_key_text" class="text-success" style="display: none">
                                    <i class="fa fa-check" aria-hidden="true"></i> {{ trans('stream.new_api_key_text') }}
                                </div>
                                <input type="hidden" id="new_api_key" name="new_api_key" value="false">
                            </div>
                            <span class="btn btn-primary" onclick="generateNewKey();">{{trans('stream.regenerate_key')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="project" class="col-sm-2 control-label">{{trans('stream.active')}}</label>
                            <div class="col-md-6">
                                <input class="switch-b" type="checkbox" name="active" {{ $stream->active == 1 ? "checked" : "" }}>
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
    function generateNewKey() {
        $.ajax({
            type: "POST",
            url: "{{ action('Streams@ajax_regenerate_Api_key') }}",
            success: function(data) {
                $("#api_key").val(data);
                $("#new_api_key_text").show();
                $("#new_api_key").val(true);
            },
        });

    }
</script>
@endsection
