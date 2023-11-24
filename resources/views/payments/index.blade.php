@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/payment/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')

    <!--Container Main start-->
    <div class="height-100 bg-light">
        <h4>Payments</h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Description</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date Posted</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                @foreach ($payments as $key => $payment)
                    <tbody>
                        <tr>
                            <td>
                                {{ ++$key }}
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
                            <td style="color: {{ strtotime(NOW()) >= strtotime($payment->deadline) ? 'red' : 'black' }} ">
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
                                    data-target="#paymentModal" data-attr="{{ route('payments.show', $payment->id) }}"
                                    title="Pay">
                                    Pay
                                </a>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
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
