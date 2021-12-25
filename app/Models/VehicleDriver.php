<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\Json;

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
        'cp_contact_number',
        'id_picture',
        'viber_number',
        'fb_or_messenger_name',
        'emg_cp_name',
        'emg_cp_number',
        'relation',
        'authorization_letter',
        'restriction'
    ];
    
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }
}
