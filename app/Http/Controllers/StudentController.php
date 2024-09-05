<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index')->with('students',$students);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'adress' => 'required|string|max:255',
            'mobile' => 'required|digits_between:10,15',
        ]);
        
        //    $input = $request ->all();
        Student::create($request->all());

        return redirect()->back()->with('success', 'Student created successfully!');
       
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::find($id);
        return view('students.show')->with('students',$student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::find($id);
        return view('students.show')->with('students',$student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'adress' => 'required|string|max:255',
            'mobile' => 'required|digits_between:10,15',
        ]);
        $student = Student::find($id); 
        $input = $request->all(); 
        $student->update($input);
        return redirect()->back()->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Student::destroy($id);
        return redirect('student')->with('flash_massege','deleted successfully');
    }
}
