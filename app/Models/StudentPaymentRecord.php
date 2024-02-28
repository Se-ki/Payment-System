<?php

namespace App\Models;

use App\Helper\PS;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StudentPaymentRecord extends Model
{
    use HasFactory;
    // protected $with = ['student', 'academic'];
    protected $fillable = [
        'academic_year_id',
        'spr_description',
        'spr_receipt_number',
        'spr_reference_number',
        'spr_paid_date',
        'spr_amount',
        'spr_semester',
        'spr_mode_of_payment',
        'spr_proof_of_payment_photo',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class, foreignKey: 'student_id');
    }
    public function academic()
    {
        return $this->belongsTo(AcademicYear::class, foreignKey: 'academic_year_id');
    }

    public static function paid($request)
    {
        $sprProofOfPaymentPhotoName = $request->file('proof_of_payment_photo')->getClientOriginalName();
        $extension = $request->file('proof_of_payment_photo')->getClientOriginalExtension();
        if ($extension !== 'jpg' && $extension !== 'png') {
            return redirect()->back()->with('error', true);
        }
        $request->file('proof_of_payment_photo')->storeAs('public/proof_of_payment_photo/', $sprProofOfPaymentPhotoName);
        $user = Student::find(Auth::user()->id);
        $user->record()->save(new StudentPaymentRecord([
            'academic_year_id' => $request->academic_year_id,
            'spr_receipt_number' => PS::generateCode(),
            'spr_reference_number' => $request->spr_reference_number,
            'spr_description' => $request->spr_description,
            'spr_mode_of_payment' => $request->spr_mode_of_payment,
            'spr_proof_of_payment_photo' => $sprProofOfPaymentPhotoName,
            'spr_paid_date' => now(),
            'spr_amount' => $request->spr_amount,
            'spr_semester' => $request->spr_semester,
        ]));
    }

    public function studentRecordsFilter(array $filters)
    {
        $year = AcademicYear::currentYear()->first() ?? null;
        $latestYear = AcademicYear::getYear()->first();
        PS::abortIfInvalidSemesterAndYear($filters, $year);
        $student = Auth::user();
        $spr = StudentPaymentRecord::query()->latest()->with(['academic', 'student']);
        if ($student->role_id === 1) {
            $spr->where('student_id', $student->id);
        }
        if (isset($filters['year']) && isset($filters['semester'])) {
            $spr
                ->where('spr_semester', $filters['semester'])
                ->where('academic_year_id', $year->id);
        } else if (!isset($filters['year']) && isset($filters['semester'])) {
            $spr
                ->where('spr_semester', $filters['semester'])
                ->where('academic_year_id', $latestYear->id);
        } else if (isset($filters['year']) && !isset($filters['semester'])) {
            $spr->where('academic_year_id', $year->id);
        }
        return $spr;
    }
}
