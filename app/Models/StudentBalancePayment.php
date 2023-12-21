<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    protected $with = ['student'];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function collector()
    {
        return $this->belongsTo(Student::class, foreignKey: 'collector_id');
    }
}
