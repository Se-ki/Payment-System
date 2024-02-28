@extends('layouts.main')
@section('title', 'Payments')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/payment/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')

    <!--Container Main start-->
    <div class="card card-outline rounded-0 card-navy   ">
        <span class="border-top border-black "></span>
        <div class="card-header">
            <p>
            <div class="form">
                <form class="row g-3">
                    <div class="col-auto mt-3 ">
                        <h2 class="fw-bold">Payments</h2>
                    </div>
                    <div class="col-auto mt-4" style="margin-left: 575px">
                        <div class="form-check form-check-inline">
                            <a
                                href="{{ route('payment.index') }}?semester=1{{ request('year') ? '&' : '' }}{{ http_build_query(request()->except('semester')) }}">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                    value="option1" {{ request('semester') == 1 ? 'checked' : '' }}>
                                <label class="form-check-label">1 Semester</label>
                            </a>
                        </div>
                        <div class="form-check form-check-inline">
                            <a
                                href="{{ route('payment.index') }}?semester=2{{ request('year') ? '&' : '' }}{{ http_build_query(request()->except('semester')) }}">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                    value="option2" {{ request('semester') == 2 ? 'checked' : '' }}>
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
                                        href="{{ route('payment.index') }}?{{ request('semester') ? 'semester=' . request('semester') . '&' : null }}year={{ $academics->first()->year }}">{{ $academics->first()->year }}</a>
                                </li>
                                @if (count($academics) > 1)
                                    @foreach ($academics->skip(1) as $academic)
                                        <li><a class="dropdown-item {{ isset($currentYear) && $currentYear->first()->is($academic) ? 'active' : null }}"
                                                href="{{ route('payment.index') }}?{{ request('semester') ? 'semester=' . request('semester') . '&' : null }}year={{ $academic->year }}">{{ $academic->year }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
            </div>
        </div>
        </form>
        </p>

        <div class="card-body">
            <div class="container-fluid">
                <main class="cd__main">
                    <table id="payments-table" class="table table-hover table-striped table-bordered">
                        <colgroup>
                            <col width="5%">
                            <col width="5%">
                            <col width="10%">
                            <col width="15%">
                            <col width="15%">
                            <col width="15%">
                            <col width="15%">
                            <col width="15%">
                            <col width="5%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Year</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date Posted</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Record By</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </main>
            </div>
        </div>
        {{-- modal payment --}}
        <div class="modal fade" id="paymentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="paymentLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title" id="staticBackdropLabel"></span>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body" id="paymentBody">
                        <!-- //Here Will show the Data -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- Container Main end --}}
    <script>
        $(document).ready(function() {
            /*
                I use $.fn. so that i can use this
                paymentsTable in the other file
            */
            $.fn.paymentsTable = $('#payments-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ajax-fetch-payments') }}",
                columns: [{
                        data: null,
                        render: function(data, type, full, meta) {
                            // Use meta.row to get the row index, and add 1 to start from 1
                            return meta.row + 1;
                        },
                        name: 'id',
                    },
                    {
                        data: 'payment_semester',
                    },
                    {
                        data: 'academic_year',
                    },
                    {
                        data: 'description',
                    },
                    {
                        data: 'amount',
                    },
                    {
                        data: 'date_posted',
                    },
                    {
                        data: 'deadline',
                        render: function(data, type, meta, full) {
                            return `<td>
                                        <span style="color:${isDeadline(data)}">${formattedDate(data)}</span>
                                        ${displayDeadline(data)}
                                    </td>`
                        },
                    },
                    {
                        data: 'record_by',
                        name: 'record_by',
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ],
                rowCallback: function(row, data) {
                    $(row).on('click', function() {
                        var paymentUrl = "{{ route('payment.show', ':paymentId') }}"
                            .replace(
                                ':paymentId', data.id)
                        $.ajax({
                            url: paymentUrl,
                            success: function(result) {
                                $('#paymentModal').modal("show");
                                $('#paymentBody').html(result).show();
                            },
                            error: function(error) {
                                console.log(error);
                                alert("Page " + paymentUrl +
                                    " cannot open. Error:" +
                                    error);
                            },
                            timeout: 8000
                        })
                    })
                }
            })
        });

        function formattedDate(date) {
            var today = new Date(date);
            return today.toLocaleDateString("en-US", {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            })
        }

        function parseDate(date) {
            return Date.parse(date);
        }

        function isDeadline(deadlineDate) {
            return parseDate(new Date()) >= parseDate(deadlineDate) ? 'red' : 'black'
        }

        function displayDeadline(date) {
            return parseDate(new Date()) >= parseDate(date) ?
                `<br><small><span style="color:${isDeadline(date)}">Deadline</span></small>` :
                ''
        }
    </script>
@endsection
