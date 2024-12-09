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
    </style>


</head>
<body>
    <h1>Student Data </h1>
    <button type="button" class="btn" id="add-row">Add Row</button>
    @session('error')
        <b><span class="danger" >{{ session('error') }}</span></b>
    @endsession
    @session('success')
        <b><span class="success"> {{ session('success') }}</span></b> 
    @endsession
   
    @php
        $student = null;
    @endphp

    <form id="student-form" action="{{ $student ? route('student.update', $student->id) : route('students.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <table border="1" id="student-table">
            <thead>
                
                <tr>
                    {{-- Personal Details --}}
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
                    <input type="hidden" name="" value="{{ $student->id ?? '' }}">
                    
                    <td><input type="text" name="students[{{ $key }}][name]" value="{{ $student->name }}" placeholder="Enter Name"></td>
                    <td><input type="email" name="students[{{ $key }}][email]" value="{{ $student->email }}" placeholder="Enter Email"></td>
                    <td><input type="number" name="students[{{ $key }}][phone]" value="{{ $student->phone }}" placeholder="Enter Phone"></td>
                    <td><input type="text" name="students[{{ $key }}][age]" value="{{ $student->age }}" placeholder="Enter Age"></td>
                    <td>
                        <select name="students[{{ $key }}][gen]">
                            <option value="M" {{ $student->gen == 'M' ? 'selected' : '' }}>Male</option>
                            <option value="F" {{ $student->gen == 'F' ? 'selected' : '' }}>Female</option>
                        </select>
                    </td>
                    <td><input type="text" name="students[{{ $key }}][city]" value="{{ $student->city }}" placeholder="Enter City"></td>
                    <td><input type="number" name="students[{{ $key }}][pin]" value="{{ $student->pin }}" placeholder="Enter Pin Code"></td>

                    {{-- College Details --}}
                    <td><input type="text" name="students[{{ $key }}][university]" value="{{ $student->university }}" placeholder="Enter University"></td>
                    <td><input type="text" name="students[{{ $key }}][college]" value="{{ $student->college }}" placeholder="Enter College"></td>
                    <td>
                        <select name="students[{{ $key }}][dept]">
                            <option value="CS" {{ $student->dept == 'CS' ? 'selected' : '' }}>Computer</option>
                            <option value="ME" {{ $student->dept == 'ME' ? 'selected' : '' }}>Mechanical</option>
                        </select>
                    </td>
                    <td><input type="text" name="students[{{ $key }}][batch]" value="{{ $student->batch }}" placeholder="Enter Batch"></td>
                    <td><input type="text" name="students[{{ $key }}][role]" value="{{ $student->role }}" placeholder="Enter Role No."></td>
                    <td><input type="date" name="students[{{ $key }}][start]" value="{{ $student->start }}" placeholder="Start Date"></td>
                    <td><input type="date" name="students[{{ $key }}][end]" value="{{ $student->end }}" placeholder="End Date"></td>
                    <td><input type="text" name="students[{{ $key }}][subject]" value="{{ $student->subject }}" placeholder="Enter Subject"></td>
                    @if(isset($student->file))
                    <td><a href="{{asset('storage/'.$student->file)}}" target="_blank" rel="noopener noreferrer">Attachment</a></td>
                    @else
                    <td><input type="file" name="students[{{ $key }}][file]"></td>
                    @endif
                    {{-- Other Details --}}
                    <td><input type="text" name="students[{{ $key }}][fname]" value="{{ $student->fname }}" placeholder="Enter Father Name"></td>
                    <td><input type="text" name="students[{{ $key }}][mname]" value="{{ $student->mname }}" placeholder="Enter Mother Name"></td>
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
        
        <button type="submit" class="btn bg-success">Submit</button>
    </form>

    <script>
    let rowIndex = 0; // Initialize rowIndex

    $('#add-row').click(function () {
        // Get today's date in the required format (YYYY-MM-DD)
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0];

        // Append a new row
        $('#student-table tbody').append(`
            <tr>   
                {{-- Personal Details --}}
                <td><input type="text" name="students[${rowIndex}][name]" placeholder="Enter Name"></td>
                <td><input type="email" name="students[${rowIndex}][email]" placeholder="Enter Email"></td>
                <td><input type="text" name="students[${rowIndex}][phone]" placeholder="Enter Phone"></td>
                <td><input type="text" name="students[${rowIndex}][age]" placeholder="Enter Age"></td>
                <td>
                    <select name="students[${rowIndex}][gen]" id="">
                        <option value="M">Male</option>
                        <option value="F"> Female </option>
                    </select>
                </td>
                <td><input type="text" name="students[${rowIndex}][city]" placeholder="Enter City"></td>
                <td><input type="text" name="students[${rowIndex}][pin]" placeholder="Enter Pin Code"></td>

                {{-- College Details --}}
                <td><input type="text" name="students[${rowIndex}][university]" placeholder="Enter University"></td>
                <td><input type="text" name="students[${rowIndex}][college]" placeholder="Enter College"></td>
                <td>
                    <select name="students[${rowIndex}][dept]" id="">
                        <option value="CS">Computer</option>
                        <option value="ME"> Mechnical </option>
                    </select>
                </td>

                <td><input type="text" name="students[${rowIndex}][batch]" placeholder="Enter Batch"></td>
                <td><input type="text" name="students[${rowIndex}][role]" placeholder="Enter Role No."></td>
                <td><input type="date" name="students[${rowIndex}][start]" class="start-date" placeholder="Start Date" min="${formattedDate}" max="${formattedDate}"></td>
                <td><input type="date" name="students[${rowIndex}][end]" class="end-date" placeholder="End Date" readonly></td>
                <td><input type="text" name="students[${rowIndex}][subject]" placeholder="Enter Subject"></td>
                <td><input type="file" name="students[${rowIndex}][file]"></td>

                {{-- Other Details --}}
                <td><input type="text" name="students[${rowIndex}][fname]" placeholder="Enter Father Name"></td>
                <td><input type="text" name="students[${rowIndex}][mname]" placeholder="Enter Mother Name"></td>
            
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
    </script>
</body>
</html>
