<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\AcademicYear;
use App\Models\Description;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Student;

class PaymentController extends Controller
{
    public function index(Payment $payment, AcademicYear $academicYear)
    {
        $payments = $payment->paymentFilter()->get();
        $academics = $academicYear->getYear()->get();
        $currentYear = request('year') ? $academicYear->currentYear() : null;
        return view('payments.index', compact('payments', 'academics', 'currentYear'));
    }
    public function create(Description $description, Payment $payment): View
    {
        $descriptions = $description->getDescriptions();
        $payments = $payment->getAllPayments();
        return view('payments.create', compact('descriptions', 'payments'));
    }
    public function store(PaymentRequest $request, Payment $payment): RedirectResponse
    {
        $payment->createPayments($request);
        return back();
    }
    public function show(string $id): View
    {
        return view('payments.show', ['payment' => Payment::findOrFail($id)]);
    }
    public static function destroy(string $id): void
    {
        Payment::findOrFail($id)->delete();
    }
}
