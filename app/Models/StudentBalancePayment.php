<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBalancePayment extends Model
{
    use HasFactory;

    public function userLogin()
    {
        return $this->belongsTo(Student::class);
    }
}
