@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/balance/style.css') }}">
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
                <div class="form-floating ">
                    <input name="sbp_description" type="text" value="{{ $balance->sbp_description }}" class="form-control"
                        id="floatingInput" readonly />
                    <label for="floatingInput">Description</label>
                </div>

                <div class="form-floating">
                    <input value="{{ $balance->sbp_amount }}" name="sbp_amount" type="text" class="form-control"
                        id="amount" readonly />
                    <label for="floatingPassword">Amount</label>
                </div>
                <div class="form-floating">
                    <input value="{{ $balance->sbp_balance_amount }}" name="sbp_balance_amount" type="text"
                        value="" class="form-control" id="sbp_d" />
                    <label for="floatingPassword">Balance Amount</label>
                </div>
                <div class="form-floating">
                    <input value="{{ $balance->sbp_paid_amount }}" name="sbp_paid_amount" type="text"
                        class="form-control" id="amount" />
                    <label for="floatingPassword">Paid Amount</label>
                </div>
                <div class="form-floating">
                    <input value="{{ $balance->sbp_paid_change }}" name="sbp_paid_change" type="text"
                        class="form-control" id="amount" />
                    <label for="floatingPassword">Paid Change</label>
                </div>

                <div class="form-floating">
                    <select name="status" class="form-select" id="floatingSelect"
                        aria-label="Floating label select example">
                        <option value="Complete" {{ $balance->status === 'Complete' ? 'selected' : null }}>Complete
                        </option>
                        <option value="Pending" {{ $balance->status === 'Pending' ? 'selected' : null }}>Pending</option>
                    </select>
                    <label for="floatingSelect">Status</label>
                </div>

                <button type="submit" class="btn btn-outline-danger">Submit</button>

            </form>
        </div>
    </div>
@endsection
{{-- 
<script>
    constamountInput = document.getElementById('amount');
    let amountValue = '';

    amountInput.addEventListener('input', function(event) {
        amountValue = event.target.value;
    });

    amountInput.addEventListener('focus', function(event) {
        event.preventDefault();

        // Set the value to the peso sign ('₱') and append the stored amountValue
        amountInput.value = amountValue ? `₱${amountValue}` : '₱';

        // Set the maximum length of the input to 14 characters (including the peso sign)
        amountInput.maxLength = 14;
    });
</script> --}}
