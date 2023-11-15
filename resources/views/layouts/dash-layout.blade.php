<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>eCom | Dashboard</title>
    @vite(['resources/sass/custom.scss', 'resources/js/custom.js'])
</head>

<body>
    <!-- flash message -->
    <x-flash-message />
    
    <!-- nav -->
    <x-dash-top-nav />

    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <x-dash-nav />
            </div>
            <div class="col mb-4">
                <div class="shadow p-3 rounded">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>

</html>
