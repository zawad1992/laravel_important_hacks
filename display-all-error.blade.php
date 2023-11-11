{{-- display-all-error.blade.php --}}

{{-- 
This Blade template demonstrates how to display validation errors in Laravel.
There are two methods shown here:
1. Displaying all errors together.
2. Showing errors individually under each respective field.
--}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Validation Errors Display</title>
    <style>
        .error { color: red; } /* Basic CSS for error messages */
    </style>
</head>
<body>
    <h1>Form with Validation Errors Display</h1>

    {{-- Method 1: Displaying all errors together --}}
    @if ($errors->any())
        <div class="error-messages">
            {{ implode('', $errors->all('<div>:message</div>')) }}
        </div>
    @endif

    {{-- Example form --}}
    <form method="POST" action="{{ url('submit-form') }}">
        @csrf

        {{-- Input field for 'firstname' --}}
        <div>
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}">
            {{-- Method 2: Showing error for 'firstname' field --}}
            @if ($errors->has('firstname'))
                <div class="error">{{ $errors->first('firstname') }}</div>
            @endif
        </div>

        {{-- Add other form fields and error displays as necessary --}}
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>
