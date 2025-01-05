<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id', 
        'teacher_id', 
        'date', 
        'type', 
        'description', 
        'signature', 
        'subject', 
        'course_name'
    ];

    // A course belongs to a teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // A course belongs to a group
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
