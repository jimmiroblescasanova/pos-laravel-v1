<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'barcode' => [
                'required', 
                'min:5', 
                'string', 
                Rule::unique('products')->ignore($this->product->id),
            ],
            'name' => ['required', 'min:5', 'string', 'max:255'],
            'supplier_code' => ['nullable', 'min:5', 'string'],
            'cost' => ['nullable', 'numeric'],
            'price' => ['nullable', 'numeric'],
            'active' => ['required', 'boolean'],
            'description' => ['nullable', 'string'],
            'group_id' => ['sometimes']
        ];
    }
}
