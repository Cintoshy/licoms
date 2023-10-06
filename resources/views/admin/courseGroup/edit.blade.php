
<!-- DataTales Example -->
<div class="card shadow">  
    <div class="card-body">

        <form action="{{ route('admin.courseGroup.update', $courseGroup) }}" method="POST">
            @csrf
            @method('PUT') <!-- Add this line to specify the method as PUT -->

            <div class="form-group row">
                <div class="col-sm-12 mb-6 mb-sm-0">
                    <h6> Course Group Id</h6>
                    <input type="text" class="form-control form-control-user" id="id" name="id"
                        value="{{ $courseGroup->id }}" readonly>
                </div>
            </div>
            <div class="form-group row">
            <div class="col-sm-6 mb-3 sm-0">
                    <h6> Course Group</h6>
                    <input type="text" class="form-control form-control-user" id="course_group" name="course_group"
                        value="{{ $courseGroup->course_group }}" required>
                </div>
                <div class="col-sm-6 mb-3 sm-0">
                    <h6>Description</h6>
                    <input type="text" class="form-control form-control-user" id="description" name="description"
                        value="{{ $courseGroup->description }}"required>
                </div>
            </div>

            <button class="btn btn-primary btn-block">
                <i class="fas fa-pencil"></i> Edit Course Group
            </button>
        </form>