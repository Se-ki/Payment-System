<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
    public function scopeGetDescriptions($query)
    {
        return $query->where('status', 1)->orderBy('id', 'DESC')->get();
    }
    public function scopeCreateDescription($query, $request)
    {
        $query->create([
            'name' => ucwords($request->name),
            'status' => $request->status,
        ]);
    }
    public function scopeUpdateDescription($query, $id, $request)
    {
        $query->find($id)->update([
            'name' => ucwords($request->name),
            'status' => $request->status,
        ]);
    }
    public function scopeDeleteDescription($query, $id)
    {
        $query->find($id)->delete();
    }
}
