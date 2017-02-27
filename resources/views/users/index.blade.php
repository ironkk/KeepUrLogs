@extends('layouts.dashboard')
@section('content-header')
    <h1>
        {{ trans('admin.users') }}
        <a href="{{action('Admin\Users@create')}}" class="btn btn-default">
            <i class="fa fa-fw fa-plus"></i>
            {{ trans('admin.add_user') }}
        </a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {{ trans('site.dashboard') }}</a></li>
        <li class="active">{{ trans('site.users') }}</li>
    </ol>
@endsection
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <table id="users-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>{{trans('site.name')}}</th>
                    <th>{{trans('site.last_name')}}</th>
                    <th>{{trans('site.level')}}</th>
                    <th></th>
                </tr>
                </thead>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

</section>
<!-- /.content -->
@include('partials.destroyrecord')
<script>
    $(function () {
        var table = $('#users-table').DataTable({
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! action('Admin\Users@ajax_list') !!}',
                data: function (d) {
                }
            },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'lastname', name: 'lastname'},
                {data: 'level_id', name: 'level_id'},
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
