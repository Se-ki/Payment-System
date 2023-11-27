<?php

namespace App\Http\Controllers;

use App\Models\StudentBalancePayment;
use Illuminate\Support\Facades\Auth;

class StudentBalancePaymentController extends Controller {
    public function index() {
        return view('balance.index', ['balances' => StudentBalancePayment::latest("sbp_date_paid")->where('student_id', Auth::user()->student->id)->get()]);
    }
    public function create() {
        if(Auth::user()->role_type_id !== 2 && Auth::user()->role_type_id !== 3) {
            return redirect('/');
        }
        return view('balance.create');
    }
    public function store() {
        //
    }
    public function show(StudentBalancePayment $balance) {
        //
    }

    public function edit(StudentBalancePayment $balance) {
        //
    }

    public function update() {
        //
    }
    public function destroy(StudentBalancePayment $balance) {
        //
    }
    public function listOfStudent() {
        if(Auth::user()->role_type_id !== 2 && Auth::user()->role_type_id !== 3) {
            return redirect('/');
        }
        return view('balance.student.index');
    }
    public function listOfPayments() {
        if(Auth::user()->role_type_id !== 2 && Auth::user()->role_type_id !== 3) {
            return redirect('/');
        }
        return view('balance.student.payment.index');
    }
}
