
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
                                <input type="text" class="form-control form-control-user" id="id" name="id" value=""
                                    placeholder="Id Number" required>
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
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="email" name="email" value=""
                                    placeholder="Email" required>
                            </div>
                            <div class="col-sm-6 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="contact" name="contact" value=""
                                    placeholder="Contact" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <select class="form-control form-control-user" id="role" name="role">
                                    <option value="" selected disabled>Type of User</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Program Chair</option>
                                    <option value="2">Librarian</option>
                                    <option value="3">Faculty</option>
                                </select>
                            </div>
                            <div class="col-sm-6 mb-sm-0">
                                <select class="form-control form-control-user" id="assigned_program" name="assigned_program">
                                    <option value="" disabled selected>Assign Program</option>
                                    @foreach ($allPrograms as $program)
                                        <option value="{{ $program->name }}">{{ $program->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            </div>
                        <button href="{{ route('admin.users.index') }}" class="btn btn-primary btn-block">
                            <i class="fas fa-plus"></i> Add User
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <h6 class="text-primary">LICOMS</h6>
                </div>
