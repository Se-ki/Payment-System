<div>
    <div class="row" style="margin-left: 50px">
        <div class="col-md-6 ">
            <p class="small text-muted mb-1 fw-bold">Date Paid</p>
            <p>{{ Carbon\Carbon::parse($record->spr_paid_date)->format('F j, Y') }}</p>
        </div>

        <div class="col-md-6 mb-5 ">
            <p class="small text-muted mb-1 fw-bold">Reference No.<button type="button" id="reference-button"><i
                        class='bx bxs-copy'></i></button>
            </p>
            <p>
                <input type="hidden" id="myInput" value="12345678900">
                {{ $record->spr_reference_number }}
            </p>
        </div>
    </div>


    <div class="row g-3" style="margin-left: 50px">

        <div class="col-md-6 mb-3  ">
            <p class="small text-muted mb-1 fw-bold">Proof of Payment</p>
            {{-- <img src="{{ asset('storage/images/' . $record->spr_proof_of_payment_photo) }}" height="300"
                        width=""> --}}
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
                    ₱ {{ number_format($record->spr_amount, 2) }}
                </p>
            </div>

        </div>
    </div>
</div>
