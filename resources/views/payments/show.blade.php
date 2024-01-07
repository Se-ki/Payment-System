<link rel="stylesheet" href="{{ asset('css/payment/style.css') }}">
<div class="card">
    <div class="card-body">
        <form action="{{ route('pay', $payment->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="spr_semester" value={{ $payment->p_semester }}>
            <input type="hidden" name="academic_year_id" value={{ $payment->academic_year_id }}>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="spr_mode_of_payment" value="GCASH"
                            checked>
                        <label class="form-check-label" for="gridRadios2">
                            <img src="{{ asset('img/gcash.png') }}" alt="gcash" width="95px" height="33px"
                                style="position:relative; bottom: 4px;">
                        </label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    @php
                        date_default_timezone_set('Asia/Manila');
                    @endphp
                    <p class="small text-muted mb-1">Date Paid</p>
                    {{ date('F d, Y ') }}
                    <input type="hidden" name="date_paid" value="{{ date('F d, Y h:i:s A') }}" class="form-control"
                        id="" readonly>
                </div>
                <div class="col">
                    <p class="small text-muted mb-1">Description</p>
                    <input type="text" name="spr_description" value="{{ $payment->description->name }}"
                        class="form-control" id="" readonly>
                </div>
                <div class="col">
                    <p class="small text-muted mb-1">Amount</p>
                    <input type="text" value="{{ Number::currency($payment->amount, in: 'PHP', locale: 'ph') }}"
                        class="form-control" id="" readonly>
                    <input type="hidden" name="spr_amount" value="{{ $payment->amount }}">
                </div>
            </div>
            <div class="row">
                <div class="col mt-3">
                    <p class="small mb-1" id="refLabel">Reference No.</p>
                    <input type="text" name="spr_reference_number" class="form-control" id="inputgcash"
                        maxlength="13" required>
                    {{-- #TODO REFACTOR ALL THE NAMING LIKE VARIABLES AND FUNCTION --}}
                    {{-- #TODO CHECK ALL  --}}
                </div>
                <div class="col mt-3">
                    <button id="yourBtn" type="button" class="form-control mt-4 btn btn-danger"><i
                            class="fa-regular fa-images px-2"></i>Proof of Payment</button>
                    <input style="height: 0px; width: 0px; overflow: hidden" id="upfile" type="file"
                        name="proof_of_payment_photo" accept="image/png, image/jpeg" required />
                </div>
            </div>
            <div class="">
                <button class="button" type="submit"
                    style="display: block; justify-content:center; margin: auto; margin-top:20px;" id="submit">
                    Pay Now
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    document.getElementById('yourBtn').addEventListener('click', () => {
        console.log('click')
        document.getElementById("upfile").click();
    })
</script>
