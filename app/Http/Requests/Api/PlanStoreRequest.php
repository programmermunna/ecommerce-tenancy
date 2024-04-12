<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PlanStoreRequest extends FormRequest
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
            'plan'     => 'required',
            'company'     => 'required|string|min:2|max:20',
            'domain'     => 'required|string|min:2|max:20',
        ];
    }

    public function prepareForValidation(){
        $this->merge([
            'domain' => $this->domain.'.'.config('tenancy.central_domains')[1]
        ]);
    }
}
