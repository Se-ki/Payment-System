<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Student;
use App\Models\StudentPaymentRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentPaymentRecordController extends Controller {
    public function index(int $semesterId = null, AcademicYear $year = null) {
        if(isset($year->id) && $semesterId) {
            $records = StudentPaymentRecord::latest()
                ->where('student_id', Auth::user()->student->id)
                ->where('spr_semester', $semesterId)
                ->where('academic_year_id', $year->id)
                ->get();
        } else if($semesterId && !isset($year->id)) {
            $records = StudentPaymentRecord::latest()
                ->where('student_id', Auth::user()->student->id)
                ->where('spr_semester', $semesterId)
                ->where('academic_year_id', AcademicYear::orderBy('id', 'DESC')->get()[0]->id)
                ->get();
        } else {
            $records = StudentPaymentRecord::latest()
                ->where('student_id', Auth::user()->student->id)
                ->get();
        }
        return view('records.index', [
            'header' => "Student Payment Records",
            "records" => $records,
            "academics" => AcademicYear::orderBy('id', 'DESC')->get(),
            'currentYear' => $year,
        ]);
    }
    public function store($id, Request $request) {
        $name = $request->file('proof_of_payment_photo')->getClientOriginalName();
        $extension = $request->file('proof_of_payment_photo')->getClientOriginalExtension();
        if($extension !== 'jpg' && $extension !== 'png') {
            return redirect()->back()->with('error', true);
        }
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

        PaymentController::destroy($id);

        return redirect()->back();
    }
    public function show($id) {
        return view('records.show', ["record" => StudentPaymentRecord::findOrFail($id)]);
    }
}
