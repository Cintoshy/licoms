
<!-- DataTales Example -->
<div class="card shadow">  
    <div class="card-body">

        <form action="{{ route('admin.department.update', $department) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Add this line to specify the method as PUT -->

            <div class="form-group row">
                <div class="col-sm-12 mb-6 mb-sm-0">
                    <h6> Department Id</h6>
                    <input type="text" class="form-control form-control-user" id="id" name="id"
                        value="{{ $department->id }}" placeholder="Department Code" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <h6>Department</h6>
                    <input type="text" class="form-control form-control-user" id="department_name" name="department_name"
                        value="{{ $department->department_name }}"  readonly>
                </div>
                <div class="col-sm-6 mb-3 sm-0">
                    <h6> Description</h6>
                    <input type="text" class="form-control form-control-user" id="description" name="description"
                        value="{{ $department->description }}"required>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                        <h6>Existing Logo:</h6>
                        @if ($department->logo)
                            <img src="{{ asset('storage/' . $department->logo) }}" alt="Department Logo" width="50">
                        @else
                            <p class="text-warning fw-bold">No existing logo.</p>
                        @endif
                    </div>

                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <h6>Upload New Logo</h6>
                        <input type="file" id="logo" name="logo" accept=".jpg, .jpeg, .png, .svg">
                    </div>


            </div>

            <button class="btn btn-primary btn-block">
                <i class="fas fa-plus"></i> Edit Department
            </button>
        </form>