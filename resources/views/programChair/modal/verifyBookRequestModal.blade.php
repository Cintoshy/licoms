<div class="modal fade" id="verifyBookRequestModal{{$requestedBook->id}}" tabindex="-1" role="dialog" aria-labelledby="verifyBookRequestModalLabel{{$requestedBook->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-gradient-light text-dark">
                                <h5 class="modal-title">Verification</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    Are you sure you want to verify this book <strong>{{$requestedBook->book->title}}?</strong>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form method="POST" class="my-1" action="{{ route('pg-books.verified-status', $requestedBook->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


