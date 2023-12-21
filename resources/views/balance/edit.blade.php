@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/balance/collector/create/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')

    <div class="card">
        {{-- for header only --}}
        <div class="card-header">
            <h1>{{ $student->firstname }} {{ $student->lastname }} Balance</h1>
        </div>

        {{-- for the body --}}
        <div class="card-body">
            <form action="{{ route('balance.update', $balance->id) }}" method="POST" class="row g-3 mt-2 ">
                @csrf
                @method('PATCH')
                <div class="form-floating">
                    <input name="sbp_description" type="text" value="{{ $balance->sbp_description }}" class="form-control"
                        id="floatingInput" readonly />
                    <label for="floatingInput">Description</label>
                </div>
                <div class="form-floating">
                    <input value="{{ $balance->sbp_amount }}" name="sbp_amount" type="text" class="form-control"
                        id="amount" readonly />
                    <label for="floatingInput">Amount</label>
                </div>
                <div class="form-floating">
                    <input value="{{ $balance->sbp_paid_amount }}" name="sbp_paid_amount" type="number"
                        class="form-control" id="paidAmount" />
                    <input type="hidden" value="{{ $balance->sbp_paid_amount }}" id="currentAmount" />
                    <label for="floatingInput">Paid Amount</label>
                </div>

                <div class="form-floating">
                    <input value="{{ $balance->sbp_balance_amount }}" name="sbp_balance_amount" type="text"
                        class="form-control" id="balanceAmount" readonly />
                    <label for="floatingInput">Balance Amount</label>
                </div>

                <div class="form-floating">
                    <input value="{{ $balance->sbp_paid_change }}" name="sbp_paid_change" type="text"
                        class="form-control" id="paidChange" readonly />
                    <label for="floatingInput">Paid Change</label>
                </div>
                <div class="form-floating">
                    {{-- <select name="status" class="form-select" id="floatingSelect"
                        aria-label="Floating label select example">
                        <option value="Complete" {{ $balance->status === 'Complete' ? 'selected' : null }}>Complete
                        </option>
                        <option value="Pending" {{ $balance->status === 'Pending' ? 'selected' : null }}>Pending</option>
                    </select>
                    <label for="floatingSelect">Status</label> --}}
                    <input name="status" type="text" placeholder="Status" value="{{ $balance->status }}"
                        class="form-control" id="status" readonly />
                    <label for="floatingInput">Status</label>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary m-2"
                        href="{{ route('balance.student.payment.index', App\Models\LoginUser::where('student_id', $balance->student_id)->first()->username) }}">Back</a>
                    <button type="submit" class="btn btn-outline-primary px-5">Pay</button>
                </div>
                {{-- <button type="submit" class="btn btn-outline-danger">Submit</button> --}}

            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#paidAmount').on('input', function() {
                var amount = parseFloat($('#amount').val()) || 0;
                var paidAmount = parseFloat($(this).val()) || 0;

                var balanceAmount = amount - paidAmount;
                if (paidAmount > amount) {
                    $('#balanceAmount').val(0);
                } else {
                    $('#balanceAmount').val(balanceAmount.toFixed(2));
                }

                var status = (balanceAmount <= 0) ? 'Complete' : 'Pending';
                $('#status').val(status);

                var paidChange = paidAmount - amount;
                if (paidAmount < amount) {
                    $('#paidChange').val(0);
                } else {
                    $('#paidChange').val(paidChange.toFixed(2));
                }
            });
        });
    </script>
@endsection
