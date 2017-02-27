@extends('layouts.dashboard')
@section('content-header')
        <h1>
            {{ trans('site.dashboard') }}
        </h1>
        <ol class="breadcrumb">
            <li class="active">Dashboard</li>
        </ol>
@endsection
@section('content')
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua">
                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('site.info_messages') }}</span>
                    <span class="info-box-number">
                        {{ $info_msg_count }}
                    </span>
                    <small>
                        <a href="{{ action('Logs@index') }}">
                            {{ trans('site.more_info') }}
                        </a>
                    </small>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow">
                    <i class="fa fa-warning" aria-hidden="true"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">
                        {{ trans('site.warning_messages') }}
                    </span>
                    <span class="info-box-number">
                        {{ $warning_msg_count }}
                    </span>
                    <small>
                        <a href="{{ action('Logs@index') }}">
                            {{ trans('site.more_info') }}
                        </a>
                    </small>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red">
                    <i class="fa fa-bug" aria-hidden="true"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">
                        {{ trans('site.error_messages') }}
                    </span>
                    <span class="info-box-number">
                        {{ $error_msg_count }}
                    </span>
                    <small>
                        <a href="{{ action('Logs@index') }}">
                            {{ trans('site.more_info') }}
                        </a>
                    </small>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('site.recent_activity') }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>{{trans('site.date')}}</th>
                                <th>{{trans('log.message')}}</th>
                                <th>{{trans('log.level')}}</th>
                                <th>{{trans('log.stream')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recent_logs as $log)
                                <tr >
                                    <td>
                                        <a href="{{action('Logs@edit', $log->id)}}">
                                            {{$log->date}}
                                        </a>
                                    </td>
                                    <td>{{$log->message}}</td>
                                    <td>
                                        @include('logs.partials.level', ['level' => $log->level])
                                    </td>
                                    <td>
                                        {{$log->stream->name}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection