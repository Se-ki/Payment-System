<div>
    <div class="row" style="margin-left: 50px">
        <div class="col-md-6 ">
            <p class="small text-muted mb-1 fw-bold">Date Paid</p>
            <p>{{ Carbon\Carbon::parse($record->spr_paid_date)->format('F j, Y') }}</p>
        </div>

        <div class="col-md-6 mb-5 ">
            <p class="small text-muted mb-1 fw-bold">Reference No.<a href="#" class="pe-auto ms-2" id="copy-button"><i
                        class="pe-auto fa-solid fa-copy"></i></a>
            </p>
            <p>
                <input type="hidden" id="copy-number" value="{{ $record->spr_reference_number }}">
                {{ $record->spr_reference_number }}
            </p>
        </div>
    </div>


    <div class="row g-3" style="margin-left: 50px">
        <div class="col-md-6 mb-3  ">
            <p class="small text-muted mb-1 fw-bold">Proof of Payment</p>
            <a href="{{ asset('storage/proof_of_payment_photo/' . $record->spr_proof_of_payment_photo) }}"
                target="_blank">
                <img src="{{ asset('storage/proof_of_payment_photo/' . $record->spr_proof_of_payment_photo) }}"
                    alt="" height="300" width="150">
            </a>
        </div>
        <div class="col-md-5 ">
            <p class="small text-muted mb-1 fw-bold">Description</p>
            <p>
                {{ $record->spr_description }}
            </p>
            <br>
            <br>
            {{-- Amount --}}
            <div class="mt-5 ">
                <p class="small text-muted mb-1 fw-bold ">Paid</p>
                <p class="lead fw-bold mb-0" style="color: #f37a27;">
                    {{ Number::currency($record->spr_amount, in: 'PHP', locale: 'ph') }}
                </p>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '#copy-button', function() {
        var copyText = $('#copy-number');
        copyText.select();
        navigator.clipboard.writeText(copyText.val());
        alert("Copied the text: " + copyText.val());
    });
</script>
