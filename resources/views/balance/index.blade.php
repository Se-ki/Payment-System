@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/records/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    <!--Container Main start-->
    <div class="wrapper rounded">
        <nav class="navbar navbar-expand-lg navbar-dark dark d-lg-flex align-items-lg-start m-4"> <a class="navbar-brand"
                href="#">Transactions <p style="color: bbb;">Welcome to your transactions
                </p> </a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span
                    class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item "> <a href="#"><span class="fa fa-search"></span></a><input type="search"
                            class="dark" placeholder="Search"> </li>
                </ul>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="first" value="option1">
                <label class="form-check-label" for="first">1 Semester</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="second" value="option2">
                <label class="form-check-label" for="Second">2 Semester</label>
            </div>

            <select name="acad-year" id="acad-year">
                <option value="">2021-2022</option>
                <option value="">2022-2023</option>
                <option value="">2023-2024</option>
            </select>
        </nav>
        <div class="table-responsive mt-3">
            <table class="table">
                <thead>
                    <tr>
                    <tr>
                        <th>No.</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Encoder</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($balances as $key => $balance)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $balance->sbp_description }}</td>
                            <td>{{ $balance->sbp_date_paid }}</td>
                            <td> ₱ {{ number_format($balance->sbp_paid_amount, 2) }}</td>
                            <td> {{ $balance->status }}</td>
                            <td> {{ $balance->encoder }}</td>
                        </tr>
                    @endforeach
                </tbody>

                <section>
                    <h2>Account Balance</h2>
                    <p>Your current balance is $500.00.</p>
                </section>



                {{-- <thead>
                    <tr>
                        <th scope="col">Activity</th>
                        <th scope="col">Mode</th>
                        <th scope="col">Date Paid</th>
                        <th scope="col" class="">Amount</th>
                    </tr> --}}
                {{-- </thead> --}}
                {{-- <tbody style="background-color: #333">
                    @foreach ($records as $key => $record)
                        <tr>
                            <td scope="row" class="text-white">
                                <span class="fa fa-briefcase mr-1"></span>
                                {{ ++$key }} {{ $record->description }}
                            </td>
                            <td>
                                <span class="row text-white">
                                    {{ $record->mode }}
                                </span>
                            </td>
                            <td class="text-white">
                                {{ Carbon\Carbon::parse($record->paid_date)->format('F j, Y') }}
                            </td>

                            <td class="text-white">
                                {{ '₱ ' . number_format($record->amount, 2) }}
                            </td>

                            <td>
                                <a style="color: blue; cursor:pointer" data-toggle="modal" id="recordButton"
                                    data-target="#recordModal" data-attr="{{ route('records.show', $record->id) }}"
                                    title="show">
                                    <i class='bx bxs-show'></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    {{-- {{}} --}}
                {{-- </tbody> --}}
            </table>
            {{-- <center>
                <p class=" text-muted pl-1">No transaction has been made.</p>
            </center> --}}
        </div>
        <!-- Modal -->
        {{-- <div class="modal fade" id="recordModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Records Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="recordBody">

                    </div>
                </div>
            </div>
        </div>
    </div> --}}
        <!--Container Main end-->
    @endsection
