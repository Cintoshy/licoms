    <!-- Edit User -->
    <div class="modal fade" id="EditDeparment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-light text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Program</h5>
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

                    <!-- Create Departmment -->
                    <div class="modal fade" id="CreateDepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-light text-dark mb-2">
                    <h5 class="modal-title" id="exampleModalLabel">Add Program</h5>
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

                    <form action="{{ route('admin.program.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 sm-0">
                                <input type="text" class="form-control form-control-user" id="name" name="name" value=""
                                    placeholder="Program" required>
                            </div>
                            <div class="col-sm-12 mb-3 sm-0">
                                <input type="text" class="form-control form-control-user" id="description" name="description" value=""
                                    placeholder="Description" required>
                            </div>

                            <div class="col-sm-12 sm-0">
                                <select class="form-control form-control-user" id="department" name="department" required>
                                    <option value="" disabled selected>Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{  $department->department_name }}">{{ $department->department_name }}</option>
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