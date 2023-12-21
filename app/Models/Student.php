<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['profile_pic'];
    protected $with = ['course'];

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
    public function record()
    {
        return $this->hasMany(StudentPaymentRecord::class);
    }
    public function balance()
    {
        return $this->hasMany(StudentBalancePayment::class);
    }
    public function loginUser()
    {
        return $this->hasOne(LoginUser::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
