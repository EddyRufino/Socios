<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuministroRequest extends FormRequest
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
            'nombre' => ['required'],
            'monto_pvc' => ['required'],
            'conteo_monto_pvc' => ['nullable'],
            'monto_cinta' => ['required'],
            'conteo_monto_cinta' => ['nullable'],
            'monto_holograma' => ['required'],
            'conteo_monto_holograma' => ['nullable'],
            'monto_pruebas' => ['nullable'],
            'status' => ['required'],
            'fecha_adquisicion' => ['required'],
            'fecha_utilizacion' => ['nullable'],
            'description' => ['nullable'],
        ];
    }
}
