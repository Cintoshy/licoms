<div class="modal fade" id="exportOptionsModal" tabindex="-1" role="dialog" aria-labelledby="exportOptionsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exportOptionsModalLabel">Export Options</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="container">
                <form id="reportForm" method="POST" action="{{ route('export-Books', ['param' => $programName ]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="page_size">Page Size:</label>
                        <select name="page_size" id="page_size" class="form-control">
                            <option value="A4">A4</option>
                            <!-- <option value="Letter">Letter</option> -->
                            <!-- Add more page size options if needed -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="orientation">Page Orientation:</label>
                        <select name="orientation" id="orientation" class="form-control">
                            <option value="portrait">Portrait</option>
                            <!-- <option value="landscape">Landscape</option> -->
                        </select>
                    </div>

               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submitReportForm()" data-dismiss="modal">Generate Report</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

