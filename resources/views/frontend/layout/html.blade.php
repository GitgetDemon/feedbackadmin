<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    @yield('css')

</head>
<body>
@yield('body')
    <script src="{{ URL::asset('js/app.js') }}"></script>
@yield('js')
</body>
</html>
