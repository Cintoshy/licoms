<div class="modal fade" id="ActivieCollection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header modal-dark text-dark">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered text-center table-secondary text-dark" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th colspan="3">Active Collection</th>
                            </tr>
                            <tr>
                                <th>Course Group</th>
                                <th>Total Titles</th>
                                <th>Total Volumes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $grandTotalTitles = 0;
                                $grandTotalVolumes = 0;
                            @endphp

                            @foreach ($courseGroupsssBooksTitle as $courseId => $courseGroup)
                                @php
                                    $totalTitles = $courseGroup->sum('total_titles');
                                    $totalVolumes = $courseGroup->sum('total_volumes');
                                    $grandTotalTitles += $totalTitles;
                                    $grandTotalVolumes += $totalVolumes;
                                @endphp

                                <tr>
                                    <td>{{ $courseId }}</td>
                                    <td>{{ $totalTitles }}</td>
                                    <td>{{ $totalVolumes }}</td>
                                </tr>
                            @endforeach

                            {{-- Display the grand totals --}}
                            <tr>
                            <td style="text-align: right;"><strong>Grand Total:</strong></td>
                                <td><strong>{{ $grandTotalTitles }}</strong></td>
                                <td><strong>{{ $grandTotalVolumes }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
