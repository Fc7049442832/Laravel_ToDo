<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
   //   
   public function index()
   {
       $students = Student::get();
    //    dd($students->all());
       return view('index', compact('students'));
   }


    // Store and update data function
    public function storeOrUpdate(Request $request)
    {
        // Validate the request to ensure files and other inputs are properly formatted
        $request->validate([
            'students.*.file' => 'nullable|array',
            'students.*.file.*' => 'nullable|file', // Each file must be a valid file
        ]);

        // Get all student data from the request
        $students = $request->input('students', []);

        foreach ($students as $index => $student) {
            // Check if a student with the given email already exists
            $existingStudent = Student::where('email', $student['email'])->first();

            // Handle file uploads
            $filePaths = [];
            if ($request->hasFile("students.{$index}.file")) {
                $files = $request->file("students.{$index}.file");
                $filePaths = $this->handleMultiFileUpload($files); // Call the multi-file upload function
            }

            // If the student exists and updateKey is 1, update the record
            if ($existingStudent && $student['updateKey'] == 1) {
                $existingStudent->update([
                    'name' => $student['name'],
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
                    'file' => json_encode($filePaths), // Save file paths as JSON if multiple files
                    'fname' => $student['fname'],
                    'mname' => $student['mname'],
                ]);
            }
            // If the student doesn't exist, create a new record
            elseif (!$existingStudent) {
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
                    'file' => json_encode($filePaths), // Save file paths as JSON if multiple files
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
    private function handleMultiFileUpload($files, $directory = 'uploads/students')
    {
        $uploadedPaths = [];
        
        if (is_array($files)) {
            foreach ($files as $file) {
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    // Store the file in the specified directory on the 'public' disk
                    $uploadedPaths[] = $file->store($directory, 'public');
                }
            }
        }
    
        return $uploadedPaths;
    }
    // student file delete one by one function
    public function deleteFile($id, $fileIndex)
    {
        // Find the student
        $student = Student::findOrFail($id);

        // Decode the file field (JSON) into an array
        $files = json_decode($student->file, true);

        // Ensure the file index exists
        if (isset($files[$fileIndex])) {
            // Delete the file from storage
            Storage::disk('public')->delete($files[$fileIndex]);

            // Remove the file path from the array
            unset($files[$fileIndex]);

            // Reindex the array and update the database
            $student->file = json_encode(array_values($files));
            $student->save();

            return redirect()->back()->with('success', 'File deleted successfully.');
        }

        return redirect()->back()->with('error', 'File not found.');
    }

    // Student all data Delete only single click
    public function deleteAllData(Request $request)
    {
         // Step 1: Validate the password input
         $password = $request->input('password');

         if ($password !== '12345678') { // Replace 'your_secure_password' with your actual password logic
             return redirect()->back()->with('error', 'Incorrect password. Data deletion aborted.');
         }
 
         try {
             // Step 2: Truncate the required tables
             \DB::table('students')->truncate();

             return redirect()->back()->with('success', 'All data has been deleted successfully.');
         } catch (\Exception $e) {
             return redirect()->back()->with('error', 'Failed to delete data: ' . $e->getMessage());
         }
     }
    

}
   