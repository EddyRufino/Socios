<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UsuariosRequest extends FormRequest
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
        // dd(Rule::unique('users')->ignore($this->user, 'email'));
        return [
            'name' => ['required', 'string', 'max:240'],
            // 'email' => 'required|unique:users,email,'.$this->route('usuario'),
            'email' => ['required', Rule::unique('users')->ignore($this->user, 'email')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
