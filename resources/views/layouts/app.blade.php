<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <title>EspecializaTi</title>
        <meta name="description" content="Cursos de PHP e Laravel. Confira!">
        
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    </head>
    <body>
        <div id="app">
            @yield('content')
        </div>

        <script src="{{ url('js/app.js') }}"></script>
    </body>
</html>