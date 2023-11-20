<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRecords extends Model
{
    use HasFactory;

    protected $fillable = ['receipt_number', 'reference_number', 'description', 'mode', 'paid_date', 'amount'];
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
