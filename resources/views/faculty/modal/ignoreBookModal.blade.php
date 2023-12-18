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
                            <p>Confirming this action will mark the book <strong>{{$book->title}}</strong> as ignored by programs.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form action="{{ route('fac.books.ignoreBook', $book->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


