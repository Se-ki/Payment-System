@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/balance/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    <h1>Here ang sa mga list sa payments</h1>
    <a href="{{ route('balance.create') }}">button to see form for walkin</a>
@endsection
