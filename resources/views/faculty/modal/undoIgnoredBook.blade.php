<div class="modal fade" id="undoIgnoredBook{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="undoIgnoredBookLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="undoIgnoredBookLabel">Confirm Selection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to undo this ignored book <strong>"{{$book->title}}"</strong>? This action will be display the book again in the Evaluation.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="{{ route('fac.undoIgnoredBook', $book->id) }}" class="btn btn-warning">Confirm</a>
            </div>
        </div>
    </div>
</div>
