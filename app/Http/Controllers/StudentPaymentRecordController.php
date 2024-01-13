<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentPaymentRecordRequest;
use App\Models\AcademicYear;
use App\Models\StudentPaymentRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StudentPaymentRecordController extends Controller
{
    public function index(AcademicYear $academicYear, StudentPaymentRecord $studentPaymentRecord): RedirectResponse|View
    {
        $records = $studentPaymentRecord->studentRecordsFilter(request(['semester', 'year']));
        $academics = $academicYear->getYear()->get();
        $currentYear = request('year') ? $academicYear->currentYear() : null;
        return view('records.index', compact('records', 'academics', 'currentYear'));
    }
    public function store(string $id,  PaymentController $payment, StudentPaymentRecord $spr, StudentPaymentRecordRequest $request): RedirectResponse
    {
        $spr->paid($request);
        $payment->destroy($id);
        return back()->with('isPaid', 'Paid Successfully!');
    }
    public function show(int $id): View
    {
        return view('records.show', ["record" => StudentPaymentRecord::findOrFail($id)]);
    }
}
