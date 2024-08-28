<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'transaction_id';

    protected $fillable = [
        'transaction_code',
        'transaction_invoiceno',
        'transaction_status',
        'transaction_method',
        'transaction_amount',
        'transaction_issued_date',
        'transaction_refno',
    ];

}
