@extends('layouts.main')
@section('title', 'Student Payment Records')
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
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                    value="option1" {{ request('semester') == 1 ? 'checked' : '' }}>
                                <label class="form-check-label">1 Semester</label>
                            </a>
                        </div>
                        <div class="form-check form-check-inline">
                            <a
                                href="{{ route('record.index') }}?semester=2{{ request('year') ? '&' : '' }}{{ http_build_query(request()->except('semester')) }}">
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
        </p>

        @if (Auth::user()->role_type_id == 1)
            <main class="cd__main">
                <table id="example" class="table table-hover table-striped table-bordered " style="width:900px">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
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
                                data-target="#recordModal" data-attr="{{ route('record.show', $record->id) }}"
                                title="show">
                                <td>{{ ++$key }}</td>
                                <td> {{ $record->spr_receipt_number }} </td>
                                <td> {{ $record->spr_description }} </td>
                                <td> {{ $record->spr_mode_of_payment }} </td>
                                <td> {{ $record->spr_paid_date }} </td>
                                <td> {{ Number::currency($record->spr_amount, in: 'PHP', locale: 'ph') }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </main>
        @else
            <main class="cd__main">
                <table id="example" class="table table-hover table-striped table-bordered " style="width:900px">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Studen ID</th>
                            <th scope="col">Student Name</th>
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
                                data-target="#recordModal" data-attr="{{ route('records.show', $record->id) }}"
                                title="show">
                                <td> {{ ++$key }} </td>
                                <td> {{ App\Helper\PS::addHyphenAfterFourNumbers($record->student->school_id) }} </td>
                                <td> {{ $record->student->lastname }}, {{ $record->student->firstname }}
                                    {{ isset($record->student->middlename) ? substr($record->student->middlename, 0, 1) . '.' : null }}
                                </td>
                                <td> {{ $record->spr_receipt_number }} </td>
                                <td> {{ $record->spr_description }} </td>
                                <td> {{ $record->spr_mode_of_payment }} </td>
                                <td> {{ $record->spr_paid_date }} </td>
                                <td> {{ Number::currency($record->spr_amount, in: 'PHP', locale: 'ph') }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </main>
        @endif
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
                    "targets": {{ Auth::user()->role_type_id == 1 ? 5 : 7 }}
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
