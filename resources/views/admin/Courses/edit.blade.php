
<!-- DataTales Example -->
<div class="card shadow">  
    <div class="card-body">

        <form action="{{ route('admin.course.update', $course) }}" method="POST">
            @csrf
            @method('PUT') <!-- Add this line to specify the method as PUT -->

            <div class="form-group row">
                <div class="col-sm-12 mb-6 mb-sm-0">
                    <h6> Course Id</h6>
                    <input type="text" class="form-control form-control-user" id="id" name="id"
                        value="{{ $course->id }}" readonly>
                </div>
            </div>
            <div class="form-group row">
            <div class="col-sm-6 mb-3 sm-0">
                    <h6> Course Code</h6>
                    <input type="text" class="form-control form-control-user" id="course_code" name="course_code"
                        value="{{ $course->course_code }}" required>
                </div>
                <div class="col-sm-6 mb-3 sm-0">
                    <h6> Course Name</h6>
                    <input type="text" class="form-control form-control-user" id="course_title" name="course_title"
                        value="{{ $course->course_title }}"required>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <h6>Course Level</h6>
                    <input type="text" class="form-control form-control-user" id="course_level" name="course_level"
                        value="{{ $course->course_level }}"required>
                </div>
            </div>

            <button class="btn btn-primary btn-block">
                <i class="fas fa-plus"></i> Edit User
            </button>
        </form>