<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;

    protected $primaryKey = 'fund_id';

    protected $fillable = [
        'admin_id',
        'fund_name',
        'fund_image_path',
        'fund_description',
        'fund_target',
        'fund_status',
    ];
}
