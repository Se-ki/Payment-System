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
        return view('balance.index', ['balances' => StudentBalancePayment::latest()->where('user_login_id', Auth::user()->id)->get()]);
    }
    public function create()
    {
        //
    }
    public function store(StoreBalanceRequest $request)
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

    public function update(UpdateBalanceRequest $request, StudentBalancePayment $balance)
    {
        //
    }

    public function destroy(StudentBalancePayment $balance)
    {
        //
    }
}
