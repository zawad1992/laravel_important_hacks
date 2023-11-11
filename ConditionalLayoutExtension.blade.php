{{-- Conditional Layout Extension in Blade --}}

{{-- 
This Blade template demonstrates how to extend different layouts 
based on whether the user is authenticated or not. 
It uses Laravel's `Auth` facade to check the authentication status.

Usage:
- Place this template in the `resources/views` directory of your Laravel application.
- Name the file appropriately, for example, `conditional-layout.blade.php`.
- Ensure that the `layouts.outside` and `layouts.admin` layouts exist in your `resources/views/layouts` directory.
- Use this template as a standard Blade view in your routes or controllers.

Note:
- This technique is useful for displaying different layouts for guest users and authenticated users.
- Remember to modify the layouts and paths according to your application's structure.
--}}

@extends(Auth::check() ? 'layouts.outside' : 'layouts.admin')

{{-- Your Blade template content goes here --}}
@section('content')
    <h1>{{ Auth::check() ? 'Authenticated User View' : 'Guest User View' }}</h1>
    {{-- Add more content as needed --}}
@endsection
