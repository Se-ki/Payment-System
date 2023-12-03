@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/balance/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    <!--Container Main start-->
    <div class="wrapper rounded">
        <div class="col-auto mt-3 ">
            <h2 class="fw-bold">Student Balance Payments</h2>
        </div>
        <main class="cd__main">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Description</th>
                        <th scope="col">Receipt Number</th>
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
                            <td> {{ $balance->sbp_description }} </td>
                            <td> {{ $balance->sbp_receipt_number }} </td>
                            <td> {{ $balance->sbp_paid_amount }} </td>
                            <td> {{ $balance->sbp_paid_change }} </td>
                            <td> {{ $balance->sbp_balance_amount }} </td>
                            <td> {{ $balance->sbp_date_paid }} </td>
                            <td> {{ $balance->status }} </td>
                            <td> {{ $balance->encoder }} </td>
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
