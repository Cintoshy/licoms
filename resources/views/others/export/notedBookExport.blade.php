<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Noted Books</title>
    <style>
/* exported-table.css */

/* Optional: Uncomment the following line to import Bootstrap */
/* @import url('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'); */

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid rgba(0, 0, 0, 0.125); /* Bootstrap uses rgba(0, 0, 0, 0.125) for border color */
    text-align: left;
}

thead {
    background-color: #f8f9fa; /* Bootstrap uses #f8f9fa for thead background color */
}

th {
    background-color: #28a745; /* Bootstrap uses #28a745 for th background color */
    color: white;
}



    </style>
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
                    <th>Technical Courses and Subjects</th>
                    <th>AVAILABLE BOOKS (TITLES/AUTHOR/EDITION)</th>
                    <th>Copies</th>
                    <th>Copyright</th>
                </tr>
            </thead>
            <tbody>
                @php $previousCourse = null; @endphp
                @foreach ($organizeBook as $course => $courseData)
                    @php
                        $courseGroup = $courseData->first()->course_group;
                    @endphp
                    @if ($courseGroup !== $previousCourse)
                        
                            <td colspan="4">{{ $courseGroup }}</td>
                    @endif
                    <tr>
                        <td rowspan="{{ count($courseData) + 1 }}">{{ $course }}</td>
                    </tr>
                    @foreach ($courseData as $data)
                        <tr>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->volume }}</td>
                            <td>{{ $data->year }}</td>
                        </tr>
                    @endforeach
                    @php $previousCourse = $courseGroup; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
