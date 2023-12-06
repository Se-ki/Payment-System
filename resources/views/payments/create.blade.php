@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/payment/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    <h1>Add Payments</h1>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Payment
    </button>
    <main class="cd__main">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Student ID Number</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Description</th>
                    <th scope="col" class="">Amount</th>
                    <th scope="col">Date Post</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Record By</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $key => $payment)
                    <tr>
                        <td>{{ $payment->student->school_id }}</td>
                        <td>{{ $payment->student->lastname }}, {{ $payment->student->firstname }}
                            {{ $payment->student->middlename }}</td>
                        <td>{{ $payment->description->name }}</td>
                        <td>{{ number_format($payment->amount, 2) }}</td>
                        <td>{{ $payment->date_post }}</td>
                        <td>{{ $payment->deadline }}</td>
                        <td>{{ $payment->record_by }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Payment List</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('payments-store') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <select name="description_id" class="form-select" id="floatingSelect"
                                aria-label="Floating label select example">
                                <option value="{{ $descriptions->first()->id }}" selected>
                                    {{ $descriptions->first()->name }}
                                </option>
                                @foreach ($descriptions->skip(1) as $description)
                                    <option value="{{ $description->id }}">{{ $description->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Description</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name=amount class="form-control" id="floatingAmount" placeholder=""
                                required>
                            <label for="floatingAmount">Amount</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" name="deadline" class="form-control" id="floatingdeadline" placeholder=""
                                required>
                            <label for="floatingDeadline">Deadline</label>
                        </div>
                        <div class="form-floating">
                            <select name="semester" class="form-select" id="floatingSelect"
                                aria-label="Floating label select example">
                                <option value="1" selected>
                                    1st Semester
                                </option>
                                <option value="2">
                                    2nd Semester
                                </option>
                            </select>
                            <label for="floatingSelect">Semester</label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" name="save" class="btn btn-primary" value="Save">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                //disable sorting on last column
                "columnDefs": [{
                    "orderable": false,
                    "targets": 6
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
