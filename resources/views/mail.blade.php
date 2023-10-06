<!DOCTYPE html>
<html>
<head>
    <title>Book Approval Mail</title>
    <style>
        /* Add some basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        p {
            font-size: 16px;
            color: #333;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <p>Your book request has been approved.</p>
        <p>Your book request has been approved.</p>
    <p>Title: {{ $bookTracking->book->title }}</p>
    <p>Course ID: {{ $bookTracking->course_id }}</p>
    <p>Librarian: {{ $bookTracking->librarian->first_name }} {{ $bookTracking->librarian->last_name }}</p>
    <!-- Add more content as needed -->

        <a href="{{ url('programChair/approvedBooks') }}" style="text-decoration: none;">View Book</a>
    </div>
</body>
</html>
