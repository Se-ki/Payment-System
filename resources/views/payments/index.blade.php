@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/payment/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')

    <!--Container Main start-->
    <div class="height-100 bg-light">

        <p>
        <div class="form">
            <form class="row g-3">
                <div class="col-auto mt-3 ">
                    <h2 class="fw-bold">Payments</h2>
                </div>
                <div class="col-auto mt-4" style="margin-left: 578px">
                    <div class="form-check form-check-inline">
                        <a
                            href="{{ route('payments.index', ['semester' => 1, 'year' => request()->route('year')->id ?? isset(request()->route('year')->id)]) }}">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                value="option1" {{ request()->route('semester') == 1 ? 'checked' : '' }}>
                        </a>
                        <label class="form-check-label" for="inlineRadio1">1 Semester</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <a
                            href="{{ route('payments.index', ['semester' => 2, 'year' => request()->route('year')->id ?? isset(request()->route('year')->id)]) }}">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                value="option2" {{ request()->route('semester') == 2 ? 'checked' : '' }}>
                        </a>
                        <label class="form-check-label" for="inlineRadio2">2 Semester</label>
                    </div>

                </div>
                <div class="col-auto drpdwn">
                    <div class="dropdown">
                        <button
                            style="background-color:rgb(243, 242, 242); color:black; height:2rem; border-color:rgb(255, 255, 255)"
                            class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ isset($currentYear) && $currentYear != '[]' ? $currentYear->year : $academics[0]->year }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ request()->path() === 'payments' ? 'active' : (request()->path() === 'payments/' . request()->route('semester') ? 'active' : null) }}"
                                    href="{{ route('payments.index', ['semester' => request()->route('year') ? request()->route('semester') : 1]) }}">{{ $academics[0]->year }}</a>
                            </li>
                            @foreach ($academics->skip(1) as $academic)
                                <li><a class="dropdown-item {{ isset($currentYear) && $currentYear->is($academic) ? 'active' : null }}"
                                        href="{{ route('payments.index', ['semester' => request()->route('semester'), 'year' => $academic->id]) }}">{{ $academic->year }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
        </div>
        </form>
        </p>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Year</th>
                        <th scope="col">Description</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date Posted</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Record By</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                @if (count($payments) > 0)
                    @foreach ($payments as $key => $payment)
                        <tbody>
                            <tr>
                                <td>
                                    {{ ++$key }}
                                </td>
                                <td>
                                    {{ $payment->p_semester }}
                                </td>
                                <td>
                                    {{ $payment->academic->year }}
                                </td>
                                <td class="description-capitalization">
                                    {{ $payment->description }}
                                </td>
                                <td>
                                    ₱ {{ number_format($payment->amount, 2) }}
                                </td>
                                <td>
                                    {{ $payment->created_at->format('F d, Y') }}
                                </td>
                                <td
                                    style="color: {{ strtotime(NOW()) >= strtotime($payment->deadline) ? 'red' : 'black' }} ">
                                    {{ Carbon\Carbon::parse($payment->deadline)->format('F d, Y') }}
                                    @if (strtotime(NOW()) >= strtotime($payment->deadline))
                                        <br>
                                        <small>
                                            {{ __('Deadline') }}
                                        </small>
                                    @endif
                                </td>

                                <td class="">
                                    {{ $payment->record_by }}
                                </td>
                                <td>
                                    <a class="btn btn-primary" data-toggle="modal" id="paymentButton"
                                        data-target="#paymentModal" data-attr="{{ route('payment.show', $payment->id) }}"
                                        title="Pay">
                                        Pay
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>
        </div>
        @if (count($payments) == 0)
            <center>
                <span style="font-family: 'Dancing Script', cursive;">I think you paid all of your payment. Hooray!</span>
            </center>
        @endif
    </div>

    {{-- modal payment --}}
    <div class="modal fade" id="paymentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="paymentLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title" id="staticBackdropLabel"></span>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body" id="paymentBody">
                    <!-- //Here Will show the Data -->
                </div>
            </div>
        </div>
    </div>
    {{-- Container Main end --}}
@endsection
