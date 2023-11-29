@if(session('success'))
<div id="snackbar">{{ session('success') }}
<!-- <i class="fas fa-circle-check fa-2x text-success mt-3"></i> -->
<span class="closebtn" onclick="closeSnackbar()" style="cursor: pointer;">&times;</span>
</div>
@elseif(session('checked'))
<div id="snackbar">{{ session('checked') }}
<i class="fas fa-circle-check text-success ms-1"></i>
<span class="closebtn" onclick="closeSnackbar()" style="cursor: pointer;">&times;</span>
</div>
@elseif(session('reject'))
    <div id="snackbar">{{ session('reject') }}
        <i class="fas fa-ban text-light"></i>
        <span class="closebtn" onclick="closeSnackbar()" style="cursor: pointer;">&times;</span>
    </div>
    @elseif(session('delete'))
        <div id="snackbar"> {{ session('delete') }}
<i class="fas fa-trash text-primary ms-1"></i>
<span class="closebtn" onclick="closeSnackbar()" style="cursor: pointer;">&times;</span>
</div>
    @elseif(session('error'))
    <div id="popupModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-gradient-warning">
                <div class="modal-header"></div>
                <div class="modal-body">
                    <div class="alert alert-warning text-center">
                    <i class="fa-xl fa-solid fa-triangle-exclamation"></i>
                        {{ session('error') }}
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endif

