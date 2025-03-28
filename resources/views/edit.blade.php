
@extends('layout')


@section('title', 'Edit Student')

@section('content')

<h1 class="mb-4">Edit Student</h1>


<form action="{{ route('students.update', $student->id) }}" method="POST" class="mb-4">
    
    @csrf
   
    @method('PUT')
    <div class="mb-3">
      
        <label for="name" class="form-label">Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ $student->name }}" required>
    </div>
    <div class="mb-3">
      
        <label for="age" class="form-label">Age</label>
        <input type="number" id="age" name="age" class="form-control" value="{{ $student->age }}" required>
    </div>
  
    <button type="submit" class="btn btn-primary">Update Student</button>
</form>
@endsection
