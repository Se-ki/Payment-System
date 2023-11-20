<div class="row">
    <div class="col mb-3">
        <p class="small text-muted mb-1">Date Paid</p>
        <p>{{ Carbon\Carbon::parse($record->paid_date)->format('F j, Y') }}</p>
    </div>
    <div class="col mb-3">
        <p class="small text-muted mb-1">Reference No.<button type="button" id="reference-button"><i
                    class='bx bxs-copy'></i></button>
        </p>
        <p>
            <input type="hidden" id="myInput" value="12345678900">
            {{ $record->reference_number }}
        </p>
    </div>
</div>
<div class="mx-n5 px-5 py-4">
    <div class="row">
        <div class="col-md-8 col-lg-9">
            <p class="small text-muted mb-1">Description</p>
            <p>
                {{ $record->description }}
            </p>
        </div>
    </div>
</div>

<div class="row my-4">
    <div class="col-md-4 offset-md-8 col-lg-3 offset-lg-9">
        <p class="small text-muted mb-1">Paid</p>
        <p class="lead fw-bold mb-0" style="color: #f37a27;">
            ₱ {{ number_format($record->amount, 2) }}
        </p>
    </div>
</div>
