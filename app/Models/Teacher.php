<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; 
class Teacher extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name', 
        'last_name', 
        'email', 
        'phone', 
        'type', 
        'weekly_hours',
        'password'
    ];

    protected $hidden = [
        'password',
    ];
    public function Courses()
    {
        return $this->hasMany(Courses::class);
    }
}
