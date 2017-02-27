
<div class="text-center">
    @if ($delete)
    <form id="destroyRecordForm-{{$id}}" action="{{ route($controller.".destroy",$id) }}" method="POST" class="form-inline">
    @endif
    @if ($edit)
        <a href="{{ route($controller.'.edit', $id) }}" class="btn btn-sm btn-primary">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{ trans('site.edit') }}
        </a>
    @endif

        @if ($delete)
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <div data-toggle="modal" data-target="#confirmDestroy" data-record-id="{{ $id }}" class="btn btn-sm btn-danger">
                    <i class="fa fa-trash" aria-hidden="true"></i> {{ trans('site.delete') }}
                </div>
        @endif

    @if ($delete)
        </form>
    @endif
</div>