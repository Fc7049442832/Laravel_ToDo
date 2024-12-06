<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
   //   
   public function index()
   {
       return view('index');
   }

    // Data store
   public function store(Request $request)
   {
       $students = $request->input('students');

       foreach ($students as $student) {
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
               'file'=> $student['file'],

               'fname'=> $student['fname'],
               'mname'=> $student['mname'],
           ]);
       }

       return response()->json(['success' => true, 'message' => 'Students saved successfully!']);
   }

}
   