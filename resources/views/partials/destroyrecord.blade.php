<div class="modal fade" id="confirmDestroy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ trans('site.destroyrecord_modal_header') }}</h4>
            </div>
            <div class="modal-body">
                {{ trans('site.destroyrecord_modal_body') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('site.close') }}</button>
                <button type="button" id="destroy-record-button" class="btn btn-danger" onclick="destroyRecord()">{{ trans('site.destroy_record') }}</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#confirmDestroy').on('show.bs.modal', function(e) {
        var recordId = $(e.relatedTarget).data('record-id');

        $("#destroy-record-button").click(function() {
            destroyRecord(recordId)
        });
    });
    function destroyRecord(id) {
        $("#destroyRecordForm-"+id).submit();
    }
</script>