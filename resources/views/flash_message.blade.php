@if(session('success'))
    <div id="popupModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-gradient-success">
                <div class="modal-header"></div>
                <div class="modal-body">
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    @elseif(session('delete'))
    <div id="popupModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-gradient-danger">
                <div class="modal-header"></div>
                <div class="modal-body">
                    <div class="alert alert-danger text-center">
                        {{ session('delete') }}
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endif