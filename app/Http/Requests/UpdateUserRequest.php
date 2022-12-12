<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['string', 'min:5', 'required', 'max:255'],
            'email' => [
                'email', 
                'required', 
                Rule::unique('users')->ignore($this->user->id),
            ],
            'password' => ['nullable', 'confirmed', Password::min(8)->numbers()],
            'role' => ['exists:roles,name'],
        ];
    }
}
