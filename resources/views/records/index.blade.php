@extends('layouts.main')
@section('title', 'Student Payment Records')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/records/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    <!--Container Main start-->
    <span class="border-top border-black "></span>
    <div class="card-header ">
        <p>
        <div class="form">
            <form class="row g-3">
                <div class="col-auto mt-3 ">
                    @if (Auth::user()->role_type_id === 1)
                        <h2 class="fw-bold">My Payment Records</h2>
                    @else
                        <h2 class="fw-bold">Student Payment Records Online</h2>
                    @endif
                </div>

                <div class="col-auto mt-4" style="margin-left: 100px">
                    <div class="form-check form-check-inline">
                        <a
                            href="{{ route('record.index') }}?semester=1{{ request('year') ? '&' : '' }}{{ http_build_query(request()->except('semester')) }}">
                            <input class="form-check-input" type="radio" name="sem" id="first-sem" value="1"
                                {{ request('semester') == 1 ? 'checked' : '' }} />
                            <label class="form-check-label">1 Semester</label>
                        </a>
                    </div>
                    <div class="form-check form-check-inline">
                        <a
                            href="{{ route('record.index') }}?semester=2{{ request('year') ? '&' : '' }}{{ http_build_query(request()->except('semester')) }}">
                            <input class="form-check-input" type="radio" name="sem" id="second-sem" value="2"
                                {{ request('semester') == 2 ? 'checked' : '' }}>
                            <label class="form-check-label">2 Semester</label>
                        </a>
                    </div>
                </div>
                <div class="col-auto drpdwn">
                    <div class="dropdown">
                        <button
                            style="background-color:rgb(243, 242, 242); color:black; height:2rem; border-color:rgb(255, 255, 255)"
                            class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ isset($currentYear) && $currentYear != null ? $currentYear->first()->year : $academics->first()->year }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ isset($currentYear) && $currentYear->first()->year === $academics->first()->year ? 'active' : null }}"
                                    href="{{ route('record.index') }}?{{ request('semester') ? 'semester=' . request('semester') . '&' : null }}year={{ $academics->first()->year }}">{{ $academics->first()->year }}</a>
                            </li>
                            @if (count($academics) > 1)
                                @foreach ($academics->skip(1) as $academic)
                                    <li><a class="dropdown-item {{ isset($currentYear) && $currentYear->first()->is($academic) ? 'active' : null }}"
                                            href="{{ route('record.index') }}?{{ request('semester') ? 'semester=' . request('semester') . '&' : null }}year={{ $academic->year }}">{{ $academic->year }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
        </div>
    </div>
    </form>
    <div class="card card-outline rounded-0 card-navy">
        <div class="card-body">
            <div class="container-fluid">
                <table id="record-table" class="table table-hover table-striped table-bordered ">
                    <thead>
                        <tr>
                            @if (Auth::user()->role_id != 1)
                                <th>Student Name</th>
                            @else
                                <th>#</th>
                            @endif
                            <th>Receipt Number</th>
                            <th>Description</th>
                            <th>Mode</th>
                            <th>Date Paid</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
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

    <!--Container Main end-->
    <script>
        $(document).ready(function() {
            $('#record-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ajax-fetch-records') }}",
                columns: [{
                        data: 'student',
                        render: function(data, type, full, meta) {
                            var roleId = "{{ Auth::user()->role_id }}"
                            return roleId != 1 ? data : meta.row + 1;
                        },
                    },
                    {
                        data: 'spr_receipt_number',
                    },
                    {
                        data: 'spr_description',
                    },
                    {
                        data: 'spr_mode_of_payment',
                    },
                    {
                        data: 'spr_paid_date',
                    },
                    {
                        data: 'spr_amount',
                    },
                ],
                rowCallback: function(row, data) {
                    $(row).on('click', function() {
                        var recordUrl = "{{ route('record.show', ':recordId') }}".replace(
                            ':recordId', data.id)
                        $.ajax({
                            url: recordUrl,
                            success: function(result) {
                                $('#recordModal').modal("show");
                                $('#recordBody').html(result).show();
                            },
                            error: function(error) {
                                alert("Page " + recordUrl +
                                    " cannot open. Error: " + error)
                            },
                            timeout: 8000
                        })
                    })
                },
            })
        });
    </script>
@endsection
