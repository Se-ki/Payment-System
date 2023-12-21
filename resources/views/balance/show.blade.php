@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/balance/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    <!--Container Main start-->
    <div class="wrapper rounded">
        <div class="col-auto mt-3 ">
            <h2 class="fw-bold">{{ $user->student->firstname }} {{ $user->student->lastname }} Balance Payments</h2>
        </div>
        <main class="cd__main">
            <table id="example" class="table table-striped" style="width:100%">
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
                        <th scope="col">Action</th>
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
                                {{ $balance->collector->firstname }} {{ substr($balance->collector->middlename, 0, 1) }}.
                            </td>
                            <td>
                                @if ($balance->sbp_balance_amount != 0 && $balance->collector->id == Auth::user()->id)
                                    <a href="{{ route('balance.edit', $balance->id) }}">Form</a>
                                @elseif($balance->sbp_balance_amount == 0)
                                    Paid
                                @else
                                    <small>Collected by {{ $balance->collector->lastname }},
                                        {{ $balance->collector->firstname }}
                                        {{ substr($balance->collector->middlename, 0, 1) }}.</small>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('balance.student.index') }}">Back</a>
        </main>
    </div>
    <!--Container Main end-->
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                //disable sorting on last column
                "columnDefs": [{
                    "orderable": false,
                    "targets": 10
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
