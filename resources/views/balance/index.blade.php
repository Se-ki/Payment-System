@extends('layouts.main')
@section('title', 'Student Balance Payments')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/balance/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    <!--Container Main start-->
    <div class="card card-outline rounded-0 card-navy   ">
        <span class="border-top border-black "></span>
        <div class="wrapper rounded">
            <div class="card-header">
                <div class="col-auto mt-3 ">
                    <h2 class="fw-bold">My Balance Payments</h2>
                </div>
            </div>
            <main class="cd__main">
                <table id="example" class="table table-hover table-striped table-bordered ">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Receipt Number</th>
                            <th scope="col">Description</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Paid Amount</th>
                            <th scope="col">Change Amount</th>
                            <th scope="col">Balance Amount</th>
                            <th scope="col">Date Paid</th>
                            <th scope="col">Status</th>
                            <th scope="col">Collector</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($balances as $key => $balance)
                            <tr>
                                <td> {{ ++$key }} </td>
                                <td> {{ $balance->sbp_receipt_number }} </td>
                                <td> {{ $balance->sbp_description }} </td>
                                <td> {{ Number::currency($balance->sbp_amount, in: 'PHP', locale: 'ph') }} </td>
                                <td> {{ Number::currency($balance->sbp_paid_amount, in: 'PHP', locale: 'ph') }} </td>
                                <td> {{ Number::currency($balance->sbp_paid_change, in: 'PHP', locale: 'ph') }} </td>
                                <td> {{ Number::currency($balance->sbp_balance_amount, in: 'PHP', locale: 'ph') }} </td>
                                <td> {{ $balance->sbp_date_paid }} </td>
                                <td> {{ $balance->status }} </td>
                                <td> {{ $balance->collector->lastname }},
                                    {{ $balance->collector->firstname }}
                                    {{ isset($balance->collector->middlename) ? substr($balance->collector->middlename, 0, 1) . '.' : null }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </main>
        </div>
    </div>
    <!--Container Main end-->
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                //disable sorting on last column
                "columnDefs": [{
                    "orderable": false,
                    "targets": 8
                }],
                language: {
                    //customize pagination prev and next buttons: use arrows instead of words
                    'paginate': {
                        'previous': '<span class="fa fa-chevron-left"></span>',
                        'next': '<span class="fa fa-chevron-right"></span>'
                    },
                    //customize number of elements to be displayed
                    "lengthMenu": 'Display <select class="form-control input-sm">' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">All</option>' +
                        '</select> results'
                }
            })
        });
    </script>
@endsection
