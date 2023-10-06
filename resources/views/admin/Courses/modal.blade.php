    <!-- Edit User -->
    <div class="modal fade" id="EditCourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-light text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Course</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <h6 class="text-primary">LICOMS</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Course -->
    <div class="modal fade" id="CreateCourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-light text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Add Course</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (isset($validation))
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($validation as $validation)
                                    <li>{{ esc($validation) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.courses.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                        <div class="col-sm-12 mb-3 sm-0">
                                <input type="text" class="form-control form-control-user" id="course_code" name="course_code" value=""
                                    placeholder="Course Code" required>
                            </div>
                            <div class="col-sm-12 mb-3 sm-0">
                                <input type="text" class="form-control form-control-user" id="course_title" name="course_title" value=""
                                    placeholder="Course Name" required>
                            </div>
                            <div class="col-sm-12 mb-3 sm-0">
                                <select class="form-control form-control-user" id="course_group" name="course_group" required>
                                    <option value="" disabled selected>Course Group</option>
                                    @foreach ($courseGroups as $courseGroup)
                                        <option value="{{ $courseGroup->course_group }}">{{ $courseGroup->course_group }}</option>
                                    @endforeach
                                </select>

                            </div>
                            

                            <div class="col-sm-12 mb-3 sm-0">
                            <select class="form-control form-control-user" id="course_level" name="course_level" required>
                                    <option value="" disabled selected>Course Level</option>
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                                </select>
                            </div>
                            <div class="col-sm-12 sm-0">
                                <select class="form-control form-control-user" id="assigned_program" name="assigned_program" required>
                                    <option value="" disabled selected>Program</option>
                                    @foreach ($programs as $program)
                                        <option value="{{ $program->name }}">{{ $program->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            </div>
                        <button class="btn btn-primary btn-block">
                            <i class="fas fa-plus"></i> Add
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <h6 class="text-primary">LICOMS</h6>
                </div>