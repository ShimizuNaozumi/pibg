<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $primaryKey = 'donation_id';
    public $timestamps = false;

    protected $fillable = [
        'donor_name',
        'donor_email',
        'donor_notel',
        'fund_id',
        'transaction_id',
    ];
}
