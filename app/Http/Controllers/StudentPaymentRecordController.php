<?php

namespace App\Http\Controllers;

use App\Models\PaymentRecords;
use App\Models\Student;
use App\Models\StudentPaymentRecord;
use App\Models\UserLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentPaymentRecordController extends Controller
{
    public function index()
    {
        // $records = StudentPaymentRecord::latest()->where('student_id', Auth::user()->student->id)->get();
        // dd($records);
        return view('records.index', [
            'header' => "Student Records",
            "records" => StudentPaymentRecord::latest("spr_paid_date")->where('student_id', Auth::user()->student->id)->get()
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

        $user = Student::find(Auth::user()->id);

        $user->records()->save($record);

        // PaymentsController::destroy();

        return redirect('/payments');
    }
    public function show($id)
    {
        return view('records.show', ["record" => StudentPaymentRecord::findOrFail($id)]);
    }
}
