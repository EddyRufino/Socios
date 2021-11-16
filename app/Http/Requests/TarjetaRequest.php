<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TarjetaRequest extends FormRequest
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
            'url' => ['nullable'],
            'num_placa' => ['required', 'max:30', Rule::unique('tarjetas')->ignore($this->tarjeta, 'num_placa')],
            'expedicion' => ['required', 'date'],
            'revalidacion' => ['required', 'date'],
            'num_operacion' => ['nullable', 'max:120'],
            'vigencia_operacion' => ['nullable', 'max:120'],
            'num_autorizacion' => ['nullable', 'max:120'],
            'vigencia_autorizacion' => ['nullable', 'max:120'],
            'num_correlativo' => ['nullable'],
            'status' => ['nullable'],
            'vehiculo_id' => ['required'],
            'asociacione_id' => ['nullable'],
        ];
    }
}
