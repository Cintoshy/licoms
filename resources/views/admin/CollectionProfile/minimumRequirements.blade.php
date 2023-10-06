<div class="modal fade" id="MinimumRequirements" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <th colspan="3">Minimum Requirements</th>
                        </tr>
                        <tr>
                            <th rowspan="3" colspan="2">Courses</th>
                            <th>5 books per Course</th>
                        </tr>
                        <tr>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>

                    @php
                        $previousCourseGroup = null;
                        $courseCount = 0;
                        $totalCourseCount = 0;
                    @endphp

                    @foreach ($groupedBooks as $courseId => $courseGroup)
                        @php
                            $currentCourseGroup = $courseGroup[0]->course->course_group;
                        @endphp

                        @if ($currentCourseGroup !== $previousCourseGroup)
                            @if ($previousCourseGroup !== null)
                                <tr>
                                    <td>{{ $previousCourseGroup }}</td>
                                    <td>{{ $courseCount }}</td>
                                    <td>{{ $courseCount * 5 }}</td>
                                </tr>
                            @endif

                            @php
                                $previousCourseGroup = $currentCourseGroup;
                                $courseCount = 1; // Reset the course count for the new group
                            @endphp
                        @else
                            @php
                                $courseCount++;
                            @endphp
                        @endif
                        @php
                            $totalCourseCount += $courseCount;
                            $minimumTotal = $totalCourseCount - 1;
                        @endphp
                    @endforeach

                    {{-- After the loop, display the total count for the last group --}}
                    <tr>
                        <td>{{ $previousCourseGroup }}</td>
                        <td>{{ $courseCount }}</td>
                        <td>{{ $courseCount * 5 }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><strong>Grand Total:</strong></td>
                        <td><strong>{{ $minimumTotal }}</strong></td>
                        <td><strong>{{ $minimumTotal * 5 }}</strong></td>
                    </tr>

                    </tbody>
                    
                </table>
                    </div>
                </div>
            </div>
        </div>
