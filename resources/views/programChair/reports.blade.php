@extends('layout.layout')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header mb-3">
        <div class="row d-flex align-items-center my-3">    
            <div class="col-sm-8 d-flex">
                <h1 class="display-6 fw-bolder text-uppercase">Collection Profile</h1>
            </div>
            <div class="col-sm-4 d-flex justify-content-end">
                <button class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#CompliedPercentage">
                        <span class="text"> Complied Percentage</span>
                        <span class="icon text-white-50">
                        <i class="fa-solid fa-percent mt-1"></i>
                        </span>          
                </button>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-bordered text-center" width="100%" cellspacing="0">
                <thead class="bg-gradient-info text-light">
                    <tr>
                        <th colspan="2" rowspan="2">{{$books->first()->course->assigned_program ?? $ProgramCode}}</th>
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
                @php    
                    $previousCourseGroup = null;
                    $TotalresultPercentage = 0; 
                    $grandTotalTitlesNeeded = 0;
                    $grandTotalNextTitlesNeeded = 0;
                    $rowCount = 0;
                    $additionalPercentage = 0;
                    $allTitlesGrantTotal = 0;
                    $courseGroups = collect();

                @endphp
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
                                        $totalVolumes += $book->total_volumes;
                                    @endphp
                                @endif
                            @endforeach
                            <td>{{ $totalTitles }}</td>
                            <td>{{ $totalVolumes }}</td>
                            @php
                                $grandTotalTitles += $totalTitles;
                                $grandTotalVolumes += $totalVolumes;
                                $result = ($grandTotalTitles >= 5) ? 100 : ($grandTotalTitles * 20);

                                $excessTitles = ($grandTotalTitles >= 5) ? ($grandTotalTitles - 5) : 0;

                                if ($excessTitles > 0) {
                                    // Calculate the excessTitles percentage
                                    $percentage = ($excessTitles <= 5) ? ($excessTitles * 20) : 100;
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

                        if ($grandTotalTitles >= 5) {
                            $titleNeeded = 0;
                        } else {
                            $titleNeeded = 5 - $grandTotalTitles;
                        }
                        @endphp
                        <td>{{ $titleNeeded }}
                        </td>
                        
                            <td>
                                @php
                                    $year = $courseGroup->first()->book_year;
                                    $grandTotalTitlesNeeded += $titleNeeded;
                                    $nextTotalTitlesNeeded = ($year == $lastYearToRemoveData) ? $book->total_titles : 0;
                                @endphp
                                {{ $nextTotalTitlesNeeded }}
                            </td>
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
@include('admin.CollectionProfile.averageModal')
@endsection
