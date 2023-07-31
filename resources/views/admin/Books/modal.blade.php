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
                                <input type="text" class="form-control form-control-user" id="id" name="id" value=""
                                    placeholder="Book Number" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 sm-0">
                                <input type="text" class="form-control form-control-user" id="cn" name="cn" value=""
                                    placeholder="Call Number" required>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="access_no" name="access_no" value=""
                                    placeholder="Accession Number" required>
                            </div>
                            <div class="col-sm-6 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="title" name="title" value=""
                                    placeholder="Title" required>
                            </div>
                            <div class="col-sm-6 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="copy" name="copy" value=""
                                    placeholder="Copy" required>
                            </div>
                            <div class="col-sm-6 mt-3 sm-0">
                                <input type="text" class="form-control form-control-user" id="author" name="author" value=""
                                    placeholder="Author">
                            </div>
                            <div class="col-sm-6 mb-5 mt-3 mb-sm-0">
                                <select class="form-control form-control-user" id="year" name="year" required>
                                    <option value="" selected disabled>Year</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                </select>
                            </div>
                            <div class="col-sm-6 mt-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="publish" name="publish" value=""
                                    placeholder="Publish" required>
                            </div>
                            <div class="col-sm-6 mt-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="cc" name="cc" value=""
                                    placeholder="CC" required>
                            </div>
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