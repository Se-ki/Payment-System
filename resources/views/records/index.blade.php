@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/records/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    <!--Container Main start-->
    <div class="card card-outline rounded-0 card-navy   ">
        <span class="border-top border-black "></span>
        <div class="card-header ">

            <p>
            <div class="form">
                <form class="row g-3">
                    <div class="col-auto mt-3 ">
                        <h2 class="fw-bold">Student Payment Records</h2>
                    </div>

                    <div class="col-auto mt-4" style="margin-left: 100px">
                        <div class="form-check form-check-inline">
                            <a
                                href="{{ route('records.index', ['semester' => 1, 'year' => request()->route('year')->id ?? isset(request()->route('year')->id)]) }}">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                    value="option1" {{ request()->route('semester') == 1 ? 'checked' : '' }}>
                            </a>
                            <label class="form-check-label" for="inlineRadio1">1 Semester</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <a
                                href="{{ route('records.index', ['semester' => 2, 'year' => request()->route('year')->id ?? isset(request()->route('year')->id)]) }}">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                    value="option2" {{ request()->route('semester') == 2 ? 'checked' : '' }}>
                            </a>
                            <label class="form-check-label" for="inlineRadio2">2 Semester</label>
                        </div>
                    </div>
                    <div class="col-auto drpdwn">
                        <div class="dropdown">
                            <button
                                style="background-color:rgb(243, 242, 242); color:black; height:2rem; border-color:rgb(255, 255, 255)"
                                class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ isset($currentYear) && $currentYear != '[]' ? $currentYear->year : $academics[0]->year }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item {{ request()->path() === 'records' ? 'active' : (request()->path() === 'records/' . request()->route('semester') ? 'active' : null) }}"
                                        href="{{ route('records.index', ['semester' => request()->route('year') ? request()->route('semester') : 1]) }}">{{ $academics[0]->year }}</a>
                                </li>
                                @foreach ($academics->skip(1) as $academic)
                                    <li><a class="dropdown-item {{ isset($currentYear) && $currentYear->is($academic) ? 'active' : null }}"
                                            href="{{ route('records.index', ['semester' => request()->route('semester'), 'year' => $academic->id]) }}">{{ $academic->year }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
            </div>
        </div>
        </form>
        </p>

        <main class="cd__main">
            <table id="example" class="table table-hover table-striped table-bordered " style="width:900px">
                <thead>
                    <tr>
                        <th scope="col">Receipt Number</th>
                        <th scope="col">Description</th>
                        <th scope="col">Mode</th>
                        <th scope="col">Date Paid</th>
                        <th scope="col" class="">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $key => $record)
                        <tr style="color: blue; cursor:pointer" data-toggle="modal" id="recordButton"
                            data-target="#recordModal" data-attr="{{ route('record.show', $record->id) }}" title="show">
                            <td> {{ $record->spr_receipt_number }} </td>
                            <td> {{ $record->spr_description }} </td>
                            <td> {{ $record->spr_mode_of_payment }} </td>
                            <td> {{ $record->spr_paid_date }} </td>
                            <td> {{ number_format($record->spr_amount, 2) }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
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
    </div>

    <!--Container Main end-->
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                //disable sorting on last column
                "columnDefs": [{
                    "orderable": false,
                    "targets": 4
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
