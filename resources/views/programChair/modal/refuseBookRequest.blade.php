<div class="modal fade" id="refuseBookRequestModal{{$requestedBook->id}}" tabindex="-1" role="dialog" aria-labelledby="refuseBookRequestModalModalLabel{{$requestedBook->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-gradient-light text-dark">
                                <h5 class="modal-title">Confirmation 111</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    Are you sure you want to refuse the request for this book <strong>{{$requestedBook->book->title}}?</strong>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form method="POST" class="m-0" action="{{ route('pg-books.refuse-status', $requestedBook->id) }}">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-warning">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>