
<div class="card shadow">  
        <div class="card-body">
        <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Add this line to specify the method as PUT -->

            <div class="form-group row">
                <div class="col-sm-12 mb-6 mb-sm-0">
                <h6>Book Id</h6>
                    <input type="text" class="form-control form-control-user" id="id" name="id"
                        value="{{ $book->id }}" placeholder="Book ID" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 sm-0">
                <h6>Bok Title</h6>
                    <input type="text" class="form-control form-control-user" id="title" name="title"
                        value="{{ $book->title }}" placeholder="Book Title" required>
                </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <h6>Author</h6>
                    <input type="text" class="form-control form-control-user" id="author" name="author"
                        value="{{ $book->author }}" placeholder="Author" required>
                </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <h6>Access No.</h6>
                    <input type="text" class="form-control form-control-user" id="access_no" name="access_no"
                        value="{{ $book->access_no }}" placeholder="Access No." required>
                </div>
            <div class="col-sm-6 mb-3 sm-0">
                <h6>Copy</h6>
                    <input type="text" class="form-control form-control-user" id="copy" name="copy"
                        value="{{ $book->copy }}" placeholder="Copy" required>
                </div>
            <div class="col-sm-6 mb-3 sm-0">
                <h6>Year</h6>
                    <input type="text" class="form-control form-control-user" id="year" name="year"
                        value="{{ $book->year }}" placeholder="Year" required>
                </div>
            <div class="col-sm-6 mb-3 sm-0">
                <h6>Publish</h6>
                    <input type="text" class="form-control form-control-user" id="publish" name="publish"
                        value="{{ $book->publish }}" placeholder="Publish" required>
                </div>

            </div>

            <button class="btn btn-primary btn-block">
                <i class="fas fa-plus"></i> Edit User
            </button>
        </form>
    </div>
</div>
