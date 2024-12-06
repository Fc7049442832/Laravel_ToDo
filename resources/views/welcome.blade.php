<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Table with PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <table class="table" id="mainContainer">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Date of Birth</th>
                    <th>University</th>
                    <th>College</th>
                    <th>Roll No</th>
                    <th>Batch No</th>
                    <th>Department</th>
                    <th>Phone</th>
                    <th>Alternate Phone</th>
                    <th>Email</th>
                    <th>Alternate Email</th>
                    <th>Father's Name</th>
                    <th>Mother's Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Document</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 0; // Initialize counter
                @endphp
                @foreach($students as $student)
                    <tr>
                        <td><input type="text" name="" class="form-control" value="{{ ++$count }}" readonly></td>
                        <td><input type="text" name="name[]" class="form-control" value="{{ $student->name }}" required></td>
                        <td><input type="text" name="surname[]" class="form-control" value="{{ $student->surname }}" required></td>
                        <td><input type="date" name="dob[]" class="form-control" value="{{ $student->dob }}" required></td>
                        <td><input type="text" name="university[]" class="form-control" value="{{ $student->university }}" required></td>
                        <td><input type="text" name="college[]" class="form-control" value="{{ $student->college }}" required></td>
                        <td><input type="text" name="roll_no[]" class="form-control" value="{{ $student->roll_no }}" required></td>
                        <td><input type="text" name="batch_no[]" class="form-control" value="{{ $student->batch_no }}" required></td>
                        <td>
                            <select name="dept[]" class="form-control" required>
                                <option value="CS" {{ $student->dept == 'CS' ? 'selected' : '' }}>Computer Science</option>
                                <option value="CV" {{ $student->dept == 'CV' ? 'selected' : '' }}>Civil</option>
                                <option value="EC" {{ $student->dept == 'EC' ? 'selected' : '' }}>Electronics</option>
                                <option value="ME" {{ $student->dept == 'ME' ? 'selected' : '' }}>Mechanical</option>
                            </select>
                        </td>
                        <td><input type="text" name="phone[]" class="form-control" value="{{ $student->phone }}" required></td>
                        <td><input type="text" name="a_phone[]" class="form-control" value="{{ $student->a_phone }}"></td>
                        <td><input type="email" name="email[]" class="form-control" value="{{ $student->email }}" required></td>
                        <td><input type="email" name="a_email[]" class="form-control" value="{{ $student->a_email }}"></td>
                        <td><input type="text" name="f_name[]" class="form-control" value="{{ $student->f_name }}" required></td>
                        <td><input type="text" name="m_name[]" class="form-control" value="{{ $student->m_name }}" required></td>
                        <td><input type="text" name="address[]" class="form-control" value="{{ $student->address }}" required></td>
                        <td><input type="text" name="city[]" class="form-control" value="{{ $student->city }}" required></td>
                        <td><input type="file" name="doc[]" class="form-control" required></td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-primary" id="addDiv">Add Row</button>
    </div>

    <script>
        $("#addDiv").click(function () {
            let count = $("#mainContainer tr").length; // Count rows
            const newRow = `
                <tr>
                    <td><input type="text" name="" class="form-control" value="${count + 1}" readonly></td>
                    <td><input type="text" name="name[]" class="form-control" required></td>
                    <td><input type="text" name="surname[]" class="form-control" required></td>
                    <td><input type="date" name="dob[]" class="form-control" required></td>
                    <td><input type="text" name="university[]" class="form-control" required></td>
                    <td><input type="text" name="college[]" class="form-control" required></td>
                    <td><input type="text" name="roll_no[]" class="form-control" required></td>
                    <td><input type="text" name="batch_no[]" class="form-control" required></td>
                    <td>
                        <select name="dept[]" class="form-control" required>
                            <option value="CS">Computer Science</option>
                            <option value="CV">Civil</option>
                            <option value="EC">Electronics</option>
                            <option value="ME">Mechanical</option>
                        </select>
                    </td>
                    <td><input type="text" name="phone[]" class="form-control" required></td>
                    <td><input type="text" name="a_phone[]" class="form-control"></td>
                    <td><input type="email" name="email[]" class="form-control" required></td>
                    <td><input type="email" name="a_email[]" class="form-control"></td>
                    <td><input type="text" name="f_name[]" class="form-control" required></td>
                    <td><input type="text" name="m_name[]" class="form-control" required></td>
                    <td><input type="text" name="address[]" class="form-control" required></td>
                    <td><input type="text" name="city[]" class="form-control" required></td>
                    <td><input type="file" name="doc[]" class="form-control" required></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td>
                </tr>
            `;
            $("#mainContainer").append(newRow);
        });

        // Remove row functionality
        $(document).on('click', '.remove-row', function () {
            $(this).closest('tr').remove();
        });
    </script>
</body>
</html>
