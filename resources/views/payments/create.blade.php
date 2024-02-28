@extends('layouts.main')
@section('title', 'Create Payments')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/payment/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    <div class="card card-outline rounded-0 card-navy">
        <span class="border-top border-black "></span>
        <div class="card-header">
            <div class="row">
                <div class="col" style="margin-left:50px">
                    <h1>Add Payments</h1>

                </div>
                <div class="col" style="margin-left:500px; font-style:oblique">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createPaymentModal">
                        Create Payment
                    </button>
                </div>
            </div>

        </div>
        <!-- Button trigger modal -->
        <main class="cd__main">
            <table id="payments-created" class="table table-hover table-striped table-bordered" style="width:100%">
                <colgroup>
                    <col width="15%">
                    <col width="25%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                </colgroup>
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
                    {{-- @foreach ($payments as $key => $payment)
                        <tr>
                            <td>{{ App\Helper\PS::addHyphenAfterFourNumbers($payment->student->school_id) }} </td>
                            <td>{{ $payment->student->lastname }}, {{ $payment->student->firstname }}
                                {{ $payment->student->middlename }}</td>
                            <td>{{ $payment->description->name }}</td>
                            <td>{{ number_format($payment->amount, 2) }}</td>
                            <td>{{ $payment->date_post }}</td>
                            <td>{{ $payment->deadline }}</td>
                            <td>{{ $payment->recordBy->lastname }}, {{ $payment->recordBy->firstname }}
                                {{ isset($payment->recordBy->middlename) ? substr($payment->recordBy->middlename, 0, 1) . '.' : null }}
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </main>

        <!-- Modal -->
        <div class="modal fade" id="createPaymentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Payment List</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="create-payment" method="POST">
                            @csrf
                            @foreach ($errors->all() as $message)
                                <li>
                                    {{ $message }}
                                </li>
                            @endforeach
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
                                <input type="date" name="deadline" class="form-control" id="floatingdeadline"
                                    placeholder="" required>
                                <label for="floatingDeadline">Deadline</label>
                            </div>
                            <div class="form-floating">
                                <select name="payment_semester" class="form-select" id="floatingSelect"
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
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var createPayment = $('#payments-created').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ajax-fetch-allPayments') }}",
                columns: [{
                        data: 'student_id',
                    },
                    {
                        data: 'student_name',
                    },
                    {
                        data: 'description',
                    },
                    {
                        data: 'amount',
                    },
                    {
                        data: 'date_post',
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
                    },
                ],

            })

            $("#create-payment").on('submit', function(event) {
                event.preventDefault()
                var form = new FormData(this)
                $.ajax({
                    url: "{{ route('payment.store') }}",
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: form,
                    success: function(response) {
                        createPayment.draw()
                        $('#createPaymentModal').modal('hide');
                        alert(response.message)
                    },
                    error: function(error) {
                        console.error(error)
                    }
                })
            })
        });

        function redirect(path) {
            return window.location.href = path;
        }

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
