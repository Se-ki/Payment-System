<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model {
    use HasFactory;

    public function payment() {
        return $this->hasMany(Payment::class);
    }
    public function record() {
        return $this->hasMany(StudentPaymentRecord::class);
    }
}

