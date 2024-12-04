<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container-xll m-2">
        {{-- Header Section --}}
        <div class="row text-center">
            <div class="col-12 p-3 h2 bg-secondary text-white">
                Student Information System
            </div>
        </div>
        <div class="row" >
            <div class="col-3">
                <button id="addDiv">Add New</button>
            </div>
        </div>
        {{-- main Container --}}
        <div class="row p-5 m-2">
            <div class="table-scrollable border rounded">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="main-table">
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>DOB</th>
                            <th>University</th>
                            <th>College</th>
                            <th>Roll No</th>
                            <th>Batch No</th>
                            <th>Department</th>
                            <th>Phone</th>
                            <th>Alternate Phone</th>
                            <th>Email</th>
                            <th>Alternate Email</th>
                            <th>Father Name</th>
                            <th>Mother Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Document</th>
                            <th>Verify</th>
                            <th>Action</th>
                        </tr>  
                    </thead>
                    <tbody id="mainContainer">
                        <tr>
                            <td>1</td>
                            <td>John</td>
                            <td>Doe</td>
                            <td>01-01-2000</td>
                            <td>ABC University</td>
                            <td>XYZ College</td>
                            <td>12345</td>
                            <td>2023</td>
                            <td>Computer Science</td>
                            <td>9876543210</td>
                            <td>9876501234</td>
                            <td>john.doe@example.com</td>
                            <td>john.alt@example.com</td>
                            <td>Mr. Doe</td>
                            <td>Mrs. Doe</td>
                            <td>123 Main Street</td>
                            <td>New York</td>
                            <td><a href="#" class="btn btn-sm btn-info">View</a></td>
                            <td><span class="badge bg-success">Verified</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>