@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/payment/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    <h1>Add Payments</h1>
    <form action="{{ route('payments-store') }}" method="POST">
        @csrf
        <input type="text" name="description" placeholder="Description">
        <input type="text" name="amount" placeholder="Amount">
        <input type="date" name="deadline" placeholder="Deadline">
        <select name="semesters" id="">
            <option value="1">1st Semester</option>
            <option value="2">2nd Semester</option>
        </select>
        <button type="submit">Add Payment</button>
    </form>
@endsection
