@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    @if (Auth::user()->role_type_id === 1)
        {{-- salas html --}}

        <div class="hero_area">
            <section class="slider_section">
                <div class="slider_bg_box">
                    <img src="img/csu4.png" alt="" />
                </div>
                <div class="carousel-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="detail-box">
                                    <h1 style="font-style:italic; font-size: 40px;">
                                        Welcome
                                        {{ Auth::user()->student->firstname }} {{ Auth::user()->student->lastname }}, <br />
                                        to <span style="font-size: 50px; color: red;">E</span>-Payment Service.
                                    </h1>
                                    <p>
                                        Thank you for choosing E-Payment Gateway, where convenience meets security. We
                                        appreciate your trust in us.
                                        Seamlessly navigate through secure and transparent transactions, knowing your
                                        satisfaction is our priority.
                                        Your payments, your way - experience the ease with E-Payment.
                                    </p>
                                    <div class="btn-box">
                                        <a href="./payments" class="btn1 text-decoration-none">Pay Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <section class="footer_section">
            <div class="container">
                <p>
                    &copy; <span id="displayYear"></span> All Rights Reserved By CSUCC Cabadbaran City Campus,
                    Distributed By CKA - AC - JS ®
                </p>
            </div>
        </section>



        {{-- <div class="container"> --}}
        {{-- <div class="row">
                <div class="col-sm-6  ms-auto mt-2">
                    <div class="card card-2">
                        <div class="card-body">
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="card-footer footer-1 ">
                            <a href="#" class="v-more">More Details</a>
                        </div>
                    </div>
                </div> --}}

        {{-- <div class="col-sm-6 mt-2 mb-2">
                    <div class="card card-3">
                        <div class="card-body">
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="card-footer footer-2">
                            <a href="#" class="View"> View More </a>
                        </div>
                    </div>
                </div> --}}

        </div>
        </div>
    @elseif (Auth::user()->role_type_id === 2 || Auth::user()->role_type_id === 3)
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
                                    <h4 style="color:white;">Total Student</h4>
                                    <h5 style="color:white;">
                                        <!-- condition diri nya -->
                                        {{ App\Helper\PS::totalStudent() }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <i class='icon-card bx bxs-wallet mb-2'></i>
                                    <h4 style="color:white;">Collect Amount</h4>
                                    <h5 style="color:white;">
                                        <!-- condition diri nya -->
                                        {{ App\Helper\PS::totalCollectAmount() }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <i class="icon-card fa fa-list mb-2"></i>
                                    <h4 style="color:white;">Total Payments</h4>
                                    <h5 style="color:white;">
                                        <!-- condition diri nya -->
                                        {{ App\Helper\PS::totalPayments() }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <i class='icon-card bx bx-money-withdraw mb-2'></i>
                                    <h4 style="color:white;">Student Payment</h4>
                                    <h5 style="color:white;">
                                        <!-- condition diri nya -->
                                        {{ App\Helper\PS::totalStudentPayments() }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="">
                            <img src="{{ asset('img/bg-csucc.jpg') }}" style="height: 94vh; width: 100%; " />
                        </div>
                        <section class="footer_section" style="background-color: #212b21;">
                            <div class="container">
                                <p>
                                    &copy; <span id="displayYear"></span> All Rights Reserved By CSUCC Cabadbaran
                                    City
                                    Campus,
                                    Distributed By CKA - AC - JS ®
                                </p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        {{-- @else
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
                        <section class="footer_section" style="background-color: #212b21;">
                            <div class="container">
                                <p>
                                    &copy; <span id="displayYear"></span> All Rights Reserved By CSUCC Cabadbaran
                                    City
                                    Campus,
                                    Distributed By CKA - AC - JS ®
                                </p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div> --}}
    @endif
@endsection
