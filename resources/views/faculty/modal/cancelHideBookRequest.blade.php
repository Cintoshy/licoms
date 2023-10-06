<div class="modal fade" id="hideBookRequestModal{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="hideBookRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hideBookRequestModalLabel">Confirm Selection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel the request to hide the book <strong>"{{$book->title}}"</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="{{ route('fac.RefuseHideRequest', $book->id) }}" class="btn btn-warning">Confirm</a>
            </div>
        </div>
    </div>
</div>
