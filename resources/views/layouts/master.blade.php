<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'eCom Omo') }}</title>
    @vite(['resources/sass/custom.scss', 'resources/js/custom.js'])
</head>

<body class="d-flex flex-column min-vh-100 ">
    <!-- flash message -->
    <x-flash-message />

    <!-- nav bar -->
    <x-my-nav />
    <main class="container mt-4">
        @yield('content')
    </main>

    @include('partials._footer')

    @vite('resources/js/custom.js')
</body>

</html>
