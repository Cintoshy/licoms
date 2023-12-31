<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Noted Books</title>

    <link href="{{ public_path('css/exportNotedBooks.css') }}" rel="stylesheet"> 
</head>
<body>
<img id="pdfLogo" src="{{ public_path('images/header.png') }}" alt="logo" style="width:100%; margin:0;">
    <header>
        <h6>Library Collection Profile</h6>
        <h4>Bachelor of Science in Information Technology</h4>
    </header>
    <br>
    <div class="card-container">
        <table data-toggle="table">
            <thead>
                <tr>
                    <th>Technical Courses and Subjects</th>
                    <th>AVAILABLE BOOKS (TITLES/AUTHOR/EDITION)</th>
                    <th>Copies</th>
                    <th>Copyright</th>
                </tr>
            </thead>
            <tbody>
            @php
                $previousCourseGroups = [];
            @endphp

            @foreach ($organizeBook as $course => $courseData)
                @php
                    $courseGroup = $courseData->first()->course_group;
                    $courseCount = count($courseData);
                @endphp

                @if (!in_array($courseGroup, $previousCourseGroups))
                    <tr>
                        <td id="ccourse" colspan="4">{{ $courseGroup }}</td>
                    </tr>
                    @php
                        $previousCourseGroups[] = $courseGroup;
                    @endphp
                @endif

                @foreach ($courseData as $index => $data)
                    <tr>
                        @if($index === 0) {{-- Display only in the first row --}}
                            <td rowspan="{{ $courseCount }}">{{ $course }}</td>
                        @endif
                        <td>{{ $data->title }}</td>
                        <td>{{ $data->volume }}</td>
                        <td>{{ $data->year }}</td>
                    </tr>
                @endforeach
            @endforeach



            </tbody>
        </table>
    </div>
</body>
</html>
