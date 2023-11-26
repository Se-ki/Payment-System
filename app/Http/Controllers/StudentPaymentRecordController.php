<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentPaymentRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentPaymentRecordController extends Controller
{
    public function index()
    {
        return view('records.index', [
            'header' => "Student Records",
            "records" => StudentPaymentRecord::latest("spr_paid_date")->where('student_id', Auth::user()->student->id)->get()
        ]);
    }
    public function store(Request $request)
    {
        $record = new StudentPaymentRecord([
            'spr_receipt_number' => fake()->numberBetween(100000, 999999),
            'spr_reference_number' => $request->referenceno,
            'spr_description' => $request->description,
            'spr_mode_of_payment' => $request->paymentmethod,
            'spr_paid_date' => now(),
            'spr_amount' => $request->amount
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
