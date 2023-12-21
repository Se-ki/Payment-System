<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Description;
use App\Models\LoginUser;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(): View
    {
        $filters = request(['semester', 'year']);
        $query = Payment::latest()->where('student_id', Auth::user()->student->id);
        $year = AcademicYear::firstWhere('year', $filters['year'] ?? null);
        // $query->when($semesterId ?? false, function ($query, $semester) {
        //     $query->where('p_semester', $semester)
        //         ->firstWhere('academic_year_id', AcademicYear::orderBy('id', 'DESC')->first()->id);
        // });
        // $query->when($year->id ?? false, fn($query, $year) =>
        //     $query->where('academic_year_id', $year)
        // );
        if (isset($filters['semester']) && $filters['semester'] >= 3 || isset($filters['semester']) && $filters['semester'] <= 0 || isset($filters['year']) && !isset($year)) {
            abort(404);
        }
        if (!isset($filters['year']) && isset($filters['semester'])) {
            $query
                ->where('p_semester', $filters['semester'])
                ->firstWhere('academic_year_id', AcademicYear::orderBy('id', 'DESC')->first()->id);
        } else if (isset($filters['year']) && !isset($filters['semester'])) {
            $query->where('academic_year_id', $year->id);
        } else if (isset($filters['year']) && isset($filters['semester'])) {
            $query
                ->where('p_semester', $filters['semester'])
                ->where('academic_year_id', $year->id);
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
        $academic_years = AcademicYear::orderBy('id', 'DESC')->get();
        $login_users = LoginUser::where('role_type_id', 1)->get();
        foreach ($login_users as $user) {
            $user->student->payment()->save(new Payment([
                'academic_year_id' => $academic_years->first()->id,
                "description_id" => $request->description_id,
                'amount' => $request->amount,
                'date_post' => NOW(),
                'deadline' => $request->deadline,
                'record_by_id' => Auth::user()->id,
                "p_semester" => $request->semester,
            ]));
        }
        return redirect('/payments/create');
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
