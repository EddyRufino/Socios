<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SocioRquest extends FormRequest
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
            'nombre_socio' => ['required', 'max:120'],
            'nombre_propietario' => ['nullable', 'max:120'],
            'dni_socio' => ['required', 'min:8', 'max:8'],
            'dni_propietario' => ['nullable', 'min:8', 'max:8'],
            'num_placa' => ['nullable', 'max:30', Rule::unique('socios')->ignore($this->socio, 'num_placa')],
            'url' => ['nullable'],
        ];
    }
}
