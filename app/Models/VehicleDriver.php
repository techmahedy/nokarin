<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleDriver extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'sex',
        'license_number',
        'license_expiry_date',
        'license_type',
        'restriction',
        'cp_contact_number',
        'id_picture',
        'viber_number',
        'fb_or_messenger_name',
        'emg_cp_name',
        'relation',
        'authorization_letter'
    ];
    
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }
}
