<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeSession extends Model
{
    use HasFactory;
    protected $primaryKey = 'fee_session_id';
    protected $fillable = [
        'fee_session_name',
    ];
}
