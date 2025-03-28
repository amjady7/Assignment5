@extends('layout')

@section('title', 'Students')

@section('content')
<div class="container">
    <h2>Students</h2>

  
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" id="search" class="form-control" placeholder="Search by name...">
        </div>
        <div class="col-md-3">
            <input type="number" id="min_age" class="form-control" placeholder="Min Age">
        </div>
        <div class="col-md-3">
            <input type="number" id="max_age" class="form-control" placeholder="Max Age">
        </div>
        <div class="col-md-2">
            <button id="filter-btn" class="btn btn-primary w-100">Filter</button>
        </div>
    </div>

  
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
            </tr>
        </thead>
        <tbody id="student-table">
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->age }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

   
    <a href="{{ route('students.create') }}" class="btn btn-success">Add New Student</a>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
  
    function fetchStudents() {
        let query = $('#search').val();
        let min_age = $('#min_age').val();
        let max_age = $('#max_age').val();

        $.ajax({
            url: "{{ route('students.search') }}",  
            type: "GET",  
            data: {
                query: query,
                min_age: min_age,
                max_age: max_age
            },
            success: function (response) {
                $('#student-table').html(response);  
            }
        });
    }

   
    $('#search').on('keyup', function () {
        fetchStudents();  
    });

    
    $('#filter-btn').on('click', function () {
        fetchStudents();  
    });
});
</script>

@endsection
