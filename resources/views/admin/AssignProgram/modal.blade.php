                <!-- Create Departmment -->
    <div class="modal fade" id="CreateDepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-light text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Add Department & Program</h5>
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

                    
                    <div class="d-flex justify-content-end mt-0 mb-3">
                    <a class="btn btn btn-info btn-sm " href="{{ route('admin.program.index') }}">
                         <span class="text">Go to Department list
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </span>
                    </a>
                    </div>
                    <hr class="my-3">

                    <form action="{{ route('admin.department.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="code" name="code" value=""
                                    placeholder="Department Code" required>
                            </div>
                            <div class="col-sm-6 mb-3 sm-0">
                                <input type="text" class="form-control form-control-user" id="name" name="name" value=""
                                    placeholder="Program" required>
                            </div>

                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="department" name="department" value=""
                                    placeholder="Department" required>
                            </div>
                            <div class="col-sm-6 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="description" name="description" value=""
                                    placeholder="Description" required>
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

                    <div class="d-flex justify-content-end mt-0 mb-3">
                    <a class="btn btn btn-info btn-sm " href="{{ route('admin.course.index') }}">
                         <span class="text">Go to Course list
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </span>
                    </a>
                    </div>
                    <hr class="my-3">

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

                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="course_level" name="course_level" value=""
                                    placeholder="Course Level" required>
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