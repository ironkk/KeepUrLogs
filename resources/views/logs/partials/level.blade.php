@if($level == 1)
    <div class="label label-info loglabel">
        <i class="fa fa-lg fa-fw fa-info" aria-hidden="true"></i>
        {{trans('log.level_info')}}
    </div>
@elseif($level == 2)
    <div class="label label-warning loglabel">
        <i class="fa fa-lg fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
        {{trans('log.level_warning')}}
    </div>
@elseif($level == 3)
    <div class="label label-danger loglabel">
        <i class="fa fa-lg fa-fw fa-bug" aria-hidden="true"></i>
        {{trans('log.level_error')}}
    </div>
@endif