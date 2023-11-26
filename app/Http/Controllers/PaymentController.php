<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Routing\RedirectController;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(string $semesterId = null, AcademicYear $year = null)
    {
        if (!$semesterId && !isset($year->id)) {
            return abort(404);
        }

        if (isset($year->id) && $semesterId) {
            $payments = Payment::latest()
                ->where('student_id', Auth::user()->student->id)
                ->where('p_semester', $semesterId)
                ->where('academic_year_id', $year->id)
                ->get();
        } else if ($semesterId && !isset($year->id)) {
            $payments = Payment::latest()
                ->where('student_id', Auth::user()->student->id)
                ->where('p_semester', $semesterId)
                ->where('academic_year_id', AcademicYear::orderBy('id', 'DESC')->get()[0]->id)
                ->get();
        }
        return view('payments.index', [
            'payments' => $payments,
            'academics' => AcademicYear::orderBy('id', 'DESC')->get(),
            'currentYear' => $year
        ]);
    }
    public function create()
    {
        return view('payments.create');
    }
    public function store(Request $request)
    {
        $students = Student::where('role', 'student')->get();
        foreach ($students as $student) {
            $uniqueIdentifier = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $currentDate = now()->format('Ymd');
            $generatedCode = $currentDate . $uniqueIdentifier;
            $student->payment()->save(new Payment([
                "semester_id" => $request->semesters,
                "description" => $request->description,
                "code" => $generatedCode,
                'amount' => $request->amount,
                'deadline' => $request->deadline,
                'encoded_by' => Auth::user()->firstname . " " . Auth::user()->student->middlename . " " . Auth::user()->student->lastname
            ]));
        }
        return redirect('/payments/create');
    }
    public function show($id)
    {
        return view('payments.show', ['payment' => Payment::findOrFail($id)]);
    }
    public static function destroy()
    {

    }
}
