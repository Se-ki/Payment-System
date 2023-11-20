<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @include('partials.inc_top')
</head>

<body id="body-pd">
    @yield('content')

    @include('partials.inc_bottom')
</body>

</html>