<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Display a list of students
    public function index(Request $request)
    {
        $query = $request->get('query');
        $min_age = $request->get('min_age');
        $max_age = $request->get('max_age');
    
       
        $students = Student::query();
    
        if ($query) {
            $students->where('name', 'like', '%' . $query . '%');
        }
    
        if ($min_age) {
            $students->where('age', '>=', $min_age);
        }
    
        if ($max_age) {
            $students->where('age', '<=', $max_age);
        }
    
        $students = $students->get();  
    
        return view('index', compact('students')); 
    }
    // Show the form to create a new student
    public function create()
    {
        return view('create');
    }
    public function search(Request $request)
    {
        // This is for handling the AJAX request for live filtering
        return $this->index($request);  
    }
    

    // Store a newly created student
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age'  => 'required|integer|min:1|max:100',
        ]);
    
        // Create the student record
        Student::create([
            'name' => $request->name,
            'age'  => $request->age,
        ]);
        if ($request->ajax()) {
            return response()->json([
                'student' => view('students.student_row', compact('student'))->render()
            ]);
        }
    
        // If not AJAX, redirect as usual
        return redirect()->route('students.index')->with('success', 'Student added successfully!');
     }
    

    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}
