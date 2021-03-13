<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'account_id' => ['required'],
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($this->user)],
            'password' => ['nullable', 'min:6'],
            'status' => ['required', 'boolean'],
            'profile_photo_path' => ['nullable', 'image'],
        ];
    }

    public function messages()
    {
        return [
            'account_id.required' => 'La CUENTA es requerida',
            'name.required' => 'El NOMBRE es requerido',
            'name.max' => 'El NOMBRE no debe exeder 50 caracteres',
            'email.required' => 'El e-mail es requerido', 
            'email.email' => 'Debe ser un e-mail válido', 
            'password.min' => 'La CONTRASEÑA debe tener al menos 6 caracteres',
        ];
    }
}
