<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
   //   
   public function index()
   {
       $students = Student::get();
       return view('index', compact('students'));
   }

    // Data store
   public function store(Request $request)
   {
    // dd($request->all());
       $students = $request->input('students');

       foreach ($students as $student) {

           // Check if a file is uploaded for the current student
            $filePath = null;
            if (isset($student['file']) && $student['file'] instanceof \Illuminate\Http\UploadedFile) {
                // Save the uploaded file and get the path
                $filePath = $student['file']->store('uploads/students', 'public'); // Save in the 'uploads/students' folder in the 'public' disk
            }
       
           Student::create([
               'name' => $student['name'],
               'email' => $student['email'],
               'phone' => $student['phone'],
               'age' => $student['age'],
               'gen' => $student['gen'],
               'city' => $student['city'],
               'pin' => $student['pin'],
               
               'university'=> $student['university'],
               'college' => $student['college'],
               'dept' => $student['dept'],
               'batch' => $student['batch'],
               'role' => $student['role'],
               'start' => $student['start'],
               'end' => $student['end'],
               'subject'=> $student['subject'],
               'file'=>  $filePath, 

               'fname'=> $student['fname'],
               'mname'=> $student['mname'],
           ]);
       }

       return redirect()->route('home');
   }

}
   