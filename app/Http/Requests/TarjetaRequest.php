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
            'url' => ['nullable'],
            'num_placa' => ['required', 'max:30', Rule::unique('tarjetas')->ignore($this->tarjeta, 'num_placa')],
            'expedicion' => ['required', 'date'],
            'revalidacion' => ['required', 'date'],
            'num_operacion' => ['nullable', 'max:120'],
            'vigencia_operacion' => ['nullable', 'max:120'],
            'num_autorizacion' => ['nullable', 'max:120'],
            'vigencia_autorizacion' => ['nullable', 'max:120'],
            'num_correlativo' => ['nullable', Rule::unique('tarjetas')->ignore($this->tarjeta, 'num_correlativo')],
            'status' => ['nullable'],
            'tipo' => ['nullable'],
            'socio_id' => ['nullable'],
            'vehiculo_id' => ['required'],
            'user_id' => ['nullable'],
        ];
    }
}
