@extends('layouts.dashboard')
@section('content-header')
    <h1>
        {{trans('site.projects')}}
            <a href="{{action('Projects@create')}}" class="btn btn-default">
                <i class="fa fa-fw fa-plus"></i>
                {{trans('site.create')}}
            </a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {{ trans('site.dashboard') }}</a></li>
        <li class="active">{{ trans('site.projects') }}</li>
    </ol>
@endsection
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <table id="projects-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>{{trans('project.name')}}</th>
                    <th>{{trans('project.description')}}</th>
                    <th>{{trans('site.created_at')}}</th>
                    <th>{{trans('site.updated_at')}}</th>
                    <th></th>
                </tr>
                </thead>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
<script>
    $(function () {
        var table = $('#projects-table').DataTable({
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! action('Projects@ajax_list') !!}',
                data: function (d) {
                }
            },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            "order": [[0, "desc"]]
        });

        $('#filter-form').on('submit', function (e) {
            table.draw();
            e.preventDefault();
        });
    });
</script>
@endsection
