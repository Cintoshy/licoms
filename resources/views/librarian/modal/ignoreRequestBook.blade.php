<div class="modal fade" id="ignoreBookModal{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="ignoreBookModal{{$book->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-gradient-light text-dark">
                                <h5 class="modal-title">Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <p>Are you sure you want ignore this book <strong>{{$book->title}}?</strong> This request will be redirect in the program chair page.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form action="{{ route('lib.books.ignoreBook', ['id' => $book->id, 'param' => $programId]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


