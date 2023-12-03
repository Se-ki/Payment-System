@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/balance/collector/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    <h1>Here ang sa mga list sa payments</h1>
    <div class="card card-outline rounded-0 card-navy">
        <div class="card-header">
            <h3 class="card-title">List of Payment</h3>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <table class="table table-hover table-striped table-bordered" id="list">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="25%">
                        <col width="25%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $key => $payment)
                            <tr>
                                <td> {{ ++$key }} </td>
                                <td> {{ $payment->description }} </td>
                                <td> {{ $payment->amount }} </td>
                                <td align="center">
                                    <button type="button"class="btn btn-flat btn-primary p-1 btn-default btn-sm  ">
                                        <a href="{{ route('balance.create') }}">
                                            Pay
                                        </a>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
