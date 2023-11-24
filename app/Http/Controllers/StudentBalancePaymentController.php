<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBalanceRequest;
use App\Http\Requests\UpdateBalanceRequest;
use App\Models\StudentBalancePayment;
use Illuminate\Support\Facades\Auth;

class StudentBalancePaymentController extends Controller
{
    public function index()
    {
        return view('balance.index', ['balances' => StudentBalancePayment::latest("sbp_paid_date")->where('student_id', Auth::user()->student->id)->get()]);
    }
    public function create()
    {
        //
    }
    public function store()
    {
        //
    }
    public function show(StudentBalancePayment $balance)
    {
        //
    }

    public function edit(StudentBalancePayment $balance)
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy(StudentBalancePayment $balance)
    {
        //
    }
}
