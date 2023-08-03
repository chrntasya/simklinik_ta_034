<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DokterUpdateRequest extends FormRequest
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
            'username' => 'required',
            'nama' => 'required',
            'nomor_telepon' => 'required',            
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat_rumah' => 'required',
            'spesialis' => 'required'
        ];
    }
}
