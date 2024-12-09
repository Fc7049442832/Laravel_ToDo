<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date Restriction</title>
</head>
<body>
    <h2>Select a Date</h2>
    @php
    $student = 1;
    @endphp

    <form action="{{ route('deleteFormData', $student) }}" method="POST">
        @csrf
        <input type="date" name="" id="date">
        <button type="submit">Delete</button>
    </form>
    <script>
        // Get today's date
        const today = new Date();
        
        // Format the date to YYYY-MM-DD
        const formattedDate = today.toISOString().split('T')[0];

        // Store the date in a variable
        const minDate = formattedDate;

        // Set the 'min' attribute for the date input
        document.getElementById('date').setAttribute('min', minDate);
    </script>
</body>
</html>
