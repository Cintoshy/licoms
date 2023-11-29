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
                            <th>{{$minimumreq}} books per Course</th>
                        </tr>
                        <tr>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>

                    @php
                        $courseCounts = [];
                        $previousCourseGroup = null;
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
                                        <td>{{ $courseCounts[$previousCourseGroup] }}</td>
                                        <td>{{ $courseCounts[$previousCourseGroup] * $minimumreq }}</td>
                                    </tr>
                                @endif

                                @php
                                $previousCourseGroup = $currentCourseGroup;
                                if (!isset($courseCounts[$currentCourseGroup])) {
                                    $courseCounts[$currentCourseGroup] = 1;
                                } else {
                                    $courseCounts[$currentCourseGroup]++;
                                }
                                @endphp
                            @else
                                @php
                                $courseCounts[$currentCourseGroup]++;
                                @endphp
                            @endif
                            @php
                            $totalCourseCount++;
                            $minimumTotal = $totalCourseCount;
                            @endphp
                        @endforeach

                        {{-- After the loop, display the total count for the last group --}}
                        <tr>
                            <td>{{ $previousCourseGroup }}</td>
                            <td>{{ $courseCounts[$previousCourseGroup] ?? 0 }}</td>
                            <td>{{ ($courseCounts[$previousCourseGroup] ?? 0) * $minimumreq }}</td>
                        </tr>

                        {{-- Display the grand total by adding up all course counts --}}
                        <tr>
                            <td style="text-align: right;"><strong>Grand Total:</strong></td>
                            <td><strong>{{ $totalCourseCount }}</strong></td>
                            <td><strong>{{ $totalCourseCount * $minimumreq }}</strong></td>
                        </tr>

                    </tbody>
                    
                </table>
                    </div>
                </div>
            </div>
        </div>
