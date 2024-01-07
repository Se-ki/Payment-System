<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model {
    use HasFactory;
    protected $fillable = ['name', 'status'];
    public function payment() {
        return $this->hasMany(Payment::class);
    }
}
