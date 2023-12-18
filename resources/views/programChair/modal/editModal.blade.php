<div class="modal fade" id="editCC{{$requestedBook->id}}" tabindex="-1" role="dialog" aria-labelledby="editCCLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCCLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-group row">
                <div class="col">
                    <form method="post" action="{{ route('pg.editCourseCode', $requestedBook->id)}}">
                        @csrf
                        @method('PUT')
                    <h6 class="fw-bold">Course Code - Course:</h6>
                    <select type="text" class="form-control form-control-user" id="dropdown-options" name="course_id"  required>
                                <option>Select</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->course_code }}">{{ $course->course_code }} - {{ $course->course_title }}</option>
                                    @endforeach
            </select>
            
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
            </form>
        </div>
    </div>
</div>
