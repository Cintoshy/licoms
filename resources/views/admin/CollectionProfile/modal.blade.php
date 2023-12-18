<div class="modal fade" id="CAS{{$department->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-light text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Select course to view records</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                @php
                    $assignedDepartment = $department->department_name;
                    $programs = App\Models\Program::where('department', $assignedDepartment)->get();
                @endphp
                @foreach($programs as $program)
                <a class="btn btn-dark btn-block mb-3" href="{{ route('admin.CollectionProfile.index', ['param' => $program->name]) }}">{{$program->description}}</a>
                @endforeach 
                </div>
                <div class="modal-footer">
                    <h6 class="text-primary">LICOMS</h6>
                </div>
            </div>
        </div>
    </div>