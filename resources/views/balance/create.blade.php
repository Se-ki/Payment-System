@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/balance/collector/create/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    <div class="card">
        <div class="card-header">
            <h1>WALK IN</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('balance.store', $payment->id) }}" method="POST" class="row g-3 mt-2 ">
                @csrf
                <div class="form-floating ">
                    <input name="sbp_description" type="text" value="{{ $payment->description->name }}"
                        class="form-control" id="floatingInput" placeholder="Description" readonly />
                    <label for="floatingInput">Description</label>
                </div>

                <div class="form-floating">
                    <input name="sbp_amount" type="text" value="{{ $payment->amount }}" class="form-control"
                        id="amount" placeholder="Amount" readonly />
                    <label for="floatingInput">Amount</label>
                </div>
                <div class="form-floating">
                    <input name="sbp_paid_amount" type="number" class="form-control" id="paidAmount"
                        placeholder="Paid Amount">
                    <label for="floatingInput">Paid Amount</label>
                </div>
                <div class="form-floating">
                    <input name="sbp_balance_amount" type="text" value="" class="form-control" id="balanceAmount"
                        placeholder="Balance Amount" readonly />
                    <label for="floatingInput">Balance Amount</label>
                </div>
                <div class="form-floating">
                    <input name="sbp_paid_change" type="text" class="form-control" id="paidChange"
                        placeholder="Paid Change" readonly />
                    <label for="floatingInput">Paid Change</label>
                </div>

                <div class="form-floating">
                    <input name="status" type="text" placeholder="Amount" class="form-control" id="status"
                        readonly />
                    <label for="floatingPassword">Status</label>
                </div>

                <div class="modal-footer">
                    <a class="btn btn-secondary m-2"
                        href="{{ route('balance.student.payment.index', App\Models\LoginUser::where('student_id', $payment->student_id)->first()->username) }}">Back</a>
                    <button type="submit" class="btn btn-outline-primary px-5">Pay</button>
                </div>
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
