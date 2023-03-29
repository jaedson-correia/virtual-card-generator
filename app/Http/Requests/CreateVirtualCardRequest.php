<?php

namespace App\Http\Requests;

use App\Rules\SlugRule;
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
                'unique:virtual_cards',
                new SlugRule,
            ],
            'linkedin' => [
                'required'
            ],
            'github' => [
                'required'
            ],
            'slug' => [
                'unique:virtual_cards',
            ],
            'extra' => [
                'nullable'
            ],
        ];
    }

    public function messages()
    {
        return [
            'slug.unique' => 'The name has already been taken.'
        ];
    }
}
