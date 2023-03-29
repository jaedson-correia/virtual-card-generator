<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateVirtualCardRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => $this->name ? Str::slug($this->name) : ''
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'unique:virtual_cards'
            ],
            'linkedin' => [
                'required'
            ],
            'github' => [
                'required'
            ],
            'slug' => [
                'unique:virtual_cards'
            ],
            'extra' => [
                'nullable'
            ],
        ];
    }

    public function messages()
    {
        return [
            'slug.unique' => 'You can\'t use that name'
        ];
    }
}
