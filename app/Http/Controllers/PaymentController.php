<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Description;
use App\Models\LoginUser;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Routing\RedirectController;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller {
    public function index(string $semesterId = null, AcademicYear $year = null) {
        if(isset($year->id) && $semesterId) {
            $payments = Payment::latest()
                ->where('student_id', Auth::user()->student->id)
                ->where('p_semester', $semesterId)
                ->where('academic_year_id', $year->id)
                ->get();
        } else if($semesterId && !isset($year->id)) {
            $payments = Payment::latest()
                ->where('student_id', Auth::user()->student->id)
                ->where('p_semester', $semesterId)
                ->where('academic_year_id', AcademicYear::orderBy('id', 'DESC')->get()[0]->id)
                ->get();
        } else {
            $payments = Payment::latest()
                ->where('student_id', Auth::user()->student->id)
                ->get();
        }
        return view('payments.index', [
            'header' => "Payments",
            'payments' => $payments,
            'academics' => AcademicYear::orderBy('id', 'DESC')->get(),
            'currentYear' => $year
        ]);
    }
    public function create() {
        return view('payments.create', [
            'descriptions' => Description::where('status', 1)->orderBy('id', 'DESC')->get(),
            'payments' => Payment::latest()->get(),
        ]);
    }
    public function store(Request $request) {
        $academic_years = AcademicYear::orderBy('id', 'DESC')->get();
        $login_users = LoginUser::where('role_type_id', 1)->get();
        foreach($login_users as $user) {
            $user->student->payment()->save(new Payment([
                'academic_year_id' => $academic_years->first()->id,
                "description_id" => $request->description_id,
                'amount' => $request->amount,
                'date_post' => NOW(),
                'deadline' => $request->deadline,
                'record_by' => Auth::user()->student->firstname." ".Auth::user()->student->middlename." ".Auth::user()->student->lastname,
                "p_semester" => $request->semester,
            ]));
        }
        return redirect('/payments/create');
    }
    public function show($id) {
        return view('payments.show', ['payment' => Payment::findOrFail($id)]);
    }
    public static function destroy($id) {
        Payment::findOrFail($id)->delete();
    }
}
