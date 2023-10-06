
<div class="card shadow">  
        <div class="card-body">
        <form action="{{ route('admin.books.update', $book->id) }}" method="POST">

            @csrf
            @method('PUT') <!-- Add this line to specify the method as PUT -->
            <div class="form-group row">
                <div class="col-sm-12 mb-6 mb-sm-0">
                <h6>Call Number</h6>
                    <input type="text" class="form-control form-control-user" id="call_number" name="call_number"
                        value="{{ $book->call_number }}" placeholder="Book ID" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 sm-0">
                <h6>Book Title</h6>
                    <textarea type="text" class="form-control form-control-user" id="title" name="title" rows="3"
                     placeholder="Book Title" required>{{ $book->title }}</textarea>
                </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <h6>Author</h6>
                    <textarea type="text" class="form-control form-control-user" id="author" name="author"
                     placeholder="Author" required>{{ $book->author }}</textarea>
                </div>
                <div class="col-sm-6 mb-3 sm-0">
                    <h6>Volume</h6>
                    <input type="text" class="form-control form-control-user" id="volume" name="volume"
                        value="{{ $book->volume }}" placeholder="Volume" required>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="access_no">Access No.</label>
                    <textarea class="form-control form-control-user" id="access_no" name="access_no"
                        placeholder="Access No." required>{{ implode(', ', json_decode($book->access_no)) }}
                    </textarea>
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
                <i class="fas fa-plus"></i> Edit Book
            </button>
        </form>
    </div>
</div>
