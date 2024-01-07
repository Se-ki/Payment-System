<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Description;
use App\Models\LoginUser;
use App\Models\Payment;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index() //: View
    {
        $filters = request(['semester', 'year']);
        $query = Payment::latest()->where('student_id', Auth::user()->student->id);
        $academicYear = AcademicYear::firstWhere('year', $filters['year'] ?? null);
        if (isset($filters['semester']) && $filters['semester'] >= 3 || isset($filters['semester']) && $filters['semester'] <= 0 || isset($filters['year']) && !isset($academicYear)) {
            abort(404);
        }
        if (!isset($filters['year']) && isset($filters['semester'])) {
            $query
                ->where('payment_semester', $filters['semester'])
                ->firstWhere('academic_year_id', AcademicYear::orderBy('id', 'DESC')->first()->id);
        } else if (isset($filters['year']) && !isset($filters['semester'])) {
            $query->where('academic_year_id', $academicYear->id);
        } else if (isset($filters['year']) && isset($filters['semester'])) {
            $query
                ->where('payment_semester', $filters['semester'])
                ->where('academic_year_id', $academicYear->id);
        }
        return view('payments.index', [
            'header' => "Payments",
            'payments' => $query->get(),
            'academics' => AcademicYear::orderBy('id', 'DESC')->get(),
            'currentYear' => isset($filters['year']) ? AcademicYear::firstWhere('year', $filters['year']) : null,
        ]);
    }
    public function create(): View
    {
        return view('payments.create', [
            'descriptions' => Description::where('status', 1)->orderBy('id', 'DESC')->get(),
            'payments' => Payment::latest()->get(),
        ]);
    }
    public function store(Request $request): RedirectResponse
    {
        $academicYear = AcademicYear::orderBy('id', 'DESC')->first();
        $loginUsers = LoginUser::where('role_id', 1)->get();
        $request->validate([
            'amount' => ['required', 'numeric'],
            'deadline' => ['required', 'date'],
            'payment_semester' => ['required', 'digits:1', 'numeric'],
        ]);
        foreach ($loginUsers as $user) {
            $user->student->payment()->save(new Payment([
                'academic_year_id' => $academicYear->id,
                "description_id" => $request->description_id,
                'amount' => $request->amount,
                'date_post' => now(),
                'deadline' => $request->deadline,
                'record_by_id' => Auth::user()->id,
                "payment_semester" => $request->payment_semester,
            ]));
        }
        return redirect(route('payments.create'));
    }
    public function show(string $id): View
    {
        return view('payments.show', ['payment' => Payment::findOrFail($id)]);
    }
    public static function destroy(string $id): void
    {
        Payment::findOrFail($id)->delete();
    }
}
