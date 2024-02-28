<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class LoginUser extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'password',
    ];

    // protected $guard = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $with = ['student', 'role'];


    public function student()
    {
        return $this->belongsTo(Student::class, foreignKey: 'student_id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, foreignKey: 'role_id');
    }

    public function students()
    {
        return LoginUser::query()->where('role_id', 1);
    }
    public function scopeFindStudent($query, $id)
    {
        return $query->find($id);
    }
}
