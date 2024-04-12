<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'title'     => 'required',
            'category'     => 'required|string|min:2|max:20',
            'price'     => 'required|min:2|max:20',
            'image' => 'mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
