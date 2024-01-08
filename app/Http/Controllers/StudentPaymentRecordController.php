<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Student;
use App\Models\StudentPaymentRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;
use Illuminate\View\View;

class StudentPaymentRecordController extends Controller
{
    public function index(): RedirectResponse|View
    {
        if (Auth::user()->role_id === 2) {
            return redirect('/');
        }

        $filters = request(['semester', 'year']);
        $year = AcademicYear::firstWhere('year', $filters['year'] ?? null);
        $query = StudentPaymentRecord::latest();
        if (Auth::user()->role_id === 1) {
            $query->where('student_id', Auth::user()->student->id);
        }
        if (isset($filters['semester']) && $filters['semester'] >= 3 || isset($filters['semester']) && $filters['semester'] <= 0 || isset($filters['year']) && !isset($year)) {
            abort(404);
        }
        if (isset($filters['year']) && isset($filters['semester'])) {
            $query
                ->where('spr_semester', $filters['semester'])
                ->where('academic_year_id', $year->id);
        } else if (!isset($filters['year']) && isset($filters['semester'])) {
            $query
                ->where('student_id', Auth::user()->student->id)
                ->where('spr_semester', $filters['semester'])
                ->where('academic_year_id', AcademicYear::orderBy('id', 'DESC')->first()->id);
        } else if (isset($filters['year']) && !isset($filters['semester'])) {
            $query->where('academic_year_id', $year->id);
        }
        return view('records.index', [
            'header' => "Student Payment Records",
            "records" => $query->get(),
            "academics" => AcademicYear::orderBy('id', 'DESC')->get(),
            'currentYear' => $year,
        ]);
    }
    public function store(string $id, Request $request): RedirectResponse
    {
        $sprProofOfPaymentPhotoName = $request->file('proof_of_payment_photo')->getClientOriginalName();
        $extension = $request->file('proof_of_payment_photo')->getClientOriginalExtension();
        if ($extension !== 'jpg' && $extension !== 'png') {
            return redirect()->back()->with('error', true);
        }
        $request->file('proof_of_payment_photo')->storeAs('public/proof_of_payment_photo/', $sprProofOfPaymentPhotoName);
        $uniqueIdentifier = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $currentDate = now()->format('Ymd');
        $generatedCode = $currentDate . $uniqueIdentifier;
        //put a validation
        $record = new StudentPaymentRecord([
            'academic_year_id' => $request->academic_year_id,
            'spr_receipt_number' => $generatedCode,
            'spr_reference_number' => $request->spr_reference_number,
            'spr_description' => $request->spr_description,
            'spr_mode_of_payment' => $request->spr_mode_of_payment,
            'spr_proof_of_payment_photo' => $sprProofOfPaymentPhotoName,
            'spr_paid_date' => now(),
            'spr_amount' => $request->spr_amount,
            'spr_semester' => $request->spr_semester,
        ]);
        $user = Student::find(Auth::user()->id);

        $user->record()->save($record);

        PaymentController::destroy($id);

        return redirect()->back()->with('isPaid', 'Paid Successfully!');
    }
    public function show(int $id): View
    {
        return view('records.show', ["record" => StudentPaymentRecord::findOrFail($id)]);
    }
}
