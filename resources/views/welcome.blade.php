<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-dark">

    <div class="d-flex align-items-center justify-content-center flex-column gap-2">
        <div>
            <h1 class="text-white">Virtual business card generator</h1>
        </div>
        <a href="{{ route('generate') }}" class="btn btn-outline-light">Generate</a>
    </div>

</body>
</html>
