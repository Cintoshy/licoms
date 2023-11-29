
    <!-- Edit User -->
    <div class="modal fade" id="EditUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-light text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
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

        <!-- Create User -->
        <div class="modal fade" id="CreateUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-light text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
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

                    <form action="{{ route('admin.users.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-12 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="user_id" name="user_id" value=""
                                    placeholder="Employee ID" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 sm-0">
                                <input type="text" class="form-control form-control-user" id="first_name" name="first_name" value=""
                                    placeholder="First Name" required>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="last_name" name="last_name" value=""
                                    placeholder="Last Name" required>
                            </div>

                            <div class="col-sm-12 mb-3 sm-0">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-user" id="email" name="email"
                                        placeholder="CSPC Email" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">@cspc.edu.ph</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 mx-0 sm-0">
                                <input type="text" class="form-control form-control-user" id="contact" name="contact" value=""
                                    placeholder="Contact" oninput="validateContact(this)" required>
                                <span class="mb-5 text-danger" id="digitCountSign"></span>
                            </div>
                            <div class="col-sm-4 mb-3 sm-0">
                                <select class="form-control form-control-user" id="role" name="role" required>
                                    <option value="" selected disabled>Role</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Program Chair</option>
                                    <option value="2">Librarian</option>
                                    <option value="3">Faculty</option>
                                </select>
                            </div>

                            <div class="col-sm-4 mb-3 mx-0 sm-0 d-flex justify-content-end">
                                <select class="form-control form-control-user" id="assigned_program" name="assigned_program" style="display: none;" required>
                                    <option value="" disabled selected>Program</option>
                                    @foreach ($allPrograms as $program)
                                        <option value="{{ $program->name }}">{{ $program->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-4 mb-3 mx-0 sm-0 d-flex justify-content-end">
                                <select class="form-control form-control-user" id="assigned_department" name="assigned_department" style="display: none;" required>
                                    <option value="" disabled selected>Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->department_name }}">{{ $department->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                            <button href="{{ route('admin.users.index') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-plus"></i> Add User
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <h6 class="text-primary">LICOMS</h6>
                </div>
                <script>
                    // Get a reference to the role select element
                    var roleSelect = document.getElementById('role');

                    // Get references to the select elements that should be shown/hidden
                    var programSelect = document.getElementById('assigned_program');
                    var departmentSelect = document.getElementById('assigned_department');

                    // Add an event listener to the role select element
                    roleSelect.addEventListener('change', function () {
                        // Get the selected value
                        var selectedRole = roleSelect.value;

                        // Hide all select elements initially
                        programSelect.style.display = 'none';
                        departmentSelect.style.display = 'none';

                        programSelect.removeAttribute('required');
                        departmentSelect.removeAttribute('required');

                        // Based on the selected role, show the relevant select element
                        if (selectedRole === '1') {
                            programSelect.style.display = 'block';
                            programSelect.setAttribute('required', 'required'); // Add "required" for Program Chair
                        } else if (selectedRole === '2') {
                            departmentSelect.style.display = 'block';
                            departmentSelect.setAttribute('required', 'required'); // Add "required" for Librarian
                        }
                    });
                </script>