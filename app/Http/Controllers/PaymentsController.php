<?php

namespace App\Http\Controllers;

use App\Models\PaymentRecords;
use App\Models\Payments;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Faker\Core\Number;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    //
    public function index()
    {
        return view('payments.index', [
            'payments' => Payments::latest()->where('user_id', Auth::user()->id)->get()
        ]);
    }
    public function create()
    {
        return view('payments.create');
    }
    public function store(Request $request)
    {
        $students = User::where('role', 'student')->get();
        foreach ($students as $student) {
            $student->payments()->save(new Payments([
                "semester_id" => $request->semesters,
                "description" => $request->description,
                'amount' => $request->amount,
                'deadline' => $request->deadline,
                'encoded_by' => Auth::user()->firstname
            ]));
        }
        return redirect('/payments/create');
    }

    public function show($id)
    {
        return view('payments.show', ['payment' => Payments::findOrFail($id)]);
    }
    public static function destroy()
    {

    }
}
