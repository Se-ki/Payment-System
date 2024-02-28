<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\AcademicYear;
use App\Models\Description;
use App\Models\LoginUser;
use App\Models\Payment;
use Illuminate\View\View;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{
    public function index(Payment $payment, AcademicYear $academicYear)
    {
        $payments = $payment->paymentFilter()->get();
        $academics = $academicYear->getYear()->get();
        $currentYear = request('year') ? $academicYear->currentYear() : null;
        return view('payments.index', compact('payments', 'academics', 'currentYear'));
    }
    public function create(Description $description): View
    {
        $descriptions = $description->getDescriptions();
        return view('payments.create', compact('descriptions'));
    }
    public function store(PaymentRequest $request, Payment $payment, LoginUser $loginUser) //: RedirectResponse
    {
        $payment->createPayments($request, $loginUser);
        return Response::json(['message' => 'Payments created for all student.']);
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
