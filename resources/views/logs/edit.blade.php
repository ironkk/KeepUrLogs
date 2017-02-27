@extends('layouts.dashboard')
@section('content-header')
    <h1>
        {{trans('site.logs')}}
        <small>
            {{ $log->stream->name }}
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {{ trans('site.dashboard') }}</a></li>
        <li><a href="{{ action('Logs@index') }}">{{ trans('site.logs') }}</a></li>
        <li class="active">{{ $log->date }} - {{ $log->message }}</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $log->date }} - {{ $log->message }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="{{action('Logs@update', [$log->id])}}" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{$log->id}}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">
                                {{trans('log.action')}}
                            </label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" class="form-control col-md-6" id="name" name="name" value="{{$log->message}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">
                                {{trans('log.stream')}}
                            </label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" class="form-control col-md-6" id="name" name="name" value="{{$log->stream->name}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">
                                {{trans('log.project')}}
                            </label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" class="form-control col-md-6" id="name" name="name" value="{{$log->stream->project->name}}" disabled>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </form>
            </div>
        </div>
    </div>
    @if($log->have_diff == 1)
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('site.diff') }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th class="text-center">
                                    {{ trans('site.table') }}
                                </th>
                                <th class="text-center">
                                    {{ trans('site.field') }}
                                </th>
                                <th class="text-center">
                                    {{ trans('site.old_value') }}
                                </th>
                                <th class="text-center">
                                    {{ trans('site.new_value') }}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($log->diffs as $diff)
                                <tr>
                                    <td class="text-center">
                                        {{ $diff->table }}
                                    </td>
                                    <td class="text-center">
                                        {{ $diff->field }}
                                    </td>
                                    <td class="text-center">
                                        {{ $diff->old_value }}
                                    </td>
                                    <td class="text-center">
                                        <span class="label label-success">
                                            {{ $diff->new_value }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
        });
    </script>
@endsection
