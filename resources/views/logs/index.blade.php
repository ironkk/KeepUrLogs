@extends('layouts.dashboard')
@section('content-header')
    <h1>
        {{trans('site.logs')}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> {{ trans('site.dashboard') }}</a></li>
        <li class="active">{{ trans('site.logs') }}</li>
    </ol>
@endsection
@section('content')
    <!-- Your Page Content Here -->
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form" id="filter-form">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputName2">{{ trans('site.from') }}</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker"
                                       id="date_from_filter" data-date-format="yyyy-mm-dd">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputName2">{{ trans('site.to') }}</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker"
                                       id="date_to_filter" data-date-format="yyyy-mm-dd">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputEmail2">{{ trans('log.level') }}</label>
                            <select class="select2" name="level_filter" id="level_filter">
                                @foreach($levels as $key => $level)
                                    <option value="{{ $key }}"> {{ $level }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputEmail2">{{ trans('log.stream') }}</label>
                            <select class="select2" name="stream_filter" id="stream_filter">
                                @foreach($streams as $key => $stream)
                                    <option value="{{ $key }}"> {{ $stream }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label>{{ trans('site.from') }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker" id="time_from_filter" data-default-time="00:00">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label>{{ trans('site.to') }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker" id="time_to_filter" data-default-time="23:00">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        {{ trans('site.search') }}
                    </button>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered table-striped" id="logs-table">
                <thead>
                <tr>
                    <th>{{trans('site.date')}}</th>
                    <th>{{trans('log.message')}}</th>
                    <th>{{trans('log.have_diff')}}</th>
                    <th>{{trans('log.level')}}</th>
                    <th>{{trans('log.stream')}}</th>
                    <th></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->
<script>
    $(function () {
        var table = $('#logs-table').DataTable({
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! action('Logs@ajax_list') !!}',
                data: function (d) {
                    d.date_from = $('#date_from_filter').val();
                    d.time_from = $('#time_from_filter').val();
                    d.date_to = $('#date_to_filter').val();
                    d.time_to = $('#time_to_filter').val();
                    d.level = $('#level_filter').val();
                    d.stream = $('#stream_filter').val();
                }
            },
            columns: [
                {data: 'date', name: 'date'},
                {data: 'message', name: 'message'},
                {data: 'have_diff', name: 'have_diff'},
                {data: 'level', name: 'level'},
                {data: 'stream', name: 'stream_id'},
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
