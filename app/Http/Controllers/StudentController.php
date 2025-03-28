<?php
//amjad al yousif 20220387
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
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
    
    public function create()
    {
        return view('create');
    }
    public function search(Request $request)
    {
       
        return $this->index($request);  
    }
    

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age'  => 'required|integer|min:1|max:100',
        ]);
    
     
        Student::create([
            'name' => $request->name,
            'age'  => $request->age,
        ]);
        if ($request->ajax()) {
            return response()->json([
                'student' => view('students.student_row', compact('student'))->render()
            ]);
        }
    
        
        return redirect()->route('students.index')->with('success', 'Student added successfully!');
     }
    

    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}
