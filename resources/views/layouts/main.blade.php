<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @include('partials.inc-top')
</head>

<body id="body-pd">
    @yield('content')
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
            class="fixed bg-blue-500 text-white py-2 rounded-xl bottom-3 right-3 text-sm px-3">
            {{ session('success') }}
        </div>
    @endif
    @include('partials.inc-bottom')
</body>

</html>
