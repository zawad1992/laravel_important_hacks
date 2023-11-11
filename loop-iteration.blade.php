{{-- example.blade.php --}}

{{-- 
This Blade template demonstrates the use of $loop->iteration for displaying serial numbers in a loop.
The $loop variable is a special object provided by Laravel in Blade loops, which holds the loop's current iteration, index, and other useful information.

Usage:
- Place this Blade file in the resources/views directory of your Laravel application.
- Render this view from a controller or route, passing an array or collection that needs to be iterated over.
- This example is particularly useful for displaying lists or tables with serial numbers.
--}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Serial Number Iteration Example</title>
</head>
<body>
    <h1>Items List</h1>
    <ul>
        {{-- Iterate over each item in the passed collection/array --}}
        @foreach ($items as $item)
            <li>
                {{-- Display the current iteration number --}}
                Serial No: {{ $loop->iteration }} - Item Name: {{ $item->name }}
            </li>
        @endforeach
    </ul>
</body>
</html>
