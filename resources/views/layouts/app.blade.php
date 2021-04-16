<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(parse_url(url('/'), PHP_URL_SCHEME) == 'HTTPS'){
    <link rel="stylesheet" href="{{secure_asset('css/app.css')}}">
    @else
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @endif
    <title>ABSX Suporte</title>
</head>

<body>
    <div id="app">
        @yield('corpo')
    </div>
    @if(parse_url(url('/'), PHP_URL_SCHEME) == 'HTTPS'){
    <script src="{{secure_asset('js/app.js')}}"></script>
    @else
    <script src="{{asset('js/app.js')}}"></script>

    @endif

</body>

</html>