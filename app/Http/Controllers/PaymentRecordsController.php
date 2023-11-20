<?php

namespace App\Http\Controllers;

use App\Models\PaymentRecords;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentRecordsController extends Controller
{
    public function index()
    {
        return view('records.index', [
            'header' => "Student Records",
            "records" => PaymentRecords::latest("paid_date")->where('user_id', Auth::user()->id)->get()
        ]);
    }
    public function store(Request $request)
    {
        $record = new PaymentRecords([
            'receipt_number' => fake()->numberBetween(100000, 999999),
            'reference_number' => $request->referenceno,
            'description' => $request->description,
            'mode' => $request->paymentmethod,
            'paid_date' => now(),
            'amount' => $request->amount
        ]);

        $user = User::find(Auth::user()->id);

        $user->records()->save($record);

        // PaymentsController::destroy();

        return redirect('/payments');
    }
    public function show($id)
    {
        return view('records.show', ["record" => PaymentRecords::findOrFail($id)]);
    }
}
