@extends('layout')

@section('title', 'Add Student')

@section('content')
<div class="container">
    <h2>Add New Student</h2>

   
    <form id="addStudentForm">
        @csrf
        <div class="form-group">
            <label for="name">Student Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="age">Student Age</label>
            <input type="number" id="age" name="age" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Student</button>
    </form>

    <div id="responseMessage" class="mt-3"></div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    
    $('#addStudentForm').submit(function (e) {
        e.preventDefault(); 

       
        var formData = $(this).serialize();

       
        $.ajax({
            url: "{{ route('students.store') }}", 
            type: "POST", 
            data: formData, 
            success: function (response) {
               
                $('#responseMessage').html('<div class="alert alert-success">' + response.success + '</div>');
                $('#addStudentForm')[0].reset(); 

               
                setTimeout(function () {
                    window.location.href = "{{ route('students.index') }}"; 
                }, 1500); 
            },
            error: function (xhr, status, error) {
               
                var errorMessage = xhr.responseJSON.message || 'Something went wrong!';
               ;
            }
        });
    });
});
</script>

@endsection
