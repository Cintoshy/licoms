<div class="modal fade" id="reportOptionsModal" tabindex="-1" role="dialog" aria-labelledby="reportOptionsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportOptionsModalLabel">Report Options</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="container">
                <form id="reportForm" method="POST" action="{{ route('export.collection-profile') }}">
                    @csrf
                    <div class="form-group">
                        <label for="page_size">Page Size:</label>
                        <select name="page_size" id="page_size" class="form-control">
                            <option value="A4">A4</option>
                            <option value="Letter">Letter</option>
                            <!-- Add more page size options if needed -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="orientation">Page Orientation:</label>
                        <select name="orientation" id="orientation" class="form-control">
                            <option value="portrait">Portrait</option>
                            <option value="landscape">Landscape</option>
                        </select>
                    </div>

                    <!-- <div class="form-group">
                        <label>Select Columns to Include:</label>
                        <div class="form-check">
                            <input type="checkbox" name="selected_columns[]" value="subject"> Subject
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="selected_columns[]" value="date"> Date
                        </div>

                    </div> -->
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submitReportForm()" data-dismiss="modal">Generate Report</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

