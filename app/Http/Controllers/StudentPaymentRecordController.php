<?php

namespace App\Http\Controllers;

use App\Models\PaymentRecords;
use App\Models\StudentPaymentRecord;
use App\Models\UserLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentPaymentRecordController extends Controller
{
    public function index()
    {
        return view('records.index', [
            'header' => "Student Records",
            "records" => StudentPaymentRecord::latest("paid_date")->where('user_login_id', Auth::user()->id)->get()
        ]);
    }
    public function store(Request $request)
    {
        $record = new StudentPaymentRecord([
            'receipt_number' => fake()->numberBetween(100000, 999999),
            'reference_number' => $request->referenceno,
            'description' => $request->description,
            'mode' => $request->paymentmethod,
            'paid_date' => now(),
            'amount' => $request->amount
        ]);

        $user = UserLogin::find(Auth::user()->id);

        $user->records()->save($record);

        // PaymentsController::destroy();

        return redirect('/payments');
    }
    public function show($id)
    {
        return view('records.show', ["record" => StudentPaymentRecord::findOrFail($id)]);
    }
}
