@extends('layouts.dashboard')
@section('content-header')
    <h1>
        {{trans('site.projects')}}
        <small>
            {{ $project->name }}
        </small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ action('Dashboard@index') }}">
                <i class="fa fa-dashboard"></i> {{ trans('site.dashboard') }}
            </a>
        </li>
        <li class="">
            <a href="{{ action('Projects@index') }}">
                {{ trans('site.projects') }}
            </a>
        </li>
        <li class="active">
                {{ $project->name }}
        </li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        {{ $project->name }}
                    </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">
                                {{trans('project.name')}}
                            </label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" class="form-control col-md-6" id="name" name="name"
                                       placeholder="{{trans('project.name')}}" value="{{$project->name}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">
                                {{trans('project.description')}}
                            </label>

                            <div class="col-sm-10 col-md-6">
                                <input type="text" class="form-control" id="description" name="description"
                                       placeholder="{{trans('project.description')}}" value="{{$project->description}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
