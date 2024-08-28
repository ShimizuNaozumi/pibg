<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_id';

    protected $fillable = [
        'student_name',
        'student_ic',
        'student_class',
        'student_fee',
        'user_id',
        'class_id',
    ];
}
