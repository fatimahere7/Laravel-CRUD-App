<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index')->with('students', $students);
    }


    

    public function store(Request $request){
    // Validate form data including image
    $data=$request->validate([
        'name' => 'required|max:20|min:5',
        'adress' => 'required|max:255',
        'mobile' => 'required|numeric|digits_between:10,15',
        'email' => 'required|email',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
    } else {
        $imagePath = null;
    }

    $stu=Student::create([
        'name' => $request->input('name'),
        'adress' => $request->input('adress'),
        'mobile' => $request->input('mobile'),
        'email' => $request->input('email'),
        'image' => $imagePath,
    ]);
    if($stu){
        return redirect()->back()->with('success', 'Student added successfully.')->with('create', true);
    // }else{
    //     return redirect()->back()->withErrors(['ValidationError' => 'Invalid credentials']);
    }
   
}

public function update(Request $request, $id)
{
    // Validate form data including image
    $request->validate([
        'name' => 'required|max:255',
        'adress' => 'required|max:255',
        'mobile' => 'required|numeric|digits_between:10,15',
        'email' => 'required|email',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $student = Student::find($id);

    // Handle file upload
    if ($request->hasFile('image')) {
        // Delete old image if necessary
        if ($student->image) {
            Storage::disk('public')->delete($student->image);
        }
        $imagePath = $request->file('image')->store('images', 'public');
    } else {
        $imagePath = $student->image; // Keep the old image if none is uploaded
    }

    // Update student record
    $student->update([
        'name' => $request->input('name'),
        'adress' => $request->input('adress'),
        'mobile' => $request->input('mobile'),
        'email' => $request->input('email'),
        'image' => $imagePath,
    ]);

    return redirect()->back()->with('success', 'Student updated successfully.');
}


    public function destroy($id)
    {
        $student = Student::find($id);

        if ($student->image) {
            Storage::disk('public')->delete($student->image);
        }

        Student::destroy($id);

        return redirect()->back()->with('flash_message', 'Deleted successfully');
    }
}
