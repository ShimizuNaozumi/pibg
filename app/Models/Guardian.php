<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $primaryKey = 'guardian_id';

    protected $fillable = [
        'guardian_name',
        'guardian_email',
        'guardian_notel',
        'guardian_gaji',
        'guardian_role',
    ];
}
