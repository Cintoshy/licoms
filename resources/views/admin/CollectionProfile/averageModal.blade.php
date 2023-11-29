<div class="modal fade" id="CompliedPercentage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header modal-dark text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Complied Percentage</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @php
                    $compiledPercentage = $grandTotalresultPercentage + $totalAdditionalPercentage;
                    @endphp

                <h1 class="display-1 text-danger text-center py-3">{{ number_format($compiledPercentage, 2) }}%</h1>
                <hr>
                <div>
                    <h6>Current Titles Needed: {{ $grandTotalTitlesNeeded  }}</h6>
                    <div class="mt-2">
                        <h6>Next Year Titles Needed: {{ $grandTotalNextTitlesNeeded }}</h6>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
        </div>
