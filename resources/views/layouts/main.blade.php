<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ $header ?? config('app.name') }}</title>
    @include('partials.inc-top') 
    {{-- studentindex.blade.php --}}
</head>

<body id="body-pd">
    @yield('content')

    @include('partials.inc-bottom')
</body>

</html>
