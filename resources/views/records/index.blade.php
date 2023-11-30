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
        </nav>
        <div class="table-responsive mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Mode</th>
                        <th scope="col">Date Paid</th>
                        <th scope="col" class="">Amount</th>
                    </tr>
                </thead>
                <tbody style="background-color: #333">
                    @foreach ($records as $key => $record)
                        <tr>
                            <td scope="row" class="text-white">
                                <span class="fa fa-briefcase mr-1"></span>
                                {{ ++$key }} {{ $record->spr_description }}
                            </td>
                            <td>
                                <span class="row text-white">
                                    {{ $record->spr_mode_of_payment }}
                                </span>
                            </td>
                            <td class="text-white">
                                {{ Carbon\Carbon::parse($record->spr_paid_date)->format('F j, Y') }}
                            </td>

                            <td class="text-white">
                                {{ '₱ ' . number_format($record->spr_amount, 2) }}
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
                </tbody>
            </table>
            @if (!count($records))
                <center>
                    <p class=" text-light pl-1">No transaction has been made.</p>
                </center>
            @endif
        </div>
        <!-- Modal -->
        <div class="modal fade" id="recordModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
    </div>
    <!--Container Main end-->
@endsection
