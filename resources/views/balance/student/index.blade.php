@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/balance/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    <h1>Here ang sa mga list sa student</h1>
    <a href="{{ route('balance.student.payment.index') }}">button to see payments</a>
@endsection
