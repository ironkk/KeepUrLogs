@if(Session::has('message'))
    <div class="alert alert-{{ Session::get('m-status') }} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>
            @if (Session::get('m-status') == "success")
                <i class="icon fa fa-check"></i> {{ trans('site.success') }}
            @elseif(Session::get('m-status') == "danger")
                <i class="icon fa fa-ban"></i> {{ trans('site.error') }}
            @else
                <i class="icon fa fa-info"></i> {{ trans('site.info') }}
            @endif
        </h4>
       {{ Session::get('message') }}
    </div>
@endif