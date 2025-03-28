
@extends('layout')


@section('title', 'Student Details')

@section('content')

<h1 class="mb-4">Student Details</h1>


<div class="card">
    <div class="card-body">
       
        <h5 class="card-title">Name: {{ $student->name }}</h5>
       
        <p class="card-text">Age: {{ $student->age }}</p>
       
        <a href="{{ route('students.index') }}" class="btn btn-primary">Back to List</a>
    </div>
</div>
@endsection
