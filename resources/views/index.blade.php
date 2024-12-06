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
    </style>


</head>
<body>
    <h1>Student Data </h1>
    <button type="button" id="add-row">Add Row</button>
    <form id="student-form">
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
                <tr>   
                    {{-- Personal Details --}}
                    <td><input type="text" name="students[0][name]" placeholder="Enter Name"></td>
                    <td><input type="email" name="students[0][email]" placeholder="Enter Email"></td>
                    <td><input type="text" name="students[0][phone]" placeholder="Enter Phone"></td>
                    <td><input type="text" name="students[0][age]" placeholder="Enter Age"></td>
                    <td>
                        <select name="students[0][gen]" id="">
                            <option value="M">Male</option>
                            <option value="F"> Female </option>
                        </select>
                    </td>
                    <td><input type="text" name="students[0][city]" placeholder="Enter City"></td>
                    <td><input type="text" name="students[0][pin]" placeholder="Enter Pin Code"></td>

                    {{-- College Details --}}
                    <td><input type="text" name="students[0][university]" placeholder="Enter University"></td>
                    <td><input type="text" name="students[0][college]" placeholder="Enter College"></td>
                    <td>
                        <select name="students[0][dept]" id="">
                            <option value="CS">Computer</option>
                            <option value="ME"> Mechnical </option>
                        </select>
                    </td>

                    <td><input type="text" name="students[0][batch]" placeholder="Enter Batch"></td>
                    <td><input type="text" name="students[0][role]" placeholder="Enter Role No."></td>
                    <td><input type="date" name="students[0][start]" placeholder="Start Date"></td>
                    <td><input type="date" name="students[0][end]" placeholder="End Date"></td>
                    <td><input type="text" name="students[0][subject]" placeholder="Enter Subject"></td>
                    <td><input type="file" name="students[0][file]"></td>

                    {{-- Other Details --}}
                    <td><input type="text" name="students[0][fname]" placeholder="Enter Father Name"></td>
                    <td><input type="text" name="students[0][mname]" placeholder="Enter Mother Name"></td>
                    <td><button type="button" class="remove-row">Remove</button></td>
                </tr>
            </tbody>
        </table>
        
        <button type="submit">Submit</button>
    </form>

    <script>
        let rowIndex = 1;

        // Add new row
        $('#add-row').click(function () {
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
                    <td><input type="date" name="students[${rowIndex}][start]" placeholder="Start Date"></td>
                    <td><input type="date" name="students[${rowIndex}][end]" placeholder="End Date"></td>
                    <td><input type="text" name="students[${rowIndex}][subject]" placeholder="Enter Subject"></td>
                    <td><input type="file" name="students[${rowIndex}][file]"></td>

                    {{-- Other Details --}}
                    <td><input type="text" name="students[${rowIndex}][fname]" placeholder="Enter Father Name"></td>
                    <td><input type="text" name="students[${rowIndex}][mname]" placeholder="Enter Mother Name"></td>
            
                    <td><button type="button" class="remove-row">Remove</button></td>
                </tr>
            `);
            rowIndex++;
        });

        // Remove row
        $(document).on('click', '.remove-row', function () {
            $(this).closest('tr').remove();
        });

        // Submit form data
        $('#student-form').submit(function (e) {
            e.preventDefault();
            let formData = $(this).serialize();
    console.log(formData); // Debug serialized data


            $.ajax({
                url: "/students/store') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                data: $(this).serialize(),
                success: function (response) {
                    alert(response.message);
                    $('#student-table tbody').html(`
                        <tr>
                            <td><input type="text" name="students[0][name]" placeholder="Enter Name"></td>
                            <td><input type="email" name="students[0][email]" placeholder="Enter Email"></td>
                            <td><input type="text" name="students[0][phone]" placeholder="Enter Phone"></td>
                            <td><input type="text" name="students[0][name]" placeholder="Enter Name"></td>
                            <td><input type="email" name="students[0][email]" placeholder="Enter Email"></td>
                            <td><input type="text" name="students[0][phone]" placeholder="Enter Phone"></td>
                            <td><input type="text" name="students[0][age]" placeholder="Enter Age"></td>
                            <td>
                                <select name="students[0][gen]" id="">
                                    <option value="M">Male</option>
                                    <option value="F"> Female </option>
                                </select>
                            </td>
                            <td><input type="text" name="students[0][city]" placeholder="Enter City"></td>
                            <td><input type="text" name="students[0][pin]" placeholder="Enter Pin Code"></td>

                           
                            <td><input type="text" name="students[0][university]" placeholder="Enter University"></td>
                            <td><input type="text" name="students[0][college]" placeholder="Enter College"></td>
                            <td>
                                <select name="students[0][dept]" id="">
                                    <option value="CS">Computer</option>
                                    <option value="ME"> Mechnical </option>
                                </select>
                            </td>

                            <td><input type="text" name="students[0][batch]" placeholder="Enter Batch"></td>
                            <td><input type="text" name="students[0][role]" placeholder="Enter Role No."></td>
                            <td><input type="date" name="students[0][start]" placeholder="Start Date"></td>
                            <td><input type="date" name="students[0][end]" placeholder="End Date"></td>
                            <td><input type="text" name="students[0][subject]" placeholder="Enter Subject"></td>
                            <td><input type="file" name="students[0][file]"></td>

                            <td><input type="text" name="students[0][fname]" placeholder="Enter Father Name"></td>
                            <td><input type="text" name="students[0][mname]" placeholder="Enter Mother Name"></td>
                            <td><button type="button" class="remove-row">Remove</button></td>
                        </tr>
                    `);
                    rowIndex = 1;
                },
                error: function (error) {
                    alert('Something went wrong!');
                }
            });
        });
    </script>
</body>
</html>
