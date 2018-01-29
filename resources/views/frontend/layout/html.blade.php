<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Revotica értékelés
    </title>
    <link rel="shortcut icon" href="http://revotica.hu/sites/default/files/favicon.ico" type="image/vnd.microsoft.icon" />
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    @stack('styles')

</head>
<body class="bg-info">
@yield('body')
    <script src="{{ URL::asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
