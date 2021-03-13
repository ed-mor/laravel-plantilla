<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        //  Lógica de autorización
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')],
            'password' => ['required', 'confirmed', 'min:6'],
            'status' => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El NOMBRE es requerido',
            'name.max' => 'El NOMBRE no debe exeder 50 caracteres',
            'email.required' => 'El e-mail es requerido', 
            'email.email' => 'Debe ser un e-mail válido', 
            'password.required' => 'La CONTRASEÑA es requerida',
            'password.min' => 'La CONTRASEÑA debe tener al menos 6 caracteres',
        ];
    }
}











