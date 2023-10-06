<div class="modal fade" id="cancelVerifiedBookModal{{$requestedBook->id}}" tabindex="-1" role="dialog" aria-labelledby="cancelVerifiedBookModalLabel{{$requestedBook->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-gradient-light text-dark">
                                <h5 class="modal-title">Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    Are you sure you want to return the previous status of the book <strong>{{$requestedBook->book->title}}</strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form method="POST" action="{{ route('pg-cancelVerified-status', $requestedBook->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-warning w-100">Confirm</button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>


