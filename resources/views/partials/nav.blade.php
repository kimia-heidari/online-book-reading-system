<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">
    @yield('additional_css')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>
    @yield('additional_js')
</body>
</html>
