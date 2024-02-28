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
                <main class="cd__main">
                    <table id="student-table" class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </main>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var studentTable = $('#student-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ajax-fetch-students') }}",
                columns: [{
                        data: 'school_id',
                    },
                    {
                        data: 'fullname',
                    },
                    {
                        data: 'action',
                    },
                ],
            })
        });
    </script>
@endsection
