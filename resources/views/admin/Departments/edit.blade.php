
<!-- DataTales Example -->
<div class="card shadow">  
    <div class="card-body">

        <form action="{{ route('admin.department.update', $program) }}" method="POST">
            @csrf
            @method('PUT') <!-- Add this line to specify the method as PUT -->

            <div class="form-group row">
                <div class="col-sm-12 mb-6 mb-sm-0">
                    <h6> Department Id</h6>
                    <input type="text" class="form-control form-control-user" id="id" name="id"
                        value="{{ $program->id }}" placeholder="Department Code" readonly>
                </div>
            </div>
            <div class="form-group row">
            <div class="col-sm-6 mb-3 sm-0">
                    <h6> Department Code</h6>
                    <input type="text" class="form-control form-control-user" id="code" name="code"
                        value="{{ $program->code }}" required>
                </div>
                <div class="col-sm-6 mb-3 sm-0">
                    <h6> Department</h6>
                    <input type="text" class="form-control form-control-user" id="department" name="department"
                        value="{{ $program->department }}"required>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <h6>Program</h6>
                    <input type="text" class="form-control form-control-user" id="name" name="name"
                        value="{{ $program->name }}"required>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <h6> Description</h6>
                    <input type="text" class="form-control form-control-user" id="description" name="description"
                        value="{{ $program->description }}"required>
                </div>

            </div>

            <button class="btn btn-primary btn-block">
                <i class="fas fa-plus"></i> Edit User
            </button>
        </form>