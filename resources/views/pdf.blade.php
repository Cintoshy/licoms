<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Collection Report</title>
    <link href="{{ asset('assets/css/sb-admin-2.css') }}" rel="stylesheet">
    <style>
        
        @page{
            size: a1 landscpae;
        }
        /* Define any custom CSS styles for your PDF here */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
           
        }
        th {
            color: black;
        }
        footer{
            width: 100%;
            position: fixed;
            bottom: 40px;
            right: 0px;
            height: 10px;
            text-align: right;
            line-height: 35px;
            border-top: 1px solid black;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <h1>Collection Report</h1>
    <a href="{{ route('export.collection-profile') }}" class="d-none d-sm-inline-block btn btn-success shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                <table class="table table-bordered text-center table-striped" width="100%" cellspacing="0">
                <thead class="bg-gradient-info text-light">
                    <tr>
                    <th colspan="2" rowspan="2">{{$books->first()->course->assigned_program ?? $ProgramCode}}</th>
                    <th colspan="10">WITHIN PRESCRIBED 5 YEARS COPYRIGHT</th>
                    <th rowspan="2" colspan="2">Grand Total</th>
                    <th rowspan="3">% Per Subject</th>
                    <th rowspan="3">Titles Needed</th>
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
            <th>T</th>
            <th>V</th>
            <th>T</th>
            <th>V</th>
            <th>T</th>
            <th>V</th>
            <th>T</th>
            <th>V</th>
            <th>T</th>
            <th>V</th>
            <th>T</th>
            <th>V</th>
        </tr>
</thead>
        
@foreach ($groupedBooks as $courseId => $yearsData)

            @php
                $courseTotalVolumes = 0;
                $courseTotalTitles = 0;
                $courseTotalVolumesBelow = 0;
                $courseTotalTitlesBelow = 0;
                $course = $yearsData->first()->first()->course;
            @endphp
            <tr class="table-danger">
                <td>{{ $courseId }}</td>
                <td>{{ $course->course_title ?? $ProgramCode}}</td>
                @foreach (array_reverse($years) as $year)
                    @php
                        $yearData = $yearsData->get($year, [0 => ['total_volumes' => 0, 'total_titles' => 0]])[0];
                        $courseTotalVolumes += $yearData['total_volumes'];
                        $courseTotalTitles += $yearData['total_titles'];



                    @endphp
                    <td>{{ $yearData['total_titles'] }}</td>
                    <td>{{ $yearData['total_volumes'] }}</td>
                @endforeach
                <td width="7%">{{ $courseTotalTitles }}</td>
                <td width="7%">{{ $courseTotalVolumes }}</td>
                <td>80%</td>
                <td width="7%">
                    @if ($courseTotalTitles >= 10)
                        0
                    @else   
                        {{ 10 - $courseTotalTitles }}
                    @endif
                </td>
                @php
                    $totalTitlesBelow = 0;
                    $totalVolumesBelow = 0;
                @endphp
            @foreach (array_reverse($fiveYearsBelow) as $year)
                @php
                    $yearData = $yearsData->get($year, [0 => ['total_volumes' => 0, 'total_titles' => 0]])[0];
                    $totalTitlesBelow += $yearData['total_titles'];
                    $totalVolumesBelow += $yearData['total_volumes'];
                @endphp
            @endforeach
                <td>{{ $totalTitlesBelow }}</td>
                <td>{{ $totalVolumesBelow }}</td>
            

        @endforeach
    </table>
    <footer class="text-right">
        
        <p class="mr-5">Printed in: {{ date("Y-m-d h:i A") }}</p>

    </footer>
</body>
</html>
