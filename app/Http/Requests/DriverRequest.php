<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name'  => 'required',
            'sex'        => 'required',
            'license_number' => 'required',
            'license_expiry_date' => 'required',
            'license_type' => 'required',
            'restriction' => 'required',
            'cp_contact_number' => 'required',
            'id_picture' => 'required',
            'emg_cp_name' => 'required',
            'relation' => 'required'
        ];
    }
}
