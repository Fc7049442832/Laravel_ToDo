<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Table</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        table{
            width: 100vw;
            overflow: hidden;
            overflow-x: scroll;
        }
        th, td {
        padding: 5px;
        
        }
        td input, select{
            font-size: 16px;
            padding: 5px;
        }
        .btn {
            width: auto;
            padding: 10px;
            margin: 10px;
            border: 2px solid;
            border-radius: 10px;
        }
        .btn.btn::click{
            padding:7px;
        }
        .success{
            color: rgb(4, 192, 4)
        }
        .danger{
            color: red;
        }
        .bg-success {
            background: green;
            color: antiquewhite
        }
        .bg-danger {
            padding: 4px;
            margin: 3px;
            background: red;
            color:antiquewhite;
        }
        .form-box{
            margin: 20px 10px;
            width: 98%;
            overflow: hidden;
            overflow-x: scroll;
        }
    </style>


</head>
<body>
    <h1>Student Data </h1>
    <button type="button" class="btn" id="add-row">Add Row</button>
    {{--  All data delete Button --}}
    <form id="delete-form" action="{{ route('deleteAllDataWithPassword') }}" method="POST">
        @csrf
        <button type="button" id="delete-button" class="btn btn-danger">Delete All Data</button>
    </form>
    
    @session('error')
        <b><span class="danger" >{{ session('error') }}</span></b>
    @endsession
    @session('success')
        <b><span class="success"> {{ session('success') }}</span></b> 
    @endsession
   
    @php
        $student = null;
    @endphp
    @if ($errors->any())
        <div class="alert danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-box">
        <form id="student-form" action="{{ $student ? route('student.update', $student->id) : route('students.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <table border="1" id="student-table">
                <thead>
                    
                    <tr>
                        {{-- Personal Details --}}
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>City</th>
                        <th>Pin code</th>
                        {{-- College Details --}}
                        <th>University</th>
                        <th>Collage</th>
                        <th>Deparment</th>
                        <th>Batch</th>
                        <th>Role No</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Subject</th>
                        <th>Attachment</th>
                        {{--  other Details --}}
                        <th>Father</th>
                        <th>Mother</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Data fetch in database --}}
                    @foreach ($students as $key => $student)
                    <tr>   
                        {{-- Personal Details --}}
                        <!-- Hidden field to store update key -->
                        <input type="hidden" name="id" value="{{ $student->id ?? '' }}">
                        <input type="hidden" name="students[{{ $key }}][updateKey]" class="update-key" value="0">
                        <td>{{$key +1}}</td>
                        <td><input type="text" name="students[{{ $key }}][name]" value="{{ $student->name }}" class="editable-field" placeholder="Enter Name"></td>
                        <td><input type="email" name="students[{{ $key }}][email]" value="{{ $student->email }}" class="editable-field"   readonly></td>
                        <td><input type="number" name="students[{{ $key }}][phone]" value="{{ $student->phone }}" class="editable-field" placeholder="Enter Phone"></td>
                        <td><input type="number" name="students[{{ $key }}][age]" value="{{ $student->age }}" class="editable-field" placeholder="Enter Age"></td>
                        <td>
                            <select name="students[{{ $key }}][gen]" class="editable-field" >
                                <option value="M" {{ $student->gen == 'M' ? 'selected' : '' }}>Male</option>
                                <option value="F" {{ $student->gen == 'F' ? 'selected' : '' }}>Female</option>
                            </select>
                        </td>
                        <td><input type="text" name="students[{{ $key }}][city]" value="{{ $student->city }}" class="editable-field" placeholder="Enter City"></td>
                        <td><input type="number" name="students[{{ $key }}][pin]" value="{{ $student->pin }}" class="editable-field" placeholder="Enter Pin Code"></td>

                        {{-- College Details --}}
                        <td><input type="text" name="students[{{ $key }}][university]" value="{{ $student->university }}" class="editable-field" placeholder="Enter University"></td>
                        <td><input type="text" name="students[{{ $key }}][college]" value="{{ $student->college }}" class="editable-field" placeholder="Enter College"></td>
                        <td>
                            <select name="students[{{ $key }}][dept]" class="editable-field" >
                                <option value="CS" {{ $student->dept == 'CS' ? 'selected' : '' }}>Computer</option>
                                <option value="ME" {{ $student->dept == 'ME' ? 'selected' : '' }}>Mechanical</option>
                            </select>
                        </td>
                        <td><input type="text" name="students[{{ $key }}][batch]" value="{{ $student->batch }}" class="editable-field" placeholder="Enter Batch"></td>
                        <td><input type="text" name="students[{{ $key }}][role]" value="{{ $student->role }}" class="editable-field" placeholder="Enter Role No."></td>
                        <td><input type="date" name="students[{{ $key }}][start]" value="{{ $student->start }}" class="editable-field" placeholder="Start Date"></td>
                        <td><input type="date" name="students[{{ $key }}][end]" value="{{ $student->end }}" class="editable-field" placeholder="End Date"></td>
                        <td><input type="text" name="students[{{ $key }}][subject]" value="{{ $student->subject }}" class="editable-field" placeholder="Enter Subject"></td>
                        @if(isset($student->file) && is_array(json_decode($student->file, true)))
                            <td>
                                @foreach(json_decode($student->file, true) as $index => $filePath)
                                        <div>
                                            <a href="{{ asset('storage/' . $filePath) }}" target="_blank" rel="noopener noreferrer">Attachment {{ $index + 1 }}</a>
                                            <form action="{{ route('student.file.delete', ['id' => $student->id, 'fileIndex' => $index]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this file?')">Delete</button>
                                            </form>
                                        </div>
                                @endforeach 
                                <input type="file" name="students[{{ $key }}][newFiles][]" class="editable-field form-control" multiple>
                            </td>
                            
                        @else
                            <td>
                                <input type="file" name="students[{{ $key }}][file][]" class="editable-field" multiple>
                            </td>
                        @endif      
                        {{-- Other Details --}}
                        <td><input type="text" name="students[{{ $key }}][fname]" value="{{ $student->fname }}" class="editable-field" placeholder="Enter Father Name"></td>
                        <td><input type="text" name="students[{{ $key }}][mname]" value="{{ $student->mname }}" class="editable-field" placeholder="Enter Mother Name"></td>
                        <td>
                            <button type="submit">Update</button>
                        
                            <form action="{{ route('deleteFormData', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                @csrf
                                <button type="submit" class="bg-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
       
            <button type="submit" class="btn bg-success">Save & Update</button>
        </form>
    </div>
    
    <script>
    let rowIndex = {{ isset($key) ? $key + 2 : 1 }};; // Initialize rowIndex

          $('#add-row').click(function () {
            // Get today's date in the required format (YYYY-MM-DD)
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0];

            // Append a new row
            $('#student-table tbody').append(`
                <tr>   
                    {{-- Personal Details --}}
                    <td> ${rowIndex} </td>
                     <input type="hidden" name="students[{{isset($key) ? $key : 1 }}][updateKey]" class="update-key" value="0">
                    <td>
                        <input type="text" name="students[${rowIndex}][name]" placeholder="Enter Name">
                        <span class="danger" id="students_${rowIndex}_name_error"></span>
                    </td>
                    <td>
                        <input type="email" name="students[${rowIndex}][email]" placeholder="Enter Email">
                        <span class="danger" id="students_${rowIndex}_email_error"></span>
                    </td>
                    <td>
                        <input type="number" name="students[${rowIndex}][phone]" placeholder="Enter Phone">
                        <span class="danger" id="students_${rowIndex}_phone_error"></span>
                    </td>
                    <td>
                        <input type="number" name="students[${rowIndex}][age]" placeholder="Enter Age">
                        <span class="danger" id="students_${rowIndex}_age_error"></span>
                    </td>
                    <td>
                        <select name="students[${rowIndex}][gen]">
                            <option value="M">Male</option>
                            <option value="F"> Female </option>
                        </select>
                        <span class="danger" id="students_${rowIndex}_gen_error"></span>
                    </td>
                    <td>
                        <input type="text" name="students[${rowIndex}][city]" placeholder="Enter City">
                        <span class="danger" id="students_${rowIndex}_city_error"></span>
                    </td>
                    <td>
                        <input type="number" name="students[${rowIndex}][pin]" placeholder="Enter Pin Code">
                        <span class="danger" id="students_${rowIndex}_pin_error"></span>
                    </td>

                    {{-- College Details --}}
                    <td>
                        <input type="text" name="students[${rowIndex}][university]" placeholder="Enter University">
                        <span class="danger" id="students_${rowIndex}_university_error"></span>
                    </td>
                    <td>
                        <input type="text" name="students[${rowIndex}][college]" placeholder="Enter College">
                        <span class="danger" id="students_${rowIndex}_college_error"></span>
                    </td>
                    <td>
                        <select name="students[${rowIndex}][dept]">
                            <option value="CS">Computer</option>
                            <option value="ME"> Mechnical </option>
                        </select>
                        <span class="danger" id="students_${rowIndex}_dept_error"></span>
                    </td>

                    <td>
                        <input type="number" name="students[${rowIndex}][batch]" placeholder="Enter Batch">
                        <span class="danger" id="students_${rowIndex}_batch_error"></span>
                    </td>
                    <td>
                        <input type="number" name="students[${rowIndex}][role]" placeholder="Enter Role No.">
                        <span class="danger" id="students_${rowIndex}_role_error"></span>
                    </td>
                    <td>
                        <input type="date" name="students[${rowIndex}][start]" class="start-date" placeholder="Start Date" min="${formattedDate}" max="${formattedDate}">
                    </td>
                    <td>
                        <input type="date" name="students[${rowIndex}][end]" class="end-date" placeholder="End Date" readonly>
                    </td>
                    <td>
                        <input type="text" name="students[${rowIndex}][subject]" placeholder="Enter Subject">
                        <span class="danger" id="students_${rowIndex}_subject_error"></span>
                    </td>
                   <td>
                        <input type="file" name="students[${rowIndex}][file][]" multiple>
                        <span class="danger" id="students_${rowIndex}_file_error"></span>
                    </td>

                    {{-- Other Details --}}
                    <td>
                        <input type="text" name="students[${rowIndex}][fname]" placeholder="Enter Father Name">
                        <span class="danger" id="students_${rowIndex}_fname_error"></span>
                    </td>
                    <td>
                        <input type="text" name="students[${rowIndex}][mname]" placeholder="Enter Mother Name">
                        <span class="danger" id="students_${rowIndex}_mname_error"></span>
                    </td>
                
                    <td><button type="button" class="remove-row">Remove</button></td>
                </tr>
            `);

            // Sync Start Date with End Date
            const newRow = $('#student-table tbody tr:last-child');
            newRow.find('.start-date').on('change', function () {
                const startDateValue = $(this).val();
                newRow.find('.end-date').val(startDateValue);
            });

            rowIndex++; // Increment row index
        });


    // Remove row functionality
    $(document).on('click', '.remove-row', function () {
        $(this).closest('tr').remove();
    });   
   
     // Use jQuery or vanilla JS to handle changes
     document.addEventListener('DOMContentLoaded', function () {
        const fields = document.querySelectorAll('.editable-field');

        fields.forEach(field => {
            field.addEventListener('change', function () {
                const parentRow = this.closest('tr');
                const updateKeyField = parentRow.querySelector('.update-key');

                // Set updateKey value to 1
                updateKeyField.value = 1;

                // Change the background color of the field to yellow
                this.style.backgroundColor = 'yellow';
            });
        });
    });
    

    // All data delete js Function
    document.getElementById('delete-button').addEventListener('click', function () {
        // Step 1: Confirm the action
        const confirmDelete = confirm('Are you sure you want to delete all data? This action is irreversible.');

        if (confirmDelete) {
            // Step 2: Prompt for password
            const password = prompt('Enter your password to confirm:');

            if (password) {
                // Step 3: Add the password to the form and submit
                const form = document.getElementById('delete-form');
                const passwordInput = document.createElement('input');
                passwordInput.type = 'hidden';
                passwordInput.name = 'password';
                passwordInput.value = password;

                form.appendChild(passwordInput);
                form.submit();
            } else {
                alert('Password is required to proceed.');
            }
        }
    });

    </script>
</body>
</html>
