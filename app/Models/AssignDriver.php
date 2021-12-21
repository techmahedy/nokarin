<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignDriver extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_driver_id',
        'date_from',
        'date_to'
    ];
    
}
