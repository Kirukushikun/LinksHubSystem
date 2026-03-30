<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title', 'BGC Links Hub')</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/ico" href="{{ asset('img/BFC.ico') }}">
        @yield('styles')
    </head>
    <body>
        <canvas id="doodle-bg"></canvas>
        @yield('content') @yield('scripts')
    </body>
</html>
