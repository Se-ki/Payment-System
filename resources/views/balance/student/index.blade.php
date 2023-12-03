@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/balance/collector/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    {{-- <h1>Here ang sa mga list sa student</h1> --}}
    {{-- <a href="{{ route('balance.student.payment.index') }}" <span class="fa fa-eye text-primary "></span> View
    </a> --}}
    <div class="card card-outline rounded-0 card-navy">
        <div class="card-header">
            <h3 class="card-title">List of Student</h3>
            {{-- <div class="card-tools">
                <a href="" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Create
                    New</a>
            </div> --}}
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <table class="table table-hover table-striped table-bordered" id="list">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="25%">
                        <col width="15%">

                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date Created</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td> {{ ++$key }} </td>
                                <td> {{ $user->student->created_at->format('F, m Y') }} </td>

                                <td> {{ $user->student->firstname }} {{ $user->student->middlename }}
                                    {{ $user->student->lastname }} </td>
                                <td align="center">
                                    <li class="nav-item dropdown">
                                        <a class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon"
                                            data-bs-toggle="dropdown">
                                            Action
                                        </a>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item edit_data"
                                                href="{{ route('balance.student.payment.index', $user->username) }}"><span
                                                    class="fa fa-edit text-primary"></span> View</a>
                                            {{-- <div class="dropdown-divider"></div> --}}
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
@endsection
