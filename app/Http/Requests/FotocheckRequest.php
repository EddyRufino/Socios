<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FotocheckRequest extends FormRequest
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
            'expedicion' => ['required'],
            'revalidacion' => ['required'],
            'image' => $this->fotocheck ? ['image', 'mimes:jpg,jpeg,png', 'max:2048'] : ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'status' => ['nullable'],
            'tipo' => ['nullable'],
            'socio_id' => ['nullable'],
            'vehiculo_id' => ['required'],
            'user_id' => ['nullable'],
        ];
    }
}
