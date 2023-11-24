<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['semester_id', 'code', 'description', 'amount', 'deadline', 'encoded_by'];

    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(Student::class);
    }
}
