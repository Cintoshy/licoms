<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Collection Report</title>
    
    <link href="{{ public_path('css/customtable.css') }}" rel="stylesheet"> 
    
</head>
<body>
<img id="pdfLogo" src="{{ public_path('images/header.png') }}" alt="logo" style="width:100%; margin:0;">
    <header>
        <h6>Library Collection Profile</h6>
        <h4>Bachelor of Science in Information Technology</h4>
    </header>
            <div class="card-container">

            
            <table id="body-table">
                <thead>
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
                        <tr>
                            <td colspan="21" style="text-align: left; background: lightgray;">

                                {{ $currentCourseGroup }} 
                    
                            </td>
                        </tr>
                        @php
                            $previousCourseGroup = $courseGroup[0]->course->course_group;
                        @endphp
                    @endif
                    <tr>
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
                        <td>{{ $titleNeeded }}</td>
                        
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
            <div class="card">        
                    <table class="table ">
                            @php
                                $previousCourseGroup = null;
                                $courseCount = 0;
                                $totalCourseCount = 0;
                            @endphp
                            <tr>
                                <th colspan="3">Minimum Requirements</th>
                            </tr>
                            <tr>
                                <th colspan="2">Courses</th>
                                <th>Total</th>
                            </tr>
                            

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
                                <td style="text-align: right; font-weight: bold;">Grand total</td>
                                <td><strong>{{ $minimumTotal }}</strong></td>
                                <td><strong>{{ $minimumTotal * 5 }}</strong></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">Active Collection</th>
                                </tr>
                                <tr>
                                    <th>Total Titles</th>
                                    <th>Total Volumes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $grandActiveCollectionTotalTitles = 0;
                                    $grandActiveCollectionTotalVolumes = 0;
                                @endphp

                                @foreach ($courseGroupsssBooksTitle as $courseId => $courseGroup)
                                    @php
                                        $totalActiveCollectionTotalTitles = $courseGroup->sum('total_titles');
                                        $totalActiveCollectionTotalVolumes = $courseGroup->sum('total_volumes');
                                        $grandActiveCollectionTotalTitles += $totalActiveCollectionTotalTitles;
                                        $grandActiveCollectionTotalVolumes += $totalActiveCollectionTotalVolumes;
                                    @endphp

                                    <tr>
                                        <td>{{ $totalActiveCollectionTotalTitles }}</td>
                                        <td>{{ $totalActiveCollectionTotalVolumes * 2 }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td><strong>{{ $grandActiveCollectionTotalTitles }}</strong></td>
                                    <td><strong>{{ $grandActiveCollectionTotalVolumes * 2 }}</strong></td>
                                </tr>
                            </tbody>
                        </table>

            </div>
            @php
                $compiledPercentage = $grandTotalresultPercentage + $totalAdditionalPercentage;
            @endphp
            <div class="card">
                <table class="table ">
                                <thead>
                                <tr>
                                        <th>Complied Percentage</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td height="9%" style="font-weight: bolder; font-size:30px; color: red;">{{ $compiledPercentage }}%</td>
                                    </tr>
                                    <tr>
                                        <td>Current Titles Needed: {{ $grandTotalTitlesNeeded  }}</td>
                                    </tr>
                                    <tr>
                                        <td>Next Year Titles Needed: {{ $grandTotalNextTitlesNeeded }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    </table>
    <footer>
        
        <p>Printed in: {{ date("Y-m-d h:i A") }}</p>

    </footer>
</body>
</html>