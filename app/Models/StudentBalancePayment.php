<?php

namespace App\Models;

use App\Helper\PS;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StudentBalancePayment extends Model
{
    use HasFactory, UUID;
    protected $fillable = [
        'academic_year_id',
        'sbp_description',
        'sbp_receipt_number',
        'sbp_amount',
        'sbp_paid_amount',
        'sbp_paid_change',
        'sbp_balance_amount',
        'sbp_semester',
        'sbp_date_paid',
        'status',
        'collector_id'
    ];
    // protected $with = ['student'];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function collector()
    {
        return $this->belongsTo(Student::class, foreignKey: 'collector_id');
    }
    public function scopeUpdateBalance($query, $id, $request)
    {
        $query->find($id)->update($request->all());
    }
    public function walkInPaid($payment, $request)
    {
        $student = Student::find($payment->student_id);
        $student->balance()->save(new StudentBalancePayment([
            'academic_year_id' => $payment->academic_year_id,
            'sbp_description' => $payment->description->name,
            'sbp_receipt_number' => PS::generateCode(),
            'sbp_amount' => $request->sbp_amount,
            'sbp_paid_amount' => $request->sbp_paid_amount,
            'sbp_paid_change' => $request->sbp_paid_change,
            'sbp_balance_amount' => $request->sbp_balance_amount,
            'sbp_semester' => $payment->payment_semester,
            'sbp_date_paid' => now(),
            'status' => $request->status,
            'collector_id' => Auth::user()->id,
        ]));
    }
    public function scopeShowStudentBalance($query, $student_id)
    {
        return $query->latest()->where('student_id', $student_id)->with(['collector', 'student'])->get();
    }
    public function scopeStudentBalance($query)
    {
        return $query->latest("sbp_date_paid")->where('student_id', Auth::user()->student->id)->with(['student', 'collector'])->get();
    }
}
