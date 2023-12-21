<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPaymentRecord extends Model
{
    use HasFactory;
    protected $with = ['student', 'academic'];
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
}
