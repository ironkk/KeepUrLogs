<div class="text-center" style="font-size: 13px;">
    @if($active)
        <div class="label label-success">
            {{ trans('site.yes') }}
        </div>
    @else
        <div class="label label-danger">
            {{ trans('site.no') }}
        </div>
    @endif
</div>
