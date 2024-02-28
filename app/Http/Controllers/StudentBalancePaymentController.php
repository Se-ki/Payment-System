<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentBalancePaymentRequest;
use App\Models\StudentBalancePayment;
use App\Models\LoginUser;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class StudentBalancePaymentController extends Controller
{
    public function index(StudentBalancePayment $sbp): View
    {
        $balances = $sbp->studentBalance();
        return view('balance.index', compact('balances'));
    }
    public function create(Payment $payment): RedirectResponse|View
    {
        return view('balance.create', compact('payment'));
    }

    public function show(LoginUser $student, StudentBalancePayment $sbp): RedirectResponse|View
    {
        $user = $student;
        $balances = $sbp->showStudentBalance($student->student_id);
        return view('balance.show', compact('user', 'balances'));
    }

    public function store(Payment $payment, LoginUser $loginUser, StudentBalancePayment $sbp, StudentBalancePaymentRequest $request): RedirectResponse
    {
        $sbp->walkInPaid($payment, $request);
        $payment->destroy($payment->id);
        $username = $loginUser->findStudent($payment->student_id)->username;
        return redirect(route('balance.show', $username))->with('success', 'Paid of amount ' . $request->sbp_amount . ' pesos');
    }

    public function edit(StudentBalancePayment $balance): View
    {
        $student = $balance->student;
        return view('balance.edit', compact('balance', 'student'));
    }

    public function update(StudentBalancePayment $balance, LoginUser $loginUser, StudentBalancePaymentRequest $request): RedirectResponse
    {
        $student = $loginUser->findStudent($balance->student_id);
        $balance->updateBalance($balance->id, $request);
        return redirect(route('balance.show', $student->username));
    }

    public function listOfStudent()
    {
        
        return view('balance.student.index');
    }
    public function listOfPayments(LoginUser $student, Payment $payment): View|RedirectResponse
    {
        $student = $student->student;
        $payments = $payment->showStudentPayments($student);
        return view('balance.student.payment.index', compact('student', 'payments'));
    }
}
