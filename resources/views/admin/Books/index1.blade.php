@extends('layout.layout')

@section('content')
<div class="container">
        <h1>Book Requests for Program {{ $user->assigned_program }}</h1>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Requester</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookRequests as $request)
                        <tr>
                            <td>{{ $request->book->title }}</td>
                            <td>{{ $request->book->author }}</td>
                            <td>{{ $request->status }}</td>
                            <td>{{ $request->faculty->first_name }} {{ $request->faculty->last_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
@endsection
