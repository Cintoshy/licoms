<div class="modal fade" id="cancelSelectedBookModal{{$requestedBook->id}}" tabindex="-1" role="dialog" aria-labelledby="cancelSelectedBookModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelSelectedBookModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel your selected book <strong class="font-italic">"{{$requestedBook->book->title}}"</strong> in the course subject <strong>"{{$requestedBook->course->course_code}}"</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>
