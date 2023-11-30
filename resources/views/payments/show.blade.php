<div class="card">
    <div class="card-body">
        <h4 style="margin-bottom: 2rem">Payment Method</h4>
        <form action="{{ route('payment.pay') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="paymentid" value={{ $payment->id }}>
            <input type="hidden" name="spr_semester" value={{ $payment->p_semester }}>
            <input type="hidden" name="year_id" value={{ $payment->academic_year_id }}>
            <div class="col-sm-20">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentmethod" value="GCASH" checked>
                    <label class="form-check-label" for="gridRadios2">
                        <img src="{{ asset('img/gcash.png') }}" alt="gcash" width="95px" height="33px"
                            style="position:relative; bottom: 4px;">
                    </label>
                </div>
                <div class="col mb-3">
                    @php
                        date_default_timezone_set('Asia/Manila');
                    @endphp
                    <p class="small text-muted mb-1">Date Paid</p>
                    {{ date('F d, Y ') }}
                    <input type="hidden" name="datepaid" value="{{ date('F d, Y h:i:s A') }}" class="form-control"
                        id="" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="small text-muted mb-1">Description</p>
                    <input type="text" name="description" value="{{ $payment->description }}" class="form-control"
                        id="" readonly>
                </div>
                <div class="col">
                    <p class="small text-muted mb-1">Amount</p>
                    <input type="text" value="{{ number_format($payment->amount, 2) }}" class="form-control"
                        id="" readonly>
                    <input type="hidden" name="amount" value="{{ $payment->amount }}">
                </div>
            </div>
            <div class="row">
                <div class="col mt-3">
                    <p class="small mb-1" id="refLabel">Reference No.</p>
                    <input type="text" name="referenceno" class="form-control" id="inputgcash" maxlength="13"
                        required>
                </div>
                <div class="col mt-3">
                    <p class="small mb-1" id="refLabel">Proof of Payment</p>
                    <input type="file" name="proof_of_payment_photo" class="form-control"
                        accept="image/png, image/jpeg" required>
                </div>
            </div>
            <div class="">
                <button class="btn btn-primary" type="submit"
                    style="display: block; justify-content:center; margin: auto; margin-top:20px;" id="submit">
                    Pay Now
                </button>
            </div>
        </form>
    </div>
</div>
