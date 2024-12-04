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
    <div class="container">
        {{-- Header Section --}}
        <div class="row">
            <div class="col-12 p-3 h2 bg-secondary text-white">
                Student Information System
            </div>
        </div>

        {{-- Data Add Button Section --}}
        <div class="row">
            <div class="col">
                {{-- add Button --}}
                <button id="AddButton" class="btn btn-primary">Add</button> 
            </div>
        </div>

        {{-- Data Add Form Section --}}
        <div class="row">
            <div class="col">
                <div id="AddForm">
                    This is a hidden div that is now visible.
                </div>
            </div>
        </div>

        {{-- Data Show Section --}}
        <div class="row">
            <div class="col">
                @if(1==2)
                    <p>No Data</p>
                @else
                    
                    {{-- Data display loop --}}

                @endif
            </div>
        </div>
    </div>
</body>
</html>