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

            <div class="container">
                <p style="font-weight: bold; font-size: 40px;">Welcome to <span
                        style="font-size: 50px; color: blue;">E</span>-Payment, {{ Auth::user()->student->firstname }}
                </p>

                <div class="admin height-100">
                    <div id="main-content" class="container allContent-section py-4">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="card">
                                    <i class="icon-card fa fa-users  mb-2"></i>
                                    <h4 style="color:white;">Total Users</h4>
                                    <h5 style="color:white;">
                                        <!-- condition diri nya -->

                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <i class='icon-card bx bxs-wallet mb-2'></i>
                                    <h4 style="color:white;">Total Amount</h4>
                                    <h5 style="color:white;">
                                        <!-- condition diri nya -->
                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <i class="icon-card fa fa-list mb-2"></i>
                                    <h4 style="color:white;">Total Bills</h4>
                                    <h5 style="color:white;">
                                        <!-- condition diri nya -->
                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <i class='icon-card bx bx-money-withdraw mb-2'></i>
                                    <h4 style="color:white;">Total Paid</h4>
                                    <h5 style="color:white;">
                                        <!-- condition diri nya -->
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="">
                            <img src="{{ asset('img/bg-csucc.jpg') }}" style="height: 94vh; width: 100%; " />
                        </div>
                        <section class="footer_section py-3"
                            style="background-color: #506e50; padding-left: 200px; height: 8vh; ">
                            <div class="container">
                                <p class="text-light">
                                    &copy; <span id="displayYear"></span> All Rights Reserved By CSUCC Cabadbaran City
                                    Campus,
                                    Created By CKA - AC - JS
                                </p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container">

            <div class="container">
                <p style="font-weight: bold; font-size: 40px;">Welcome to <span
                        style="font-size: 50px; color: blue;">E</span>-Payment!</p>

                <div class="admin height-100">
                    <div id="main-content" class="container allContent-section py-4">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="card">
                                    <i class="icon-card fa fa-users  mb-2"></i>
                                    <h4 style="color:white;">Total Users</h4>
                                    <h5 style="color:white;">
                                        <!-- condition diri nya -->

                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <i class='icon-card bx bxs-wallet mb-2'></i>
                                    <h4 style="color:white;">Total Amount</h4>
                                    <h5 style="color:white;">
                                        <!-- condition diri nya -->
                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <i class="icon-card fa fa-list mb-2"></i>
                                    <h4 style="color:white;">Total Bills</h4>
                                    <h5 style="color:white;">
                                        <!-- condition diri nya -->
                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <i class='icon-card bx bx-money-withdraw mb-2'></i>
                                    <h4 style="color:white;">Total Paid</h4>
                                    <h5 style="color:white;">
                                        <!-- condition diri nya -->
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="">
                            <img src="{{ asset('img/bg-csucc.jpg') }}" style="height: 94vh; width: 100%; " />
                        </div>
                        <section class="footer_section py-3"
                            style="background-color: #506e50; padding-left: 200px; height: 8vh; ">
                            <div class="container">
                                <p class="text-light">
                                    &copy; <span id="displayYear"></span> All Rights Reserved By CSUCC Cabadbaran City
                                    Campus,
                                    Created By CKA - AC - JS
                                </p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
