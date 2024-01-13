@extends('layouts.main')
@section('title', 'List of Students')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/balance/collector/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    <div class="card card-outline rounded-0 card-navy">
        <span class="border-top border-black "></span>
        <div class="card-header">
            <h3 class="card-title">List of Student</h3>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <table id="example" class="table table-hover table-striped table-bordered" id="list">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="25%">
                        <col width="15%">

                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td> {{ ++$key }} </td>
                                <td> {{ App\Helper\PS::addHyphenAfterFourNumbers($user->student->school_id) }} </td>

                                <td> {{ $user->student->lastname }}, {{ $user->student->firstname }}
                                    {{ substr($user->student->lastname, 0, 1) }}. </td>
                                <td class="action">
                                    <li class="nav-item dropdown">
                                        <a class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle btn-outline-primary dropdown-icon"
                                            data-bs-toggle="dropdown">
                                            Action
                                        </a>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item edit_data"
                                                href="{{ route('balance.student.payment.index', $user->username) }}"><span
                                                    class="fa fa-edit text-primary fw-bold m-2"></span>Payments</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item edit_data"
                                                href="{{ route('balance.show', $user->username) }}"><span
                                                    class="fa fa-regular fa-money-bill-1 text-danger fw-bold m-2"></span>
                                                Balance</a>
                                        </div>
                                    </li>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
