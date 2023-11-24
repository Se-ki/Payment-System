<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Payments;
use App\Models\Student;
use App\Models\UserLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //
    public function index()
    {
        return view('payments.index', [
            'payments' => Payment::latest()->where('student_id', Auth::user()->student->id)->get()
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
