<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;
    protected $primaryKey = 'fee_id';
    protected $fillable = [
        'fee_session_id',
        'fee_name',
        'fee_amount',
        'fee_specific',
    ];
}
