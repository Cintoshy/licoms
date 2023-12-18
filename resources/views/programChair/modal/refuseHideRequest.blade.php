<div class="modal fade" id="refuseHideBookRequestModal{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="refuseHideBookRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="refuseHideBookRequestModalLabel">Confirm Selection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to refuse the hide request in the book title <strong>"{{$book->title}}"</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="{{ route('pg.pg.refuseIgnoreRequest', $book->id) }}" class="btn btn-warning">Confirm</a>
            </div>
        </div>
    </div>
</div>
