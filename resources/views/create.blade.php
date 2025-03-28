@extends('layout')

@section('title', 'Add Student')

@section('content')
<div class="container">
    <h2>Add New Student</h2>

    <!-- Form to Add New Student -->
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

    <div id="responseMessage" class="mt-3"></div> <!-- To display success or error messages -->

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Handle form submission via AJAX
    $('#addStudentForm').submit(function (e) {
        e.preventDefault(); // Prevent the form from submitting the usual way

        // Get form data
        var formData = $(this).serialize();

        // Make the AJAX request to add the student
        $.ajax({
            url: "{{ route('students.store') }}", // Store route in web.php
            type: "POST", // POST method for form submission
            data: formData, // Send form data
            success: function (response) {
                // Show success message
                $('#responseMessage').html('<div class="alert alert-success">' + response.success + '</div>');
                $('#addStudentForm')[0].reset(); // Reset the form fields

                // Optionally, you could redirect to another page or dynamically update the student list
                // For now, let's reload the student list on the index page
                setTimeout(function () {
                    window.location.href = "{{ route('students.index') }}"; // Redirect to the students index page
                }, 1500); // Redirect after 1.5 seconds
            },
            error: function (xhr, status, error) {
                // Handle error case
                var errorMessage = xhr.responseJSON.message || 'Something went wrong!';
               ;
            }
        });
    });
});
</script>

@endsection
