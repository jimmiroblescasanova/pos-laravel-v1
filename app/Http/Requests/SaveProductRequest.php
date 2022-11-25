<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProductRequest extends FormRequest
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
            'barcode' => ['required', 'min:5', 'string'],
            'name' => ['required', 'min:5', 'string'],
            'supplier_code' => ['nullable', 'min:5', 'string'],
            'cost' => ['nullable', 'numeric'],
            'price' => ['nullable', 'numeric'],
            'inventory' => ['nullable', 'numeric'],
            'minimum' => ['nullable', 'numeric'],
            'active' => ['required', 'boolean'],
            'description' => ['nullable', 'string'],
        ];
    }
}
