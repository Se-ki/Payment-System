<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentPaymentRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentPaymentRecordController extends Controller {
    public function index() {
        return view('records.index', [
            'header' => "Student Records",
            "records" => StudentPaymentRecord::latest("spr_paid_date")->where('student_id', Auth::user()->student->id)->get()
        ]);
    }
    public function store(Request $request) {
        $name = $request->file('proof_of_payment_photo')->getClientOriginalName();
        $request->file('proof_of_payment_photo')->storeAs('public/proof_of_payment_photo/', $name);
        $uniqueIdentifier = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $currentDate = now()->format('Ymd');
        $generatedCode = $currentDate.$uniqueIdentifier;
        $record = new StudentPaymentRecord([
            'academic_year_id' => $request->year_id,
            'spr_receipt_number' => $generatedCode,
            'spr_reference_number' => $request->referenceno,
            'spr_description' => $request->description,
            'spr_mode_of_payment' => $request->paymentmethod,
            'spr_proof_of_payment_photo' => $name,
            'spr_paid_date' => now(),
            'spr_amount' => $request->amount,
            'spr_semester' => $request->spr_semester,
        ]);

        $user = Student::find(Auth::user()->id);

        $user->record()->save($record);

        PaymentController::destroy($request->paymentid);

        return redirect()->back();
    }
    public function show($id) {
        return view('records.show', ["record" => StudentPaymentRecord::findOrFail($id)]);
    }
}
