    <!-- Edit Book -->
    <div class="modal fade" id="EditUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-light text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <h6 class="text-primary">LICOMS</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="EditBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-light text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Book</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <h6 class="text-primary">LICOMS</h6>
                </div>
            </div>
        </div>
    </div>

        <!-- Import Book -->
        <div class="modal fade" id="ImportBooks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-light text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Import</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container">

                        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Choose Excel File:</label>
                                <input type="file" name="file" class="form-control-file" accept=".xlsx, .xls">
                            </div>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD BOOKS -->
    <div class="modal fade" id="AddBooks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-light text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Add Book</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('admin.books.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="call_number" name="call_number" value=""
                                    placeholder="Call Number" required>
                            </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="title" name="title" value=""
                                    placeholder="Book" required>
                            </div>

                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="author" name="author" value=""
                                    placeholder="Author/Editor" required>
                            </div>

                            <div class="col-sm-6 mb-sm-0 mt-3">
                                <input type="text" class="form-control form-control-user" id="publish" name="publish" value=""
                                    placeholder="Publish" required>
                            </div>
                            <div class="col-sm-6 mt-3 sm-0">
                                <input type="text" class="form-control form-control-user" id="volume" name="volume" value=""
                                    placeholder="Volumesss" inputmode="numeric"  title="Enter a two-digit number" oninput="validateVolume(this)" required>
                            </div>
                            <div id="volumeFields"></div>


                            <div class="col-sm-6 mt-3 sm-0" style="max-height: 100px; overflow-y: auto;">
                                <select class="form-control form-control-user" id="year" name="year" required>
                                    <option>Select Year</option>
                                    
                                    <!-- Year options will be dynamically added using JavaScript -->
                                </select>
                            </div>
                            <!-- <div class="col-sm-6 my-3 sm-0">
                                <select class="form-control form-control-user" id="assigned_program" name="assigned_program" required>
                                    <option value="" disabled selected>Program</option>
                                </select>

                            </div> -->
                            


                        </div>
                        <button class="btn btn-primary btn-block">
                            <i class="fas fa-plus"></i> Add Book
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <h6 class="text-primary">LICOMS</h6>
                </div>
            </div>
        </div>
    </div>