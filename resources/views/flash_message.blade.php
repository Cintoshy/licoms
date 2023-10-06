@if(session('success'))


<div id="snackbar">{{ session('success') }}
<!-- <i class="fas fa-circle-check fa-2x text-success mt-3"></i> -->
</div>
@elseif(session('checked'))


<div id="snackbar">{{ session('checked') }}
<i class="fas fa-circle-check text-success ms-1"></i>
</div>
@elseif(session('reject'))


<div id="snackbar">{{ session('reject') }}
<i class="fas fa-ban text-light"></i>
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
    @elseif(session('error'))
    <div id="popupModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-gradient-warning">
                <div class="modal-header"></div>
                <div class="modal-body">
                    <div class="alert alert-warning text-center">
                        {{ session('error') }}
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endif

