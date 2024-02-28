<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentPaymentRecordRequest;
use App\Models\AcademicYear;
use App\Models\StudentPaymentRecord;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class StudentPaymentRecordController extends Controller
{
    public function index(Request $request, AcademicYear $academicYear, StudentPaymentRecord $studentPaymentRecord)
    {
        $records = $studentPaymentRecord->studentRecordsFilter(request(['semester', 'year']));
        $academics = $academicYear->getYear()->get();
        $currentYear = request('year') ? $academicYear->currentYear() : null;
        return view('records.index', compact('records', 'academics', 'currentYear'));
    }
    public function store(string $id,  PaymentController $payment, StudentPaymentRecord $spr, StudentPaymentRecordRequest $request)
    {
        $spr->paid($request);
        $payment->destroy($id);
        return Response::json(['message' => "Need to verify, we will notify you if your transaction is legit."]);
    }
    public function show(int $id): View
    {
        return view('records.show', ["record" => StudentPaymentRecord::findOrFail($id)]);
    }
}
