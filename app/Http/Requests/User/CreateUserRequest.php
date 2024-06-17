<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255', 'min:3'],
            'nickname' => ['required', 'string', 'max:255', 'min:3', 'unique:users'],
            'email' => 'required|email|unique:users',
            'password' => ['required', 'min:8', 'confirmed', Password::defaults()],
        ];
    }
}
