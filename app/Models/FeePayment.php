<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeePayment extends Model
{
    use HasFactory;

    protected $primaryKey = 'fee_payment_id';
    public $timestamps = false;

    protected $fillable = [
        'fee_payment_name',
        'fee_payment_email',
        'fee_payment_notel',
        'student_id',
        'transaction_id',
    ];
}
