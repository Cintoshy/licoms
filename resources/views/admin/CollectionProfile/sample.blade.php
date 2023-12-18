@extends('layout.layout')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header mb-3">
        <div class="row d-flex align-items-center my-3">    
            <div class="col-sm-6 d-flex">
                <h1 class="display-6 fw-bolder text-uppercase">Collection Profile</h1>
            </div>
            <div class="col-sm-6">
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#reportOptionsModal">
                    Generate Report
                    <i class="fas fa-download fa-sm text-white-50"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="container-fluid">
    <div class="row">
        <div class="col">
        <table class="table table-bordered table-sm text-center table-secondary text-dark" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="3">Minimum Requirements</th>
                        </tr>
                        <tr>
                            <th rowspan="2" colspan="2">Courses</th>
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
        <div class="col">
        <table class="table table-bordered text-center table-sm table-secondary text-dark" width="100%" cellspacing="0">
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
        @php    
                    $previousCourseGroup = null;
                    $TotalresultPercentage = 0; 
                    $grandTotalTitlesNeeded = 0;
                    $grandTotalNextTitlesNeeded = 0;
                    $rowCount = 0;
                    $additionalPercentage = 0;
                    $allTitlesGrantTotal = 0;
                    $courseGroups = collect();
                    $grandTotalresultPercentage = 0;
                    $totalAdditionalPercentage = 0;

                @endphp
            <div class="col">
                <table class="table table-sm table-secondary text-dark" width="100%" cellspacing="0">
                    <tr>
                        <td class="fw-bold text-center">COMPILED PERCENTAGE</td>
                    </tr>
                    <tr>
                        <td class="display-6 text-danger text-center py-3">{{number_format($compiledPercentage, 2)}}%</td>
                    </tr>
                    <tr>
                        <td>Curent Titles Needed:</td>
                    </tr>
                    <tr>
                        <td>Next Year Titles Needed:</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="collectonProfile" width="100%" cellspacing="0" padding="0%">
                <thead class="bg-gradient-info text-light">
                    <tr>
                    <!-- <th colspan="2" rowspan="2">{{$books->first()->course->assigned_program ?? $ProgramCode}}</th> -->
                        <th colspan="2" rowspan="2">{{$ProgramCode}}</th>
                        <th colspan="2"></th>
                        <th colspan="10">WITHIN PRESCRIBED 5 YEARS COPYRIGHT</th>
                        <th rowspan="2" colspan="2">Grand Total</th>
                        <th rowspan="3">% Per Subject</th>
                        <th rowspan="3" width="10%">Titles Needed (2023)</th>
                        <th rowspan="3" width="10%">Titles Needed (2024)</th>
                        <th rowspan="2" colspan="2">{{$fiveYearsAgo->year}} Below</th>
                    </tr>
                    <tr>
                        @foreach (array_reverse($years) as $year)
                            <th colspan="2">{{ $year }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Code</th>
                        <th>Courses</th>
                        <th>T</th>
                        <th>V</th>
                        @foreach (array_reverse($years) as $year)
                            <th>T</th>
                            <th>V</th>
                        @endforeach
                        <th>T</th>
                        <th>V</th>
                    </tr>
                </thead>

                @foreach ($groupedBooks as $courseId => $courseGroup)
                    @php
                        
                        $grandTotalTitles = 0;
                        $grandTotalVolumes = 0;
                        $excessTitles = 0;
                        $currentCourseGroup = $courseGroup[0]->course->course_group;
                        $rowCount++
                        
                    @endphp
                    @if ($courseGroup[0]->course->course_group !== $previousCourseGroup)
                    @php
                    $courseGroups->push($currentCourseGroup);

                    @endphp
                        <tr class="text-dark fw-bolder table-dark">
                            <td colspan="30" style="text-align: left;">

                                {{ $currentCourseGroup }} 
                               
                            </td>
                        </tr>
                        @php
                            $previousCourseGroup = $courseGroup[0]->course->course_group;
                        @endphp
                    @endif
                    <tr class="table-danger">
                        <td width="8%">{{$courseGroup->first()->course->course_code}}</td>
                        <td width="30%">{{$courseGroup->first()->course->course_title}}</td>
                        @foreach (array_reverse($years) as $year)
                            @php
                                $totalTitles = 0;
                                $totalVolumes = 0;
                                $lastYearToRemoveData = reset($years);
                            @endphp
                            @foreach ($courseGroup as $book)
                                @if ($book->book_year == $year)
                                    @php
                                        $totalTitles += $book->total_titles;
                                        $totalVolumes += $book->total_volumes;
                                    @endphp
                                @endif
                            @endforeach
                            <td>{{ $totalTitles }}</td>
                            <td>{{ $totalVolumes }}</td>
                            @php
                                $grandTotalTitles += $totalTitles;
                                $grandTotalVolumes += $totalVolumes;
                                $result = ($grandTotalTitles >= $minimumreq) ? 100 : ($grandTotalTitles * 20);

                                $excessTitles = ($grandTotalTitles >= $minimumreq) ? ($grandTotalTitles - $minimumreq) : 0;

                                if ($excessTitles > 0) {
                                    // Calculate the excessTitles percentage
                                    $percentage = ($excessTitles <= $minimumreq) ? ($excessTitles * 20) : 100;
                                } else {
                                    $percentage = 0;
                                }
                            @endphp
                        @endforeach
                        <td width="7%">{{ $grandTotalTitles }}</td>
                        <td width="7%">{{ $grandTotalVolumes }}</td>
                        <td width="7%">{{ $result }}%</td>
                        @php
                        $additionalPercentage += $percentage;
                        $TotalresultPercentage += $result;
                        $grandTotalresultPercentage = $TotalresultPercentage / $rowCount;
                        $totalAdditionalPercentage = $additionalPercentage / $rowCount;

                        if ($grandTotalTitles >= $minimumreq) {
                            $titleNeeded = 0;
                        } else {
                            $titleNeeded = $minimumreq - $grandTotalTitles;
                        }
                        @endphp
                        <td>{{ $titleNeeded }}
                        </td>
                        @php
                    $nextTotalTitlesNeeded = 0;
                    $advanceyear = 0;
                    @endphp

                    @foreach ($courseGroup as $book)
                        @php
                        $nextTotalTitlesNeeded = ($book->book_year == $lastYearToRemoveData) ? $book->total_titles : $nextTotalTitlesNeeded;
                        $advanceyear = ($book->book_year == 2024);
                        @endphp
                    @endforeach

                    <td>{{ max(0, $nextTotalTitlesNeeded - $advanceyear) }}</td>
                            <!-- <td>
                                @php
                                    $yearsss = 2019;
                                    $grandTotalTitlesNeeded += $titleNeeded;
                                    $nextTotalTitlesNeeded = ($yearsss == $lastYearToRemoveData) ? $book->total_titles : 0;
                                @endphp
                                {{ $nextTotalTitlesNeeded }}
                            </td> -->
                        @php
                            $grandTotalNextTitlesNeeded += $nextTotalTitlesNeeded;
                            $totalTitlesBelow = 0;
                            $totalVolumesBelow = 0;
                        @endphp
                        @foreach (array_reverse($fiveYearsBelow) as $year)
                            @php
                                $totalTitlesss = 0;
                                $totalVolumesss = 0;
                            @endphp
                            @foreach ($courseGroup as $book)
                                @if ($book->book_year == $year)
                                    @php
                                        $totalTitlesss += $book->total_titles;
                                        $totalVolumesss += $book->total_volumes;
                                    @endphp
                                @endif
                            @endforeach
                            @php
                                $totalTitlesBelow += $totalTitlesss;
                                $totalVolumesBelow += $totalVolumesss;
                            @endphp
                        @endforeach
                        <td>{{ $totalTitlesBelow }}</td>
                        <td>{{ $totalVolumesBelow }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@include('admin.CollectionProfile.minimumRequirements')
@include('admin.CollectionProfile.averageModal')
@include('admin.CollectionProfile.reportModal')
@include('admin.CollectionProfile.activeCollection')
@endsection
