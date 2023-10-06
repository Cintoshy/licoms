
<!-- DataTales Example -->
<div class="card shadow">  
    <div class="card-body">

        <form action="{{ route('admin.users.update', $employee) }}" method="POST">
            @csrf
            @method('PUT') <!-- Add this line to specify the method as PUT -->

            <div class="form-group row">
                <div class="col-sm-12 mb-6 mb-sm-0">
                    <h6> User Id</h6>
                    <input type="text" class="form-control form-control-user" id="id" name="id"
                        value="{{ $employee->id }}" placeholder="ID Number" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 sm-0">
                    <h6> Firstname</h6>
                    <input type="text" class="form-control form-control-user" id="first_name" name="first_name"
                        value="{{ $employee->first_name }}" placeholder="First Name" required>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <h6>Lastname</h6>
                    <input type="text" class="form-control form-control-user" id="last_name" name="last_name"
                        value="{{ $employee->last_name }}" placeholder="Last Name" required>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <h6> Email</h6>
                    <input type="text" class="form-control form-control-user" id="email" name="email"
                        value="{{ $employee->email }}" placeholder="Email" required>
                </div>
                <div class="col-sm-6 mb-3 sm-0">
                    <h6> Contact</h6>
                    <input type="text" class="form-control form-control-user" id="contact" name="contact"
                        value="{{ $employee->contact }}" placeholder="Contact" required>
                </div>
            <div class="col-sm-6">
                <h6> Role</h6>
                <select class="form-control form-control-user" id="role" name="role" required> <!-- Updated name attribute -->
                    <option value="" disabled>Type of User</option>
                    <option value="0" {{ $employee->role == 0 ? 'selected' : '' }}>Admin</option>
                    <option value="1" {{ $employee->role == 1 ? 'selected' : '' }}>Program Chair</option>
                    <option value="2" {{ $employee->role == 2 ? 'selected' : '' }}>Librarian</option>
                    <option value="3" {{ $employee->role == 3 ? 'selected' : '' }}>Faculty</option>
                </select>
            </div>
            <div class="col-sm-6">
                <h6> Assigned program</h6>
                <select class="form-control form-control-user" id="assigned_program" name="assigned_program">
                    <option value="">Assign Program</option>
                    @foreach ($allPrograms as $program)
                        <option value="{{ $program->name }}" {{ $employee->assigned_program == $program->name ? 'selected' : '' }}>{{ $program->name }}</option>
                    @endforeach
                </select>
            </div>

            </div>

            <button class="btn btn-primary btn-block">
                <i class="fas fa-plus"></i> Edit User
            </button>
        </form>