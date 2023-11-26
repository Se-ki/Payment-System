@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    @if (Auth::user()->role_type_id === 1)
        <div class="container">
            <div class="row">
                <div class="col-sm-6  ms-auto mt-2">
                    <div class="card card-2">
                        <div class="card-body">
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="card-footer footer-1 ">
                            <a href="#" class="v-more">More Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 mt-2 mb-2">
                    <div class="card card-3">
                        <div class="card-body">
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="card-footer footer-2">
                            <a href="#" class="View"> View More </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @elseif (Auth::user()->role_type_id === 2)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Collector Dashboard') }}</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('You are logged in!') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Admin Dashboard') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('You are logged in!') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
