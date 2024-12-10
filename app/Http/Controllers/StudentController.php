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
    //    dd($students->all());
       return view('index', compact('students'));
   }


    // store and update data function
   public function storeOrUpdate(Request $request)
   {
        // Validate the request to ensure files and other inputs are properly formatted
        $request->validate([
            'students.*.file' => 'nullable|file',
            'students.*.phone' => 'required|digits:10', // Mobile number must be 10 digits
            'students.*.pin' => 'required|digits:6',   // Pin code must be 6 digits
        ]);

       // Get all student data from the request
       $students = $request->input('students',[]);
       
       foreach ($students as $index =>  $student) {
           // Check if a student with the given email already exists
          
           
            $existingStudent = Student::where('email', $student['email'])->first();
   
            if (!$existingStudent) {

                 // Handle file upload using the private function
                $filePath = null;
                if ($request->hasFile("students.{$index}.file")) {
                    $filePath = $this->handleFileUpload($request->file("students.{$index}.file"));
                }

                // Create a new student record
                Student::create([
                    'name' => $student['name'],
                    'email' => $student['email'],
                    'phone' => $student['phone'],
                    'age' => $student['age'],
                    'gen' => $student['gen'],
                    'city' => $student['city'],
                    'pin' => $student['pin'],
                    'university' => $student['university'],
                    'college' => $student['college'],
                    'dept' => $student['dept'],
                    'batch' => $student['batch'],
                    'role' => $student['role'],
                    'start' => $student['start'],
                    'end' => $student['end'],
                    'subject' => $student['subject'],
                    'file' => $filePath,
                    'fname' => $student['fname'],
                    'mname' => $student['mname'],
                ]);
    
            } 
       }
   
       return redirect()->route('home')->with('success', 'Students added or updated successfully');
   }
   

    // Data Delete Function 
    public function deleteFormData(Request $request, $id)
    {
        $record = Student::find($id);
     
        if ($record) {
            $record->delete();
            return back()->with('success', 'Record deleted successfully');
        }

        return back()->with('error', 'Record not found');
    }

    //  file uploading function 
    private function handleFileUpload($file, $directory = 'uploads/students')
    {
        if ($file instanceof \Illuminate\Http\UploadedFile) {
            // Store the file in the specified directory on the 'public' disk
            return $file->store($directory, 'public');
        }
        return null;
    }

}
   