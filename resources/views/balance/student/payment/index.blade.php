@extends('layouts.main')
@section('title', "Payments of {$student->firstname}")
@section('content')
    <link rel="stylesheet" href="{{ asset('css/balance/collector/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    {{-- <h1>Here ang sa mga list sa payments</h1> --}}
    <div class="card card-outline rounded-0 card-navy">
        <span class="border-top border-black "></span>
        <div class="card-header">
            <h3 class="card-title">List of Payment</h3>
            <a href="{{ route('balance.student.index') }}">Back</a>
        </div>
        <div class="card-body">
            <main class="cd__main">
                <table id="example" class="table table-hover table-striped table-bordered" id="list">
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
                                <td> {{ $payment->description->name }} </td>
                                <td> {{ Number::currency($payment->amount, in: 'PHP', locale: 'ph') }} </td>
                                <td class="action">
                                    <a href="{{ route('balance.create', $payment->id) }}">
                                        <button type="button" class="btn btn-flat btn-primary p-1 btn-default btn-sm"
                                            style="width:70px">
                                            Pay
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </main>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                //disable sorting on last column
                "columnDefs": [{
                    "orderable": false,
                    "targets": 3
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
