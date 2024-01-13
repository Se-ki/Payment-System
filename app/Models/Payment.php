<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Payment extends Model
{
    use HasFactory, UUID;
    protected $fillable = ['academic_year_id', 'description_id', 'amount', 'date_post', 'deadline', 'record_by_id', 'payment_semester'];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function academic()
    {
        return $this->belongsTo(AcademicYear::class, foreignKey: 'academic_year_id');
    }

    public function description()
    {
        return $this->belongsTo(Description::class);
    }

    public function recordBy()
    {
        return $this->belongsTo(related: Student::class, foreignKey: 'record_by_id');
    }

    public function scopePaymentFilter($query)
    {
        $filters = request(['semester', 'year']);
        $payments = $query->latest()->where('student_id', Auth::user()->student->id)->with(['student', 'academic', 'description', 'recordBy']);
        $academicYear = AcademicYear::firstWhere('year', $filters['year'] ?? null);
        if (isset($filters['semester']) && $filters['semester'] >= 3 || isset($filters['semester']) && $filters['semester'] <= 0 || isset($filters['year']) && !isset($academicYear)) {
            abort(404);
        }
        if (!isset($filters['year']) && isset($filters['semester'])) {
            $payments
                ->where('payment_semester', $filters['semester'])
                ->firstWhere('academic_year_id', AcademicYear::orderBy('id', 'DESC')->first()->id);
        } else if (isset($filters['year']) && !isset($filters['semester'])) {
            $payments->where('academic_year_id', $academicYear->id);
        } else if (isset($filters['year']) && isset($filters['semester'])) {
            $payments
                ->where('payment_semester', $filters['semester'])
                ->where('academic_year_id', $academicYear->id);
        }
    }
    public function scopeShowStudentPayments($query, $student)
    {
        return $query->latest()->where('student_id', $student->id)->with(['student', 'academic', 'description'])->get();
    }
    public function scopeFindPayment($query, $id)
    {
        $query->findOrFail($id);
    }
    public function scopeGetAllPayments($query)
    {
        return $query->latest()->with(['description', 'recordBy', 'student'])->get();
    }
    public function createPayments($request)
    {
        $academicYearId = AcademicYear::getYear()->first()->id;
        $students = LoginUser::students();
        $payments = [
            'academic_year_id' => $academicYearId,
            'description_id' => $request->description_id,
            'amount' => $request->amount,
            'date_post' => now(),
            'deadline' => $request->deadline,
            'record_by_id' => Auth::user()->id,
            'payment_semester' => $request->payment_semester,
        ];
        foreach ($students as $user) {
            $user->student->payment()->create($payments);
        }
    }
}
