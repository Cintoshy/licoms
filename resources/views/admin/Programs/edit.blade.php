
<!-- DataTales Example -->
<div class="card shadow">  
    <div class="card-body">

        <form action="{{ route('admin.program.update', $program) }}" method="POST">
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
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <h6>Program</h6>
                    <input type="text" class="form-control form-control-user" id="name" name="name"
                        value="{{ $program->name }}"readonly    >
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <h6> Description</h6>
                    <input type="text" class="form-control form-control-user" id="description" name="description"
                        value="{{ $program->description }}"required>
                </div>
                <div class="col-sm-6 my-3 mb-sm-0">
                    <h6> Department</h6>
                    <select class="form-control form-control-user" id="department" name="department" required>
                    @foreach ($departments as $department)
                        <option value="{{ $department->department_name }}" {{ $department->department_name == $department->department_name ? 'selected' : '' }}>{{ $department->department_name }}</option>
                    @endforeach
                                </select>
                </div>
                <div class="col-sm-6 my-3 mb-sm-0">
                    <h6> Minimimum Req</h6>
                    <input type="number" class="form-control form-control-user" id="minimum_req" name="minimum_req"
                        value="{{ $program->minimum_req }}" min="1" max="10" required>
                </div>

            </div>

            <button class="btn btn-primary btn-block">
                <i class="fas fa-pencil"></i> Edit Program
            </button>
        </form>