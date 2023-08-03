<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasienUpdateRequest extends FormRequest
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
            'password' => 'required',
            'nama' => 'required',
            'nomor_telepon' => 'required',            
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_rm' => 'required',
            'pekerjaan' => 'required',
            'jenis_kelamin' => 'required',
            'alamat_rumah' => 'required'
        ];
    }
}
