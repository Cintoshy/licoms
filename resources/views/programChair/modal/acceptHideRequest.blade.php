<div class="modal fade" id="acceptBookHideRequest{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="acceptBookHideRequestLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="acceptBookHideRequestLabel">Confirm Selection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <p>Confirming this action will mark the book <strong>"{{$book->title}}"</strong> as ignored by programs.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>
